<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Combat</title>
</head>
<body>
    
<?php
    $controller = new CombatController();
    $monster_test = $controller->getMonster(2); //pour les tests
    
    if(!isset($_SESSION["hero"])){
        $_SESSION["hero"] = new Warrior(0, 1, 1, "Sir Alain Juppé", 7, 10, 12, 0, 0, 5, 3, 0); //tj pour les tests
    }

    if(!isset($monster_test)){
        //problème
        die("Erreur : Ce monstre n'existe pas dans la base de données");
    }


    
        echo "<div><h2>" . $monster_test->getName() . "</h2>"
        . "<div>" . $monster_test->getCurrentHP() . "/" . $monster_test->getMaxHP() . " HP </div>"
        . "<div>" . $monster_test->getCurrentMana() . "/" . $monster_test->getMaxMana() . " Mana </div> </div>";

        echo "<div><h2>" . $_SESSION["hero"]->getName() . "</h2>"
        . "<div>" . $_SESSION["hero"]->getCurrentHP() . "/" . $_SESSION["hero"]->getMaxHP() . " HP </div>"
        . "<div>" . $_SESSION["hero"]->getCurrentMana() . "/" . $_SESSION["hero"]->getMaxMana() . " Mana </div> </div>";
    
?>
<div>Votre tour : </div>
<button>Attaque</button>
</body>
</html>