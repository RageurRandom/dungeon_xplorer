<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/5022ecc52d.js" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"
        defer></script>

    <!-- Custom CSS -->
    <link href="assets/css/style.css" rel="stylesheet">

    <title>Accueil</title>

<body>

    <div class="container px-4 px-lg-5 h-100">
        <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-8 align-self-end">
                <h1 class="font-weight-bold">Bienvenue <?php echo $_SESSION["userName"] ?></h1>

                <?php
                //Si l'utilisateur a un héro
                if (isset($_SESSION["hasHero"]) && $_SESSION["hasHero"] == true)
                    echo "<p><a class='btn btn-primary btn-lg btn-light' href='recuperationHero'>Continuer l'aventure</a></p>";
                //Si c'est un compte Admin
                if (isset($_SESSION["adminAccount"]) && $_SESSION["adminAccount"] == true)
                echo "<p><a class='btn btn-primary btn-lg btn-light' href='modificationHistoire'>Modifier l'histoire</a></p>";
                ?>

                <hr class="divider" />

            </div>
            <div class="col-lg-8 align-self-baseline">
                <p class="nofont">Adresse mail : <?php echo $_SESSION["userMail"] ?></p>
                <p><a class="btn btn-primary btn-lg btn-light deconnexion-btn" href="deconnexion">Déconnexion</a></p>

                <p><a class="btn btn-primary btn-lg btn-light" href='creationHero'>Nouvelle aventure</a></p>
                <p><a class="btn btn-primary btn-lg btn-light" href='profile'>Profil</a></p>
            </div>
        </div>
    </div>
</body>

</html>