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
}

?>