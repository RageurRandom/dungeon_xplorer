<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"
        defer></script>

    <!-- Custom CSS -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/styleConnexion.css" rel="stylesheet" />


    <title>Creation de Compte</title>
</head>

<body class="text-center d-flex align-items-center justify-content-center">
    <form class="form-signin" action="creationCompte" method="post">
        <div class="logo-container mb-4">
            <img class="logo" src="assets/images/dxlogo.png" alt="">
        </div>

        <label for="userMail" class="sr-only">Adresse mail</label>
        <input type="email" placeholder="exemple@mail.com" id="userMail" class="form-control" name="userMail" required />

        <label for="userName" class="sr-only">Nom d'utilisateur</label>
        <input type="text" placeholder="Utilisateur" id="userName" class="form-control" name="userName" required />

        <label for="userPassword" class="sr-only">Mot de passe</label>
        <input type="password" placeholder="Mot de passe" id="userPassword" class="form-control" name="userPassword" required />

        <div>
            <label for="userAdmin" class="sr-only">Compte admin</label>
            <input type="checkbox" name="userAdmin" value="1"/>
        </div>
        
        <button class="btn btn-primary btn-lg btn-light mb-3" type="submit">Créer un compte</button>
        <a class="btn btn-primary btn-lg btn-light mb-3" href="connexion">Annuler</a>

    </form>
</body>

</html>