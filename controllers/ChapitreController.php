<?php
class ChapitreController {
    //regarder si l'utilisateur et connnectée

    public function index() {
        if(isset($_SESSION["hero"])){
            require_once 'views/chapitre.php';
        } else {
            //pas de connexion
            header("Location: /dx_11/connexion");
        }
        

    }

    public function getLinks($chapter_num){

    }

    public function getChapitre($chapter_num) {

        try{
            // Query to get chapter content
            $DB = DataBase::getInstance();
            $querry = "SELECT chapter_content FROM chapter WHERE chapter_num = ?";

            $statement = $DB->prepare_statement($querry);
            $statement->bindParam(1, $chapter_num);
            $statement->execute();
            $result = $statement->fetchAll();

        }catch(Exception $e){
            die("erreur getChapitre : " . $e->getMessage());
        }

        if (count($result) > 0) {
            $row = $result[0];
            return $row["chapter_content"];
        } else {
            return "No content found for chapter " . $chapter_num;
        }
    }
}
?>