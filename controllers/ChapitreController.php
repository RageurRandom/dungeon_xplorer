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
            $chapterInfos = DataBase::getChapter($hero->getChapter());  

            //On récupère les liens du chapitre 
            $links = DataBase::getLinks($hero->getChapter());
            
            //On affiche tout
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
        if(!DataBase::linkExists($hero->getChapter(), $nextChap))
            die("vous ne pouvez pas accéder à ce chapitre depuis votre chapitre actuel"); 

        //Si on est connecté et qu'on a un hero de récupéré
        else{

            //S'il y a un item  à récupérer
            if($itemID > 0){
                //On le récupère de la BDD
                $result = DataBase::getItem($itemID);
                //On instancie l'item et on l'ajoute
                $item = Factory::itemInstance($result[0]["item_id"], $result[0]["item_weight"], $result[0]["item_name"], $result[0]["item_desc"], $result[0]["item_size"], 1);  
                $hero->collecteItem($item); 
            }//S'il y a un item  à récupérer

            //S'il y a un sort à récupérer
            if($spellID > 0){
                //On le récupère de la BDD
                $result = DataBase::getSpell($spellID);
                //On instancie le sort et on l'ajoute
                $spell = Factory::spellInstance($result[0]["spell_id"], $result[0]["spell_name"], $result[0]["spell_mana_cost"]);  
                $hero->collecteSpell($spell); 
            }//S'il y a un sort à récupérer

            //Si un monstre est à affronter
            if($linkMonsterID > 0){

                //si le combat a déjà été fait 
                if(isset($_POST["battleWon"])){

                    //Si le combat est gagné
                    if($_POST["battleWon"])
                        //On passe au chapitre suivant
                        $this->nextChapter($nextChap, $linkTreasure, 0, $itemID, $spellID);

                    //Si le combat est perdu    
                    else
                        //On recommence depuis le début
                        header("Location: /dx_11/reinitialisationHero");

                }//si le combat a déjà été fait 

                //Si le combat n'a pas déjà été fait
                else{
                    $_SESSION["combatChap"] = $nextChap; $_SESSION["combatTreasure"] = $linkTreasure;  $_SESSION["combatMonster"] = $linkMonsterID;
                    $_SESSION["combatItem"] = $itemID; $_SESSION["combatSpell"] = $spellID; $_SESSION["monster"] = DataBase::getMonster($linkMonsterID);
                    //On le fait 
                    require_once "views/combat.php";
                }//Si le combat n'a pas déjà été fait

            }//Si un monstre est à affronter
            
            //S'il n'y a pas de monstre à affronter
            else{
                //On met à jour les infos du héro 
                $this->updateHero($hero, $linkTreasure, $nextChap); 

                //On sauvegarde le hero dans la bdd
                DataBase::saveHero($hero); 

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

        $chapInfos = DataBase::getChapter($hero->getChapter()); 
        $hero->addXP($chapInfos[0]["chapter_xp"]);  
        $hero->setChapter($nextChap);

        $nextLevelInfos = DataBase::getLevel($hero->getLevel()+1, $hero->getClass()); 
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

}
?>