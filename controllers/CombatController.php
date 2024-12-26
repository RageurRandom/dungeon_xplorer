<?php
class CombatController{
    public function index() {
        session_start();
        require_once 'views/combat.php';
    }

    /**
     * créé une instance de Combattant en cherchant un monstre dans la BDD
     * @param int monster_id l'id du monstre à chercher
     * @return Combattant monstre trouvé ou NULL si aucun monstre avec cet ID n'a été trouvé
     */
    

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
}

?>