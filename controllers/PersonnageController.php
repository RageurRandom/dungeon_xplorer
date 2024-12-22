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

        //Si cet utilisateur possède déjà un personnage récupéré
        else if(isset($_SESSION["hero"]))
            //On revient à la page d'accueil
            header("Location: /dx_11"); 

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

            //On récupère alors le héro crée
            header("Loction: /dx_11/recuperationPersonnage");
        }//Si les champs sont renseignés et que l'utilisateur n'a pas de héro

    }//fonction createHero


    /**
     * permet de récupérer le Hero de l'utilisateur actuel 
     */
    public function getHero(){
        session_start(); 

        //Si on n'est pas connecté
        if(!isset($_SESSION["connected"]) || !$_SESSION["connected"]){
            //On envoie vers la page de cnnexion
            header("Location: /dx_11/connexion"); 
        }//Si on n'est pas connecté

        //Si cet utilisateur possède déjà un personnage récupéré
        else if(isset($_SESSION["hero"]))
            //On revient à la page d'accueil
            header("Location: /dx_11"); 

        //Si on est connecté et qu'on n'a pas de personnage récupéré 
        else{

            //On vérifie que cet utilisateur a bien un héro dans la base de donné
            $DB = DataBase::getInstance(); 
            $userMail = $_SESSION["userMail"]; 

            $query = "select count(*) nb from user where hero_id is not null and upper(user_mail) = '$userMail'"; 
            $statement = $DB->unprepared_statement($query); 
            $result = $statement->execute(); 

            //Si l'utilisateur ne possède pas un héro dans la base de donnée
            if(intval($result[0]["nb"]) == 0){
                //On créer un nouvel héro
                header("Loction: /dx_11/creationPersonnage"); 
            }//Si l'utilisateur ne possède pas un héro dans la base de donnée

            //Si l'utilisateur possède déjà un héro dans la base de donnée 
            else{
                
                //On récpère ses informations
                $query = "select * from user 
                            join hero using(hero_id)
                            join level using (level_num, class_id)
                            join class using (class_id) 
                            where toUpper(userMail) = '$userMail'"; 
                $statement = $DB->unprepared_statement($query); 
                $result = $statement->execute(); 

                //On stocke ses infos dans des variables
                $_id = $result[0]["hero_id"];
                $_level = $result[0]["level_num"]; 
                $_chapter = $result[0]["chaper_num"];
                $_name = $result[0]["hero_name"];
                $_hp = $result[0]["hero_HP"];
                $_xp = $result[0]["hero_XP"];
                $_mana = $result[0]["hero_mana"];
                $_strength = $result[0]["hero_strength"];
                $_initiative = $result[0]["hero_initiative"];
                $_class = $result[0]["class_name"]; 

                //On crée une instece de héro 
                $hero = $this->heroInstance($_id, $_level, $_chapter, $_name, $_hp, $_xp, $_mana, $_strength, $_initiative, $_class); 

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
                    $item = $this->itemInstance($line["item_id"], $line["item_weight"], $line["item_name"], $line["item_desc"], $line["item_size"]); 
                    $hero->addItem($item); 
                }//On créee ls items et on les ajoute à l'inventaire


                //On revient à la page d'accueil
                print_r($hero); 

            }//Si l'utilisateur possède déjà un héro dans la base de donnée

        }//Si on est connecté et qu'on n'a pas de personnage récupéré 
    }//fonion getHero()

    /**
     * céer et retourne une insence de Hero
     * @return Hero le héro
     */
    public function heroInstance($_id, $_level, $_chapter, $_name, $_hp, $_xp, $_mana, $_strength, $_initiative, $_class){
        
        $_className = strtoupper($_class); 
        $hero = null; 

        switch($_className){

            case "GUERRIER":
                $hero = new Warrior($_id, $_level, $_chapter, $_name, $_hp, $_xp, $_mana, $_strength, $_initiative, $_class); 
                break; 
            
            case "VOLEUR":
                $hero = new Thief($_id, $_level, $_chapter, $_name, $_hp, $_xp, $_mana, $_strength, $_initiative, $_class); 
                break; 

            case "MAGICIEN":
                $hero = new Mage($_id, $_level, $_chapter, $_name, $_hp, $_xp, $_mana, $_strength, $_initiative, $_class); 
                break; 
            
        }

        return $hero; 
    }

    /**
     * crée et retourne une instece de l'item 
     * @return Item l'item
     */
    public function itemInstance($_id, $_weight, $_name, $_desc, $_size){

    }


    /**
     * insère un nouvel héro dans la base de donnée pour l'utilisateur connecté
     * @param string $heroClass nom de la classe de l'héro à insérer
     * @param string $heroName nom de l'héro
     */
    public function addHero($heroClass, $heroName){

        //On vérifie que cet utilisateur n'a pas de héro dans la base de donné
        $DB = DataBase::getInstance(); 
        $userMail = $_SESSION["userMail"]; 

        $query = "select count(*) nb from user where hero_id is not null and upper(user_mail) = '$userMail'"; 
        $statement = $DB->unprepared_statement($query); 
        $result = $statement->fetchAll(); 

        //Si l'utilisateur possède déjà un héro dans la base de donnée
        if(intval($result[0]["nb"]) != 0){
            //On réupère le héro
            header("Loction: /dx_11/recuperationPersonnage"); 
        }//Si l'utilisateur possède déjà un héro dans la base de donnée

        //Si l'utilisateur ne possède pas de héro
        else{
            //On récupère les inofs de la classe
            $query = "select * from class where upper(class_name) = '$heroClass'"; 
            $statement = $DB->unprepared_statement($query); 
            $classInfos = $statement->fetchAll();
            
            $classID = $classInfos[0]["class_id"]; 
            $classHP = $classInfos[0]["class_starting_hp"]; 
            $classMana = $classInfos[0]["class_starting_mana"]; 
            $classInitiative = $classInfos[0]["class_starting_initiative"]; 
            $classStrength = $classInfos[0]["class_starting_strength"];

            //On insère le héro avec les informations renseignés et rcupérées
            $query = "insert into hero values ($classID, 1, 1, '$heroName', $classHP, 0, $classMana, $classStrength, $classInitiative)"; 
            $nbLines = $DB->excute($query); 

            if($nbLines == 0)
                die("impossible d'insérer le héro dans la base de donnée");
            else if($nbLines > 1)
                die("une erreure s'est produite");
            
        }//Si l'utilisateur ne possède pas de héro
    }//fontion addHero()

}
?>