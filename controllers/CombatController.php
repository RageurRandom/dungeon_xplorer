<?php
class CombatController{
    public function test(){
        if(!isset($_SESSION["hero"])){
            $_SESSION["hero"] = new Mage(0, 1, 1, "Pierre Henrie Test", 7, 10, 12, 10, 10, 5, 3, 0); //tj pour les tests
    
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
        if($action === "attack"){
            echo "je connais ça c'est une attaque !";
        } else {
            $tab = explode('_', $action);

            $prefix = $tab[0];

            $id = $tab[1];

            echo "je connais ça c'est $prefix";
        }
        
    }

    /**
     * action de l'ennemi
     * actuellement juste une attaque, pourrais être étendu pour par exemple intégrer un système de sorts
     */
    public function ennemyAction(){
        if($_SESSION["combatMonster"]->isDead()){
            echo $_SESSION["combatMonster"]->getName() . " a succombé(e)";
        } else {
            echo "L'ennemi attaque !";
            echo $_SESSION["combatMonster"]->attack($_SESSION["hero"]) . " dégâts subis !";
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

        

        if(isset($_POST["action"])){ //la baston
        
            if($_SESSION["combatIsPlayerFirst"]){
                //gestion des attaques selon prio
                echo "ui\n";
            }

            $this->playerAction($_POST["action"]);
        
        }

        //calcul de l'initiative pour le prochain tour
        $_SESSION["combatIsPlayerFirst"] = $this->isPlayerFirst($_SESSION["hero"], $_SESSION["combatMonster"]);
        

        require_once 'views/combat.php';
    }
    

    
}

?>