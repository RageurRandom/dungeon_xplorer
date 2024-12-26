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
    $monster_test = DataBase::getMonster(2); //pour les tests
    
    if(!isset($_SESSION["hero"])){
        $_SESSION["hero"] = new Mage(0, 1, 1, "Sir Alain Juppé", 7, 10, 12, 0, 0, 5, 3, 0); //tj pour les tests
        
    }
        $_SESSION["hero"]->collecteSpell(new AttackingSpell(0, 10, "bullshit no jutsu", 1));
        $_SESSION["hero"]->collecteSpell(new AttackingSpell(1, 5, "taper très fort", 0));
        $_SESSION["hero"]->collecteSpell(new BoostingSpell(2, 2,"initiative", 2, "gotta go fast", 1));
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
<?php
    $arr = $_SESSION["hero"]->getSpellBook() ;
    foreach($arr as $spell){
        echo "<div><button>".$spell->getName()."</button></div>";
    }
?>
<div id="test"></div>

<script>
    let i = 0;
    document.getElementById('test').addC;
</script>

</body>
</html>