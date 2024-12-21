<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creation de Compte</title>
</head>
<body>
    <h1> page de création de compte</h1>

    <form action="creationCompte" method = "post">

    
        <label for="userMail">adresse e-mail</label>
        <input type="email" id="userMail" name="userMail" required/>

        <label for="userName">username</label>
        <input type="text" id="userName" name="userName" required/>

        <label for="userPassword">mot de passe</label>
        <input type="password" id="userPassword" name="userPassword" required/>

        <button type="submit">créer un compte</button>
    </form>

        <p> si vous avez déjà un compte,<a href="connexion">cliquer ici vous connecter</a></p>
</body>
</html>