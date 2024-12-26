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
    public function getMonster($monster_id){
        $DB = DataBase::getInstance();

        try {
            $querry = "SELECT monster_name, monster_HP, monster_mana, monster_strength, monster_initiative FROM monster
            WHERE monster_id = ?";

            $statement = $DB->prepare_statement($querry);

            $statement->bindParam(1, $monster_id);
            $statement->execute();
            $results = $statement->fetchAll();
        } catch (Exception $e) {
            die("Erreur getMonster : " . $e->getMessage());
        }

        if(count($results) > 0){
            $row = $results[0];

            $res = new Fighter($row["monster_name"], $row["monster_HP"], $row["monster_HP"], $row["monster_mana"], $row["monster_mana"], $row["monster_initiative"], $row["monster_strength"]);
            
            return $res;
        } else {
            die(print_r($results));
            return NULL;
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
}

?>