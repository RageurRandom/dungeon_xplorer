<?php
class CombatController{
    public function test(){
        if(!isset($_SESSION["hero"])){
            $_SESSION["hero"] = new Mage(0, 1, 1, "Pierre Henrie Test", 100, 100, 12, 10, 10, 1, 3, 0); //tj pour les tests
    
            $_SESSION["hero"]->collecteSpell(new AttackingSpell(1, 4, "boule de feu", 10));
            $_SESSION["hero"]->collecteSpell(new AttackingSpell(8, 5, "Tranche de vent", 1));
            $_SESSION["hero"]->collecteSpell(new BoostingSpell(13, 3,"initiative", 3, "rythme du soleil levant", 5));
            $_SESSION["hero"]->collecteSpell(new AttackingSpell(10, 2, "Onde Obscure", 13));
            $potionTest = Factory::itemInstance(17, 1, "potion de vie", "rends 5 pv", 1, 3);
            $_SESSION["hero"]->collecteItem($potionTest);
            $_SESSION["hero"]->collecteItem(Factory::itemInstance(18, 1, "potion de mana", "rends 5 points de mana", 1, 3));

            $_SESSION["hero"]->dropItem($potionTest);

        }

        if(!isset($_SESSION["combatMonster"])){
            $_SESSION["combatMonster"] = DataBase::getMonster(1);
        }
    }

    /**
     * A appeler à la fin d'un combat (peu importe l'issue)
     */
    public function endFight(){
        while(sizeof($_SESSION["tabBoost"]) > 0){
            $this->updateBoost();
        }

        unset($_SESSION["tabBoost"]);
        unset($_SESSION["combatIsPlayerFirst"]);
    }

    public function updateBoost(){
        for($i = 0; $i < sizeof($_SESSION["tabBoost"]); $i++){
            $boost = $_SESSION["tabBoost"][$i];

            if($boost["remaining_time"] <= 0){
                //boost fini
                switch ($boost["target"]) {
                    case 'initiative':
                        $_SESSION["hero"]->addInitiative($boost["value"] * -1);
                        break;
                    
                    case 'strength':
                        $_SESSION["hero"]->addStrength($boost["value"] * -1);
                        break;

                    default:
                        //correspond aux pv, pas besoin de reset
                        break;
                }

                unset($_SESSION["tabBoost"][$i]);
                array_splice($_SESSION["tabBoost"], 0);

            } else {
                $_SESSION["tabBoost"][$i]["remaining_time"] = $_SESSION["tabBoost"][$i]["remaining_time"] - 1;
            }
        }
    }

    /**
     * utilise un sort de boost sur le joueur
     * @param string|int $spellId id du sort à utiliser (doit être dans la BDD)
     */
    public function playerBoost($spellId){

        $resRequest = DataBase::getSpell($spellId)[0]; //y a qu'un sort normalement

        $spell = Factory::spellInstance($spellId, $resRequest["spell_name"], $resRequest["spell_mana_cost"]);

        $_SESSION["hero"]->useBoostingSpell($spell);

        array_push($_SESSION["tabBoost"], array("target" => $spell->getBoostTarget(), "remaining_time" => $spell->getBoostDuration(), "value" => $spell->getBoostValue()));

    }

    /**
     * utilise un sort d'attaque
     * @param string|int $spellId id du sort à utiliser (doit être dans la BDD)
     */
    public function playerAttackSpell($spellId){
        $resRequest = DataBase::getSpell($spellId)[0]; //y a qu'un sort normalement

        print_r($resRequest);

        $spell = Factory::spellInstance($spellId, $resRequest["spell_name"], $resRequest["spell_mana_cost"]);

        $_SESSION["hero"]->useAttackingSpell($spell, $_SESSION["combatMonster"]);
    }

    /**
     * utilise une potion
     * @param string|int $potionId id de la potion à utiliser (doit être dans la BDD)
     */
    public function playerPotion($potionId){
        $heros = $_SESSION["hero"];

        $inventory = $heros->getInventory();

        $flag = false;
        $i = 0;

        $potion = NULL;
        while(!$flag && $i < sizeof($inventory)){
            if(isset($inventory[$i]) && $inventory[$i]->getId() == $potionId){
                $flag = true;
                $potion = $inventory[$i];
            }

            $i += 1;
        }

        if($potion != NULL){
            $heros->consumePotion($potion);
        } else {
            echo "un problème a été rencontré";
        }

        /*
        $resRequest = DataBase::getItem($potionId)[0];

        $potion = Factory::itemInstance($potionId, $resRequest["item_weight"], $resRequest["item_name"], $resRequest["item_desc"], $resRequest["item_size"], 1);
        */

        
    }


    /**
     * gestion de l'action selectionnée par le joueur
     * @param string action effectuée par le joueur
     */
    public function playerAction($action){
        $heros = $_SESSION["hero"];
        if($heros->isDead()){
            echo $heros->getName() . " a succombé(e)\n";
        } else {
            if($action === "attack"){ //attaque classique
                echo $heros->getName() . " attaque !\n";

                $damages = $_SESSION["hero"]->attack($_SESSION["combatMonster"]);

                if($damages == 0){
                    $damages = "Aucun";
                }

                echo  "$damages dégâts subis par ". $_SESSION["combatMonster"]->getName() . "!\n";

            } else {
                $tab = explode('_', $action);

                $prefix = $tab[0];

                $id = $tab[1];

                //TODO gestion consommables

                switch($prefix){
                    case "boostingSpell":
                        $this->playerBoost($id);
                        break;

                    case "attackingSpell":
                        $this->playerAttackSpell($id);
                        break;

                    case "potion":
                        $this->playerPotion($id);
                        break;
                    
                    default:
                    break; //inconnu
                }
                
            }
        }
    }

    /**
     * action de l'ennemi
     * actuellement juste une attaque, pourrais être étendu pour par exemple intégrer un système de sorts
     */
    public function ennemyAction(){
        if($_SESSION["combatMonster"]->isDead()){
            echo $_SESSION["combatMonster"]->getName() . " a succombé(e)\n";
        } else {
            echo "L'ennemi attaque !\n";
            $damages = $_SESSION["combatMonster"]->attack($_SESSION["hero"]);

            if($damages == 0){
                $damages = "Aucun";
            }

            echo  "$damages dégâts subis !\n";
        }
    }

    /**
     * vérifie qui du joueur ou du monstre doit jouer en premier
     * @param Heros heros du joueur
     * @param Fighter monstre qui combat le héros
     * @return bool vrai si le joueur joue en premier, faux sinon
     */
    public function isPlayerFirst($heros, $monster){
        $heros_init = rand(1,6) + $heros->getInitiative();

        $monster_init = rand(1, 6) + $monster->getInitiative();

        if($heros_init == $monster_init){
            return $heros instanceof Thief;
        }

        return $heros_init > $monster_init;
    }



    /**
     * Fonction appelée au chargement de la page "combat"
     */
    public function index() {
        session_start();

        $this->test(); //TODO retirer

        if(!isset($_SESSION["tabBoost"])){
            $_SESSION["tabBoost"] = [];
        } else {
            $this->updateBoost();
        }

        if(!isset($_SESSION["hero"]) || !isset($_SESSION["combatMonster"])){
            //erreur
            echo "erreur\n";
            header("Location: /dx_11");
        }

        echo "<pre>";

        if(isset($_POST["action"])){ //la baston
        
            if($_SESSION["combatIsPlayerFirst"]){
                $this->playerAction($_POST["action"]);
                $this->ennemyAction();
            } else {
                $this->ennemyAction();
                $this->playerAction($_POST["action"]);
            }
        
            //fin du tour
            if($_SESSION["combatMonster"]->isDead()){
                //chapitre suivant
                echo "chapitre suivant\n";
                $this->endFight();
                echo "<a href = \"/dx_11/chapitreSuivant/". $_SESSION["combatChap"] . "/0/0/0/0\">Continuer</a>";
                die();
            }

            if($_SESSION["hero"]->isDead()){
                //mort puis chapitre 10
                echo "mort\n";
                $this->endFight();
                echo "<a href = \"/dx_11/chapitreSuivant/10/0/0/0/0\">Continuer</a>";
                die();
            }
        }

        //calcul de l'initiative pour le prochain tour
        $_SESSION["combatIsPlayerFirst"] = $this->isPlayerFirst($_SESSION["hero"], $_SESSION["combatMonster"]);
        
        echo "</pre>";
        require_once 'views/combat.php';
    }
    

    
}

?>