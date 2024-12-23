<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/style.css" rel="stylesheet" />
    <title>Creation de Compte</title>
</head>
<body>
    <div class="block">
        <h1> page de création de compte</h1>

        <form action="creationCompte" method = "post">
            <input type="email" placeholder="adresse e-mail" id="userMail" name="userMail" required/>

            <input type="text" placeholder="username" id="userName" name="userName" required/>

            <input type="password" placeholder="mot de passe" id="userPassword" name="userPassword" required/>

            <button type="submit">créer un compte</button>
        </form>

        <p> si vous avez déjà un compte,<a href="connexion">cliquer ici vous connecter</a></p>
    </div>
</body>
</html>