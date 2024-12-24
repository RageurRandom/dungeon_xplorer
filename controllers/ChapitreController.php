<?php
class ChapitreController {
    //regarder si l'utilisateur et connnectée

    public function index() {
        session_start(); 

        //si on n'est pas connecté
        if(!isset($_SESSION["connected"]) || !($_SESSION["connected"] === true)){ 
            header("Location: /dx_11/connexion");
        }//si on n'est pas connecté

        //Si aucun hero n'est récupéré
        else if(!isset($_SESSION["hero"])){
            header("Location: /dx_11/recuperationHero");
        }//Si aucun hero n'est récupéré

        //Si on est connecté et qu'on a un hero de récupéré
        else{

            //On récupère le hero 
            $hero = $_SESSION["hero"]; 


            //On récupère les infos du chapitre
            $chapterInfos = $this->getChapter($hero->getChapter());  

            //On récupère les liens du chapitre 
            $links = $this->getLinks($hero->getChapter());
            
            //On affiche le tout
            require_once 'views/chapitre.php';
        }
            
    }

    /**
     * @param int chapter_num numéro du chapitre
     * @return string liste HTML (ul) avec les différents choix
     */
    public function getLinks($chapter_num){
        try{
            $DB = DataBase::getInstance();
            $querry = "SELECT * FROM link WHERE chapter_num = ?";

            $statement = $DB->prepare_statement($querry);
            $statement->bindParam(1, $chapter_num);
            $statement->execute();
            $result = $statement->fetchAll();

        } catch(Exception $e){
            die("erreur getLinks : ".$e->getMessage());
        }

        if (count($result) > 0) {
            return $result; 
        } else {
            return "No link found for chapter " . $chapter_num;
        }
    }

    /**
     * @param int chapter_num numéro du chapitre
     * @return string contenu du chapitre
     */
    public function getChapter($chapterNum) {

        try{
            // Query to get chapter content
            $DB = DataBase::getInstance();
            $querry = "SELECT * FROM chapter WHERE chapter_num = $chapterNum";
            $statement = $DB->unprepared_statement($querry);
            $result = $statement->fetchAll();

        }catch(Exception $e){
            die("erreur getChapitre : " . $e->getMessage());
        }

        if (count($result) > 0) {
            return $result;
        } else {
            return "No content found for chapter " . $chapterNum;
        }
    }

    /**
     * affiche toutes les informations du Hero
     * @param Hero le hero à afficher
     */
    public function printHero($hero){

        echo "nom du hero : ".$hero->getName()."<br>
        type : ".$hero->getClass()."<br>
        PV : ".$hero->getCurrentHP()."/".$hero->getMaxHP()."<br>
        mana : ".$hero->getCurrentMana()."/".$hero->getMaxMana()."<br>
        initiative : ".$hero->getInitiative()."<br>
        force : ".$hero->getStrength()."<br>
        XP : ".$hero->getXP()."<br>
        niveau : ".$hero->getLevel()."<br>";

        if($hero->getArmor() !== null)
        echo "armure : ".$hero->getArmor()->getName()."<br>";

        if($hero->getArmor() !== null)
        echo "arme : ".$hero->getWeapon()->getName()."<br>"; 

        $inventory = $hero->getInventory(); 
        if(isset($inventory) && count($inventory) > 0){
            echo "inventaire : <ul> "; 
            foreach($inventory as $index => $item){
            echo "<li>".$item->getName()."</li>"; 
            }
            echo "</ul> ";
        }

        $spells = $hero->getSpellBook(); 
        if(isset($spells) && count($spells) > 0){
            echo "sorts : <ul> "; 
            foreach($spells as $index => $spell){
            echo "<li>".$spell->getName()."</li>"; 
            }
            echo "</ul> ";
        }
    }


    public function printLinks($links){
        //Pour chaque lien du chapitre actuel
        foreach($links as $index => $link){
            //On récupère ses infos
            $desc = $link['link_desc']; 
            $nextChap = $link["chapter_num_next"];
            $linkTreasure = $link["link_treasure"]; 
            $monsterID = $link["monster_id"] == null ? 0 : $link["monster_id"];

            //On l'affiche avec possibilité de le choisir 
            echo "<li> <a href='nextChapter/$nextChap/$linkTreasure/$monsterID'>$desc</a> </li>";
        }
    }
}
?>