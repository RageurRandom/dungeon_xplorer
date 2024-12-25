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
    <link href="assets/css/style.css" rel="stylesheet">

    <title>Accueil</title>

<body>
    <div class="container px-4 px-lg-5 h-100">
        <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-8 align-self-end">
                <h1 class="font-weight-bold">page d'acceuil avec l'utilisateur connectee</h1>
                <h1 class="font-weight-bold">Bienvenue <?php echo $_SESSION["userName"] ?></h1>

                <?php
                //Si l'utilisateur a un héro
                if (isset($_SESSION["hasHero"]) && $_SESSION["hasHero"] == true)
                    echo "<p><a class='btn btn-primary btn-lg btn-light' href='recuperationHero'>continuer l'aventure</a></p>";
                ?>

                <hr class="divider" />

            </div>
            <div class="col-lg-8 align-self-baseline">
                <p class="nofont">adresse mail : <?php echo $_SESSION["userMail"] ?></p>
                <p><a class="btn btn-primary btn-lg btn-light" href="deconnexion">déconnexion</a></p>

                <p><a class="btn btn-primary btn-lg btn-light" href='creationHero'>nouvelle aventure</a></p>
            </div>
        </div>
    </div>
</body>

</html>