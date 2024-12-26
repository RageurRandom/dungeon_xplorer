<?php
class CombatController{
    public function test(){
        if(!isset($_SESSION["hero"])){
            $_SESSION["hero"] = new Mage(0, 1, 1, "Pierre Henrie Test", 70, 100, 12, 10, 10, 5, 3, 0); //tj pour les tests
    
            $_SESSION["hero"]->collecteSpell(new AttackingSpell(1, 4, "boule de feu", 10));
            $_SESSION["hero"]->collecteSpell(new AttackingSpell(8, 5, "Tranche de vent", 1));
            $_SESSION["hero"]->collecteSpell(new BoostingSpell(13, 3,"initiative", 3, "rythme du soleil levant", 5));
            $_SESSION["hero"]->collecteSpell(new AttackingSpell(10, 2, "Onde Obscure", 13));
        }

        if(!isset($_SESSION["combatMonster"])){
            $_SESSION["combatMonster"] = DataBase::getMonster(1);
        }
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
            if($action === "attack"){
                echo "je connais ça c'est une attaque !\n";
            } else {
                $tab = explode('_', $action);

                $prefix = $tab[0];

                $id = $tab[1];

                echo "je connais ça c'est $prefix\n";
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
        
        if(!isset($_SESSION["hero"]) || !isset($_SESSION["combatMonster"])){
            //erreur
            header("Location : /dx_11");
        }

        echo "<pre>";

        if(isset($_POST["action"])){ //la baston
        
            if($_SESSION["combatIsPlayerFirst"]){
                $this->ennemyAction();
                $this->playerAction($_POST["action"]);
                echo "ui\n";
            } else {
                $this->playerAction($_POST["action"]);
                $this->ennemyAction();
            }
        
            //fin du tour
            if($_SESSION["combatMonster"]->isDead()){
                //chapitre suivant
            }

            if($_SESSION["hero"]->isDead()){
                //mort puis chapitre 10
            }
        }

        //calcul de l'initiative pour le prochain tour
        $_SESSION["combatIsPlayerFirst"] = $this->isPlayerFirst($_SESSION["hero"], $_SESSION["combatMonster"]);
        
        echo "</pre>";
        require_once 'views/combat.php';
    }
    

    
}

?>