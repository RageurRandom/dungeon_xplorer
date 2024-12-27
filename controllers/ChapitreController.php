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

        //Si il n' y a pas de lien entre le chapitre actuel et le chapitre vers lequel on essaye d'aller
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
                $_SESSION["combatChap"] = $nextChap; $_SESSION["combatTreasure"] = $linkTreasure; $_SESSION["monster"] = Factory::monsterInstance($linkMonsterID);
                //On le fait 
                header("Location: /dx_11/combat");
            }//Si un monstre est à affronter

            //S'il n'y a aucun monstre à affronter
            else{
                //On met à jour les infos du héro 
                $this->updateHero($hero, $linkTreasure, $nextChap); 

                //On sauvegarde le hero dans la bdd
                DataBase::saveHero($hero); 

                //On affiche le nouveau chapitre
                header("Location: /dx_11/chapitre"); 
            }//S'il n'y a aucun monstre à affronter

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
        echo '<div class="justify-content-center align-items-center d-flex">';
        echo '<button class="btn btn-primary btn-lg btn-light m-3" id="heroInfoButton">Info héros</button>';
        echo '<button class="btn btn-primary btn-lg btn-light m-3" id="inventoryButton">Inventaire</button>';
        echo '<button class="btn btn-primary btn-lg btn-light m-3" id="spellsButton">Sorts</button>';
        echo '</div>';

        echo '<div id="heroInfoModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Informations du héros</h2>';
        echo "Nom du héros : ".$hero->getName()."<br>
              Type : ".$hero->getClass()."<br>
              PV : ".$hero->getCurrentHP()."/".$hero->getMaxHP()."<br>
              Mana : ".$hero->getCurrentMana()."/".$hero->getMaxMana()."<br>
              Initiative : ".$hero->getInitiative()."<br>
              Force : ".$hero->getStrength()."<br>
              XP : ".$hero->getXP()."<br>
              Niveau : ".$hero->getLevel()."<br>";

        if($hero->getArmor() !== null)
            echo "Armure : ".$hero->getArmor()->getName()."<br>";

        if($hero->getWeapon() !== null)
            echo "Arme : ".$hero->getWeapon()->getName()."<br>"; 

        echo '  </div>
              </div>';

        echo '<div id="inventoryModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Inventaire</h2>';

        $inventory = $hero->getInventory();
        if(count($inventory) > 0){
            echo "<ul>"; 
            foreach($inventory as $index => $item){
                echo "<li>".$item->getName()." : ".$item->getQuantity()."</li>"; 
            }
            echo "</ul>";
        } else {
            echo "<p>Inventaire vide</p>";
        }

        echo '  </div>
              </div>';

        echo '<div id="spellsModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Sorts</h2>';

        $spells = $hero->getSpellBook(); 
        if(count($spells) > 0){
            echo "<ul>"; 
            foreach($spells as $index => $spell){
                echo "<li>".$spell->getName()."</li>"; 
            }
            echo "</ul>";
        } else {
            echo "<p>Aucun sort</p>";
        }

        echo '  </div>
              </div>';
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