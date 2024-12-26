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

    if(!isset($heros)){
        //problème
        die("Erreur : Cet héros n'existe pas dans la base de données");
    }

    

    $monster = $_SESSION["combatMonster"];

    if(!isset($monster)){
        //problème
        die("Erreur : Ce monstre n'existe pas dans la base de données");
    }


    
    //affichage noms CSS REQUIS
        echo "<div class=\"containeur_combat\"><div class = \"monstre\"><h2>" . $monster->getName() . "</h2>"
        . "<div>" . $monster->getCurrentHP() . "/" . $monster->getMaxHP() . " HP </div>"
        . "<div>" . $monster->getCurrentMana() . "/" . $monster->getMaxMana() . " Mana </div> </div>";

        echo "<divclass = \"heros\"><h2>" . $heros->getName() . "</h2>"
        . "<div>" . $heros->getCurrentHP() . "/" . $heros->getMaxHP() . " HP </div>"
        . "<div>" . $heros->getCurrentMana() . "/" . $heros->getMaxMana() . " Mana </div> "
        . "<div>" . $heros->getCurrentMana() . " Initiative </div> " . "</div> </div>";
    
?>

<!--ACTIONS-->

<div><!--br tempo en attendant css--><br>Votre tour : </div>
<form action="/dx_11/combat" method="post">
    <div>
        <input type="radio" id="attack" name="action" value="attack" required><label for="attack">Attaque</label>
    </div>

    <?php
    //affichage des sorts

        $arr = $heros->getSpellBook() ;
        foreach($arr as $spell){
            $name = $spell->getName();
            if($spell->getCost() > $heros->getCurrentMana()){
                //sort trop couteux
                echo "<div><input type=\"radio\" id=\"$name\" name=\"action\" value=\"err_". $spell->getID() ."\" disabled><label for=\"$name\">$name (".$spell->getCost()." Mana)</label></div>";
            } else {
                echo "<div><input type=\"radio\" id=\"$name\" name=\"action\" value=\"spell_" . $spell->getID() . "\"><label for=\"$name\">$name (".$spell->getCost()." Mana)</label></div>";
            }
            
        }
    ?>

    <input type="submit">
</form>

</body>
</html>