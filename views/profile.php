<!DOCTYPE html>
<html lang="en">

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

    <title>Accueil</title>

</head>

<body>
    <header class="masthead">
        <div class="container px-4 px-lg-5 h-100">
            <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                <div class="col-lg-8 align-self-end">
                    <h1 class="font-weight-bold">PAGE DE PROFILE</h1>

                    <hr class="divider" />
                </div>
                <div class="col-lg-8 align-self-baseline">
                    <p class="text-white-75 mb-5">
                        <?php
                            $this->printUser(); 
                        ?>
                    </p>

                    <form class="form-signin" action="changementNomU" method = "post">
                        <h2>changer le nom d'utilisateur</h2>

                        <?php if (isset($_SESSION["changeUserName_error"])): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $_SESSION["changeUserName_error"]; unset($_SESSION["changeUserName_error"]); ?>
                            </div>
                        <?php endif; ?>

                        <label for="newUserName" class="sr-only">Nouveau Nom d'utilisateur</label>
                        <input type="text" placeholder="Nom d'utilisateur" id="userName" class="form-control" name="newUserName" required>

                        <button class="btn btn-primary btn-lg btn-light mb-3" type="submit">CHANGER LE NOM D'UTILISATEUR</button>
                    </form>

                    <form class="form-signin" action="changementMDP" method = "post">
                        <h2>changer le mot de passe</h2>

                        <?php if (isset($_SESSION["changePassword_error"])): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $_SESSION["changePassword_error"]; unset($_SESSION["changePassword_error"]); ?>
                            </div>
                        <?php endif; ?>

                        <label for="oldPassword" class="sr-only">Ancien mot de passe</label>
                        <input type="password" id="userPassword" class="form-control mb-3" placeholder="ancien MDP" name="oldPassword" required>
                        <label for="newPassword" class="sr-only">Nouveau mot de passe</label>
                        <input type="password" id="userPassword" class="form-control mb-3" placeholder="nouveau MDP" name="newPassword" required>

                        <button class="btn btn-primary btn-lg btn-light mb-3" type="submit">CHANGER LE MOT DE PASSE</button>
                        </form>
                    <a class="btn btn-primary btn-lg btn-light" href="/dx_11/suppressionCompte">Supprimer le compte</a>
                    <a class="btn btn-primary btn-lg btn-light" href="/dx_11/">Page d'accueil</a>
                </div>
            </div>
        </div>
    </header>
</body>

</html>