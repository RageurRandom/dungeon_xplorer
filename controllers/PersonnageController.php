<?php
class PersonnageController {
    
    /**
     * permet de créer un héro, de l'inséerer dans la base de donnée et de le récupérer
     */
    public function createHero() {
        session_start(); 

        //Si on n'est pas connecté
        if(!isset($_SESSION["connected"]) || !$_SESSION["connected"]){
            //On envoie vers la page de cnnexion
            header("Location: /dx_11/connexion"); 
        }//Si on n'est pas connecté

        //si les champs de création ne sont pas renseignés
        else if(!isset($_POST["heroClass"]) || !isset($_POST["heroName"]))
            //On demande de les renseigner
            require_once 'views/personnage/creationPersonnage.php';
        
        //Si les champs sont renseignés et que l'utilisateur n'a pas de héro
        else{

            //On récupère les informations de l'héro à créer
            $heroClass = strtoupper($_POST["heroClass"]); 
            $heroName = strtoupper($_POST["heroName"]); 

            //On insère le nouvel héro dans la base de donnée
            $this->addHero($heroClass, $heroName); 
            $_SESSION["hasHero"] = true; 

            //On récupère alors le héro crée
            header("Location: /dx_11/recuperationHero");
        }//Si les champs sont renseignés et que l'utilisateur n'a pas de héro

    }//fonction createHero


    /**
     * permet de récupérer le Hero de l'utilisateur actuel 
     */
    public function getHero(){
        session_start(); 
        require_once "autoload.php"; 

        //Si on n'est pas connecté
        if(!isset($_SESSION["connected"]) || !$_SESSION["connected"]){
            //On envoie vers la page de cnnexion
            header("Location: /dx_11/connexion"); 
        }//Si on n'est pas connecté
 
        //Si on est connecté et qu'on n'a pas de personnage récupéré 
        else{

            //On vérifie que cet utilisateur a bien un héro dans la base de donné
            $DB = DataBase::getInstance(); 
            $userMail = strtoupper($_SESSION["userMail"]); 

            $query = "select count(*) nb from user where hero_id is not null and upper(user_mail) = '$userMail'"; 
            $statement = $DB->unprepared_statement($query); 
            $result = $statement->fetchAll(); 

            //Si l'utilisateur ne possède pas un héro dans la base de donnée
            if($result[0]["nb"] == 0){
                //On créer un nouvel héro
                header("Location: /dx_11/creationHero"); 
            }//Si l'utilisateur ne possède pas un héro dans la base de donnée

            //Si l'utilisateur possède déjà un héro dans la base de donnée 
            else{
                
                //On récpère ses informations
                $query = "select * from user 
                            join hero using(hero_id)
                            join level using (level_num, class_id)
                            join class using (class_id) 
                            where upper(user_mail) = '$userMail'"; 
                $statement = $DB->unprepared_statement($query); 
                $result = $statement->fetchAll(); 

                //On stocke ses infos dans des variables
                $_id = $result[0]["hero_id"];
                $_level = $result[0]["level_num"]; 
                $_chapter = $result[0]["chapter_num"];
                $_name = $result[0]["hero_name"];
                $_hp = $result[0]["hero_HP"];
                $_max_hp = $result[0]["hero_max_HP"];
                $_xp = $result[0]["hero_XP"];
                $_mana = $result[0]["hero_mana"];
                $_max_mana = $result[0]["hero_max_mana"];
                $_strength = $result[0]["hero_strength"];
                $_initiative = $result[0]["hero_initiative"];
                $_class = $result[0]["class_name"];
                $_treasure =  $result[0]["hero_treasure"];

                //On crée une instece de héro 
                $hero = Factory::heroInstance($_id, $_level, $_chapter, $_name, $_hp, $_max_hp, $_xp, $_mana, $_max_mana, $_strength, $_initiative, $_treasure, $_class); 

                //On récupère ses items 
                $query = "select * from inventory 
                            join hero using(hero_id)
                            join item using (item_id)
                            where hero_id = $_id"; 
                $statement = $DB->unprepared_statement($query); 
                $result = $statement->fetchAll();
                

                //On créee ls items et on les ajoute à l'inventaire
                $item = null; 
                foreach($result as $lineNum => $line){
                    $item = Factory::itemInstance($line["item_id"], $line["item_weight"], $line["item_name"], $line["item_desc"], $line["item_size"], $line["item_quantity"]); 
                    $hero->collecteItem($item); 
                }//On créee ls items et on les ajoute à l'inventaire

                //On récupère ses spells 
                $query = "select * from spell_book 
                            join hero using(hero_id)
                            join spell using (spell_id)
                            where hero_id = $_id"; 
                $statement = $DB->unprepared_statement($query); 
                $result = $statement->fetchAll();
                
                //On créee les spells et on les ajoute à au spell book
                $spell = null; 
                foreach($result as $lineNum => $line){
                    $spell = Factory::spellInstance($line["spell_id"], $line["spell_name"], $line["spell_mana"]); 
                    $hero->collecteSpell($spell); 
                }//On créee les spells et on les ajoute à au spell book

                //On stock l'héro 
                $_SESSION["hero"] = $hero; 

                //On va au chapitre en cours
                header("Location: /dx_11/chapitre"); 

            }//Si l'utilisateur possède déjà un héro dans la base de donnée

        }//Si on est connecté et qu'on n'a pas de personnage récupéré 
    }//fonction getHero()


    /**
     * insère un nouvel héro dans la base de donnée pour l'utilisateur connecté
     * @param string $heroClass nom de la classe de l'héro à insérer
     * @param string $heroName nom de l'héro
     */
    public function addHero($heroClass, $heroName){

        $DB = DataBase::getInstance(); 
        $userMail = $_SESSION["userMail"]; 

        //On récupère les inofs de la classe
        $query = "select * from class where upper(class_name) = '$heroClass'"; 
        $statement = $DB->unprepared_statement($query); 
        $classInfos = $statement->fetchAll();
        //on les stock dans des variables
        $classID = $classInfos[0]["class_id"]; 
        $classHP = $classInfos[0]["class_starting_HP"]; 
        $classMana = $classInfos[0]["class_starting_mana"]; 
        $classInitiative = $classInfos[0]["class_starting_intitiative"]; 
        $classStrength = $classInfos[0]["class_starting_strength"];

        //On récupère l'ID de lho à inserer
        $query = "select max(hero_id) max from hero"; 
        $statement = $DB->unprepared_statement($query); 
        $result = $statement->fetchAll(); 
        if(count($result) == 0)
            $heroID = 1; 
        else
            $heroID = $result[0]["max"]+1; 

        //On insère le héro avec les informations renseignés et rcupérées
        $query = "insert into hero (hero_id, class_id, level_num, chapter_num, hero_name, hero_HP, hero_max_HP, hero_XP, hero_mana, hero_max_mana, hero_strength, hero_initiative, hero_treasure) 
                        values ($heroID, $classID, 1, 1, '$heroName', $classHP, $classHP, 0, $classMana, $classMana, $classStrength, $classInitiative, 0)"; 
        $nbLines = $DB->excute($query);

        if($nbLines == 0)
            die("impossible d'insérer le héro dans la base de donnée");
        else if($nbLines > 1)
            die("une erreure s'est produite");

        //On insère le hero dans la table user
        $query = "update user set hero_id = $heroID where upper(user_mail) = '$userMail'"; 
        $nbLines = $DB->excute($query); 

        if($nbLines == 0)
            die("impossible d'associer l'héro à l'utilisateur");
        else if($nbLines > 1)
            die("une erreure s'est produite");

    }//fontion addHero()

}
?>