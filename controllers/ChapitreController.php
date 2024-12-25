<?php
class ChapitreController {
    
    /**
     * permet de récupérer le infos du chapitre actuel du joueur et de les afficher
     */
    public function showChapter() {
        session_start(); 

        //si on n'est pas connecté
        if(!isset($_SESSION["connected"]) || !($_SESSION["connected"] === true)){ 
            header("Location: /dx_11/connexion");
        }//si on n'est pas connecté

        //Si aucun hero n'est récupéré
        else if(!isset($_SESSION["hero"])){
            header("Location: /dx_11/recuperationHero");
        }//Si aucun hero n'est récupéré

        //Si on est connecté et qu'on a un hero récupéré
        else{

            //On stock le hero 
            $hero = $_SESSION["hero"]; 

            //On récupère les infos du chapitre
            $chapterInfos = $this->getChapter($hero->getChapter());  

            //On récupère les liens du chapitre 
            $links = $this->getLinks($hero->getChapter());
            
            //On affiche le tout
            require_once 'views/chapitre.php';
        }//Si on est connecté et qu'on a un hero récupéré
            
    }//fonction showChapter(); 

    /**
     * fait le traitement nécessaire lorsque l'utilisateur fait un choix dans un chapitre
     * @param int $nextChap numéro du chapitre auquel renvoie le choix
     * @param int $linkTreasure quantité de trésor gagné gâce à ce choix
     * @param int $linkMonsterID ID du monstre à affronter en faisant ce choix. si 0 alors aucun monstre n'est à affronter
     * @param int $itemID l'id de l'item à récupérer en faiseant ce choix. 0 si aucun item n'est à récupéré
     * @param int spellID l'id du sort à récupérer en faiseant ce choix. 0 si aucun item n'est à récupéré
     */
    public function nextChapter($nextChap, $linkTreasure, $linkMonsterID, $itemID, $spellID){ 
        
        session_start(); 
        //si on n'est pas connecté
        if(!isset($_SESSION["connected"]) || !($_SESSION["connected"] === true)){ 
            header("Location: /dx_11/connexion");
        }//si on n'est pas connecté

        //Si aucun hero n'est récupéré
        else if(!isset($_SESSION["hero"])){
            header("Location: /dx_11/recuperationHero");
        }//Si aucun hero n'est récupéré

        $hero = $_SESSION["hero"];

        //Si il n' y a pas de lien entre le cahpitre actuel et le chapitre vers lequel on essaye d'aller
        if(!$this->linkExists($hero->getChapter(), $nextChap))
            throw new Exception("vous ne pouvez pas accéder à ce chapitre depuis votre chapitre actuel"); 

        //Si on est connecté et qu'on a un hero de récupéré
        else{

            //S'il y a un item  à récupérer
            if($itemID > 0){
                //On le récupère de la BDD
                $DB = DataBase::getInstance(); 
                $query = "select * from item where item_id = $itemID"; 
                $statement = $DB->unprepared_statement($query); 
                $result = $statement->fetchAll();

                if(count($result) <= 0)
                    throw new Exception("nextChapter() : impossible de trouver l'item $itemID dans la BDD"); 

                //On instancie l'item et on l'ajoute
                $item = Factory::itemInstance($result[0]["item_id"], $result[0]["item_weight"], $result[0]["item_name"], $result[0]["item_desc"], $result[0]["item_size"], 1);  
                $hero->collecteItem($item); 
            }//S'il y a un item  à récupérer

            //S'il y a un sort à récupérer
            if($spellID > 0){
                //On le récupère de la BDD
                $DB = DataBase::getInstance(); 
                $query = "select * from spell where spell_id = $spellID"; 
                $statement = $DB->unprepared_statement($query); 
                $result = $statement->fetchAll();

                //On instancie l'item 
                $spell = Factory::spellInstance($result[0]["spell_id"], $result[0]["spell_name"], $result[0]["spell_mana_cost"]);  
                $hero->collecteSpell($spell); 
            }//S'il y a un sort à récupérer

            //Si un monstre est à affronter
            if($linkMonsterID > 0){
                //On fait le combat 
                $battleWon = $this->faceMonster($linkMonsterID); 

                //si le combat est gagné 
                if($battleWon){
                    //On passe au chapitre suivant
                    $this->nextChapter($nextChap, $linkTreasure, 0, $itemID, $spellID); 
                }//si le combat est gagné 
                
                //si le combat n'est pas gagné
                else{
                    //On recommence depuis le début
                    header("Location: /dx_11/reinitialisationHero"); 
                }//si le combat n'est pas gagné

            }//Si un monstre est à affronter
            
            //S'il n'y a pas de monstre à affronter
            else{

                //On met à jour les infos du héro 
                $this->updateHero($hero, $linkTreasure, $nextChap); 

                //On sauvegarde le hero 
                $this->saveHero(); 

                //On affiche le nouveau chapitre
                header("Location: /dx_11/chapitre"); 

            }//S'il n'y a pas de monstre à affronter

        }//Si on est connecté et qu'on a un hero récupéré

    }//fonction nextChapter()

    /**
     * permet de préparer et de lancer un combat contre le monstre dont l'ID est passé en paramètre
     * @param int $monsterID l'ID du monstre à affronter
     * @return array|bool un tableau conteant les items déposé par le monstre si le combat est gagné, false sinon 
     */
    public function faceMonster($monsterID){
        return true; 
    }

    /**
     * permet de mettre à jour les infos du hero passé en paramètre
     * @param Hero $hero hero à mettre à jour
     * @param int $treasure la quantité de trésor à gagné 
     * @param int $nextChap le nouveau chapitre du hero
     */
    public function updateHero($hero, $treasure, $nextChap){

        $hero->addTreasure($treasure);

        $chapInfos = $this->getChapter($hero->getChapter()); 
        $hero->addXP($chapInfos[0]["chapter_xp"]);  
        $hero->setChapter($nextChap);

        $nextLevelInfos = $this->getLevel($hero->getLevel()+1, $hero->getClass()); 
        if($nextLevelInfos != false && $nextLevelInfos[0]["level_required_xp"] <= $hero->getXP()){
            $hero->levelUp(); 
            $hero->addMaxHP($nextLevelInfos[0]["level_HP_bonus"]); 
            $hero->addHP($nextLevelInfos[0]["level_HP_bonus"]); 
            $hero->addMaxMana($nextLevelInfos[0]["level_mana_bonus"]);
            $hero->addMana($nextLevelInfos[0]["level_mana_bonus"]);
            $hero->addInitiative($nextLevelInfos[0]["level_initiative_bonus"]);
            $hero->addStrength($nextLevelInfos[0]["level_strength_bonus"]);
        } 
        
    }

    /**
     * @param int $levelNum numéro du niveau
     * @param string $class type de l'hero : guerrier, voleur ou magicien
     * @return array|bool tableau contenant le niveau, false si le niveau n'existe pas 
     */
    public function getLevel($levelNum, $class){
        $DB = DataBase::getInstance(); 
        $classID = null; 
        switch($class){
            case "magicien":
                $classID = 3; 
                break; 

            case "voleur":
                $classID = 2; 
                break; 

            case "guerrier":
                $classID = 1; 
                break; 

            default : 
            return false; 
        }

        $query = "select * from level where level_num = $levelNum and class_id = $classID"; 
        $statement = $DB->unprepared_statement($query); 
        $result = $statement->fetchAll();

        if (count($result) > 0) {
            return $result; 
        } else {
            return false;
        }
    }

    /**
     * permet de vérifier si un lien existe entre deux chapitres
     * @param int $currentChap chapitre actuel 
     * @param int $nextChap chapitre suivant
     * @return bool le résultat
     */
    public function linkExists($currentChap, $nextChap){
        $DB = DataBase::getInstance(); 
        $query = "select count(*) nb from link where chapter_num = $currentChap and chapter_num_next = $nextChap"; 
        $statement = $DB->unprepared_statement($query); 
        $result = $statement->fetchAll();

        if($result[0]["nb"] == 0)
            return false; 

        return true; 
    }//fonction linkExists()

    /**
     * @param int $chapter_num numéro du chapitre
     * @return array tableaux avec les différents choix possibles
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
    }//fonction getLinks()

    /**
     * @param int $chapterNum numéro du chapitre
     * @return array tableaux des infos du chapitre
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
    }//fonction getChapter()

    /**
     * affiche toutes les informations du Hero
     * @param Hero $hero le hero à afficher
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

        if($hero->getWeapon() !== null)
        echo "arme : ".$hero->getWeapon()->getName()."<br>"; 

        $inventory = $hero->getInventory();
        if(count($inventory) > 0){
            echo "inventaire : <ul> "; 
            foreach($inventory as $index => $item){
            echo "<li>".$item->getName()." : ".$item->getQuantity()."</li>"; 
            }
            echo "</ul> ";
        }

        $spells = $hero->getSpellBook(); 
        if(count($spells) > 0){
            echo "sorts : <ul> "; 
            foreach($spells as $index => $spell){
            echo "<li>".$spell->getName()."</li>"; 
            }
            echo "</ul> ";
        }
    }//fonction printHero()

    /**
     * affiche tous les liens possibles 
     * @param array $links tableau des liens à afficher
     */
    public function printLinks($links){
        //Pour chaque lien du chapitre actuel
        foreach($links as $index => $link){
            //On récupère ses infos
            $desc = $link['link_desc']; 
            $nextChap = $link["chapter_num_next"];
            $linkTreasure = $link["link_treasure"]; 
            $monsterID = $link["monster_id"] == null ? 0 : $link["monster_id"];
            $itemID = $link["item_id"] == null ? 0 : $link["item_id"];
            $spellID = $link["spell_id"] == null ? 0 : $link["spell_id"];
            //On l'affiche avec possibilité de le choisir 
            echo "<li> <a href='chapitreSuivant/$nextChap/$linkTreasure/$monsterID/$itemID/$spellID'>$desc</a> </li>";
        }
    }//fonction printLinks()

    /**
     * permet d'enregistrer les infos du hero actuel dans la BDD
     */
    public function saveHero(){  
        $DB = DataBase::getInstance(); 

        //Si on n'est pas connecté
        if(!isset($_SESSION["connected"]) || !$_SESSION["connected"]){
            //On envoie vers la page de cnnexion
            header("Location: /dx_11/connexion"); 
        }//Si on n'est pas connecté

        //si il n'y a pas de Hero stocké dans seession
        if(!isset($_SESSION["hero"])){
            //On le récupère
            header("Location: /dx_11/recuperationHero"); 
        }//si il n'y a pas de Hero stocké dans seession

        //Si on est connecté et qu'on a un hero stocké dans la session
        else{

            //On récupère les infos 
            $hero = $_SESSION["hero"]; 
            $heroID = $hero->getID();  
            $levelNum = $hero->getLevel(); 
            $ChapterNum = $hero->getChapter(); 
            $heroHP = $hero->getCurrentHP(); 
            $heroMaxHP = $hero->getMaxHP(); 
            $heroXP = $hero->getXP();
            $heroMana = $hero->getCurrentMana(); 
            $heroMaxMana = $hero->getMaxMana(); 
            $heroStrength = $hero->getStrength(); 
            $heroInitiative = $hero->getInitiative(); 
            $heroTreasure = $hero->getTreasure(); 
            $heroInventory = $hero->getInventory(); 
            $heroSpellBook = $hero->getSpellBook(); 

            //On met à jour la table hero
            $query = "update hero set 
                        level_num = $levelNum,
                        chapter_num = $ChapterNum,
                        hero_HP = $heroHP,
                        hero_max_HP = $heroMaxHP,
                        hero_XP = $heroXP,
                        hero_mana = $heroMana,
                        hero_max_mana = $heroMaxMana,
                        hero_strength = $heroStrength,
                        hero_initiative = $heroInitiative,
                        hero_treasure = $heroTreasure
                        where hero_id = $heroID"; 
            $nbLines = $DB->excute($query); 

            //si la mise à jour de hero est impossible
            if($nbLines != 1){
                throw new Exception("impossible de sauvegarder la table hero"); 
            }//si la mise à jour de hero est impossible

            //On met à jour la table inventory
            $query = "delete from inventory where hero_id = $heroID"; 
            $nbLines = $DB->excute($query);
            foreach($heroInventory as $index => $item){
                $itemID = $item->getID(); 
                $itemQuantity = $item->getQuantity(); 
                $query = "insert into inventory (hero_id, item_id, item_quantity) values ($heroID, $itemID , $itemQuantity)"; 
                $nbLines = $DB->excute($query);
                if($nbLines != 1){
                    throw new Exception("impossible de sauvegarder l'item $itemID");
                }
            }//On met à jour la table inventory

            //On met à jour la table spell
            $query = "delete from spell_book where hero_id = $heroID"; 
            $nbLines = $DB->excute($query);
            foreach($heroSpellBook as $index => $spell){
                $spellID = $spell->getID();  
                $query = "insert into spell_book (hero_id, spell_id) values ($heroID, $spellID)"; 
                $nbLines = $DB->excute($query);
                if($nbLines != 1){
                    throw new Exception("impossible de sauvegarder le spell $spellID");
                }
            }//On met à jour la table inventory

            //On revient au chapitres 
            header("Location: /dx_11/chapitre"); 

        }//Si on est connecté et qu'on a un hero stocké dans la session
    }//fonction saveHero()
}
?>