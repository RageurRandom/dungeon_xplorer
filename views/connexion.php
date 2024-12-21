<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <h1> page de connection</h1>

    <form action="../connexion" method = "post">

        <label for="userMail">adresse e-mail</label>
        <input type="email" id="userMail" name="userMail" required/>

        <label for="userPassword">mot de passe</label>
        <input type="userassword" id="userPassword" name="userPassword" required/>

        <button type="submit">se connecter</button>
    </form>

        <a href="creationCompte.php">cliquer ici pour créer un compte</a>
</body>
</html>