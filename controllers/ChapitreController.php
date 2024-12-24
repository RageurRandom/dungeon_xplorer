<?php
class ChapitreController {
    //regarder si l'utilisateur et connnectée

    public function index() {
        if(isset($_SESSION["connected"]) && $_SESSION["connected"] === true){ //connecté
            
            // a décommenter une fois que les tests sont finis et qu'on peut créer un heros
            
            if(!isset($_SESSION["hero"])){
                //héros pas créé
                //header("Location: /dx_11/creationHero");
                echo "redirection vers création heros";
            }
            // utilisateur connecté et heros créé
            
            echo "tout bon";
            
        } else {
            //pas de connexion
            //header("Location: /dx_11/connexion");
            echo "redirection vers connexion";
        }
        
        require_once 'views/chapitre.php';
    }

    /**
     * @param int chapter_num numéro du chapitre
     * @return string liste HTML (ul) avec les différents choix
     */
    public function getLinks($chapter_num){
        try{
            $DB = DataBase::getInstance();
            $querry = "SELECT chapter_num_next, link_desc FROM link WHERE chapter_num = ?";

            $statement = $DB->prepare_statement($querry);
            $statement->bindParam(1, $chapter_num);
            $statement->execute();
            $result = $statement->fetchAll();

        } catch(Exception $e){
            die("erreur getLinks : ".$e->getMessage());
        }

        if (count($result) > 0) {
            $res = "<ul>";
            foreach($result as $row){
                $res .= "<li> <a> " . $row['link_desc'] . " </a> </li> ";
            }  

            return $res."</ul>";

        } else {
            return "No content found for chapter " . $chapter_num;
        }
    }

    /**
     * @param int chapter_num numéro du chapitre
     * @return string contenu du chapitre
     */
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