<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Combat</title>
    <!--CSS requis-->
</head>
<body>
    
<?php
    if(isset($_POST["action"])){
        echo "<h1>".$_POST["action"]." effectué</h1>";
    } else {
        echo "<h1>Un adversaire approche !</h1>";
    }
    
    $heros = $_SESSION["hero"];
    $monster = $_SESSION["monster"];

    
    //affichage noms CSS REQUIS
        echo "<div class=\"containeur_combat\"><div class = \"monstre\"><h2>" . $monster->getName() . "</h2>"
        . "<div>" . $monster->getCurrentHP() . "/" . $monster->getMaxHP() . " HP </div>"
        . "<div>" . $monster->getCurrentMana() . "/" . $monster->getMaxMana() . " Mana </div> </div>";

        echo "<div class = \"heros\"><h2>" . $heros->getName() . "</h2>"
        . "<div>" . $heros->getCurrentHP() . "/" . $heros->getMaxHP() . " HP </div>"
        . "<div>" . $heros->getCurrentMana() . "/" . $heros->getMaxMana() . " Mana </div> "
        . "<div>" . $heros->getInitiative() . " Initiative </div> " . "</div> </div>";
    
?>

<!--ACTIONS-->

<div><!--br tempo en attendant css--><br>Votre tour : </div>
<form action="/dx_11/combat" method="post">
    <div>
        <input type="radio" id="attack" name="action" value="attack" required><label for="attack">Attaque</label>
    </div>

    <?php
    //affichage des sorts

        $spellArr = $heros->getSpellBook() ;
        foreach($spellArr as $spell){
            $name = $spell->getName();

            $option = "";
            if($spell->getCost() > $heros->getCurrentMana()){
                $option .= "disabled";
            }

            echo "<div><input type=\"radio\" id=\"$name\" name=\"action\" value=\"" . $spell->getType() ."_" . $spell->getID() . "\" $option><label for=\"$name\">$name (".$spell->getCost()." Mana)</label></div>";
            
            
        }

        $itemArr = $heros->getInventory();
        
        foreach($itemArr as $item){
            
            if($item->getType() === "potion"){
                $name = $item->getName();
                echo "<div><input type=\"radio\" id=\"$name\" name=\"action\" value=\"potion_" . $item->getID() . "\" ><label for=\"$name\">$name x ". $item->getQuantity() . "</label></div>"; //rajouter peut-être les pts de HP/Mana regen

            }
        }

        
    ?>

    <div>
        <h3>Equipements</h3>
        <label for="weapon">Arme : </label>
        
            <?php

                echo "<select name=\"weapon\" id=\"weapon\">";

                //equipement actuel
                $equippedWeap = $heros->getWeapon();

                $itemArr = $heros->getInventory();
                if(isset($equippedWeap)){
                    echo "<option value=\"current\">" . $equippedWeap->getName() . "</option>";
                } else {
                    echo "<option value=\"current\">Aucune</option>";
                }
                
                
                    foreach($itemArr as $item){
                        if(isset($item) && $item->getType() === "arme" && (!isset($equippedWeap) || $item->getId() != $equippedWeap->getId())){
                        
                            echo "<option value=\"". $item->getID() ."\">" . $item->getName() . " : " . $item->getAttackValue() . " dégâts</option>";
                        }
                    }
                

                echo "</select>";
            ?>

            <label for="armor">Armure : </label>

            <?php

                echo "<select name=\"armor\" id=\"armor\">";

                //equipement actuel
                $equippedArm = $heros->getArmor();

                if(isset($equippedArm)){
                    echo "<option value=\"current\">" . $equippedArm->getName() . "</option>";
                } else {
                    echo "<option value=\"current\">Aucune</option>";
                }
                
                
                foreach($itemArr as $item){
                    if(isset($item) && $item->getType() === "amure" && (!isset($equippedArm) || $item->getId() != $equippedArm->getId())){
                        echo "<option value=\"". $item->getID() ."\">" . $item->getName() . " : " . $item->getDefenseValue() . " defense</option>";
                    }
                }

                echo "</select>";

                // bouclier

                if($heros->getClass() === "guerrier"){
                    echo "<label for=\"shield\">Bouclier : </label>";
                    echo "<select name=\"shield\" id=\"shield\">";

                    //equipement actuel
                    $equippedSh = $heros->getShield();

                    if(isset($equippedSh)){
                        echo "<option value=\"current\">" . $equippedSh->getName() . "</option>";
                    } else {
                        echo "<option value=\"current\">Aucune</option>";
                    }
                    
                    
                    foreach($itemArr as $item){
                        if(isset($item) && $item->getType() === "bouclier" && (!isset($equippedSh) || $item->getId() != $equippedSh->getId())){
                            echo "<option value=\"". $item->getID() ."\">" . $item->getName() . " : " . $item->getDefenseValue() . " defense</option>";
                        }
                    }
                    

                    echo "</select>";
                }
            ?>
    </div>

    <input type="submit">
</form>

</body>
</html>