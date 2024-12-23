<?php
class ChapitreController {
    //regarder si l'utilisateur et connnectée

    public function index() {
        require_once 'views/chapitre.php';
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