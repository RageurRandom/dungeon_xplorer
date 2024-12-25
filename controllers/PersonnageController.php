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
        
        //Si les champs sont renseignés et qu'on est connecté
        else{

            //On récupère les informations de l'héro à créer
            $heroClass = strtoupper($_POST["heroClass"]); 
            $heroName = strtoupper($_POST["heroName"]); 

            //On insère le nouvel héro dans la base de donnée
            DataBase::addHero($heroClass, $heroName); 
            $_SESSION["hasHero"] = true; 

            //On récupère alors le héro crée
            header("Location: /dx_11/recuperationHero");
        }//Si les champs sont renseignés et qu'on est connecté

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

        //Si un hero est déjà récupéré
        else if(isset($_SESSION["hero"])){
            header("Location: /dx_11/chapitre");
        }//Si un hero est déjà récupéré
 
        //Si on est connecté et qu'on n'a pas de personnage récupéré 
        else{

            //On vérifie que cet utilisateur a bien un héro dans la base de donné
            $DB = DataBase::getInstance(); 
            $userMail = strtoupper($_SESSION["userMail"]); 

            $hasHero = DataBase::hasHero($userMail); 
            //Si l'utilisateur ne possède pas un héro dans la base de donnée
            if(!$hasHero){
                //On créer un nouvel héro
                header("Location: /dx_11/creationHero"); 
            }//Si l'utilisateur ne possède pas un héro dans la base de donnée

            //Si l'utilisateur possède déjà un héro dans la base de donnée 
            else{
                
                //On récpère ses informations
                $result = DataBase::getHero($userMail); 
                //On stocke ses infos dans des variables
                $_id = $result[0]["hero_id"]; $_level = $result[0]["level_num"]; $_chapter = $result[0]["chapter_num"];
                $_name = $result[0]["hero_name"]; $_hp = $result[0]["hero_HP"]; $_max_hp = $result[0]["hero_max_HP"];
                $_xp = $result[0]["hero_XP"]; $_mana = $result[0]["hero_mana"]; $_max_mana = $result[0]["hero_max_mana"];
                $_strength = $result[0]["hero_strength"]; $_initiative = $result[0]["hero_initiative"]; $_class = $result[0]["class_name"];
                $_treasure =  $result[0]["hero_treasure"];

                //On crée une instece de héro 
                $hero = Factory::heroInstance($_id, $_level, $_chapter, $_name, $_hp, $_max_hp, $_xp, $_mana, $_max_mana, $_strength, $_initiative, $_treasure, $_class); 

                //On récupère ses items 
                $result = DataBase::getInventory($_id);
                //On créee les items et on les ajoute à l'inventaire
                $item = null; 
                foreach($result as $lineNum => $line){
                    $item = Factory::itemInstance($line["item_id"], $line["item_weight"], $line["item_name"], $line["item_desc"], $line["item_size"], $line["item_quantity"]); 
                    $hero->collecteItem($item); 
                }//On créee ls items et on les ajoute à l'inventaire

                //On récupère ses spells 
                $result = DataBase::getSpells($_id);
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


}
?>