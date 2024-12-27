<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous" defer></script>

    <!-- Custom CSS -->
    <link href="assets/css/style.css" rel="stylesheet">

    <title>Histoire</title>
</head>

<body>
    <header class="masthead">
        <div class="container px-4 px-lg-5 h-100">
            <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                <div class="col-lg-8 align-self-end">
                    <h1 class="font-weight-bold">Modifier l'Histoire</h1>

                    <hr class="divider" />
                </div>
                <div class="col-lg-8 align-self-baseline">

                    <form class="form-signin" action="suppressionCompte2" method = "post">
                        <h2>comptes</h2>
                        <select id="accounts" name="account" class="text-white-75 mb-5" required>
                            <?php
                                $this->printAccounts(); 
                            ?>
                        </select>
                        <button type="submit">supprimer le compte</button>
                    </form>

                    <h2>chapitres</h2>
                    <p class="text-white-75 mb-5">
                        <?php
                            $this->printChapters(); 
                        ?>
                    </p>
                    
                    <a class="btn btn-primary btn-lg btn-light" href="/dx_11/">Page d'accueil</a>
                </div>
            </div>
        </div>
    </header>
</body>

</html>