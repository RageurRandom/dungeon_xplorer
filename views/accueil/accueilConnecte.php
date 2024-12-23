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
</body>
</html>