<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
</head>
<body>
    <h1> page d'acceil avec l'utilisateur connectee</h1>
    <p>adresse mail : <?php echo $_SESSION["userMail"]?></p>
    <p><a href="deconnexion">cliquez ici pour vous déconnecter</a></p>
    <?php 
        //Si l'utilisateur a un héro
        if(isset($_SESSION["hasHero"]) && $_SESSION["hasHero"] == true)
            echo "<p><a href='recuperationHero'>continuer l'aventure</a></p>"; 
    ?>
    <p><a href='creationHero'>commencer une nouvelle aventure</a></p>
</body>
</html>