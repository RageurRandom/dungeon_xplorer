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
    <link href="assets/css/styleLandingPage.css" rel="stylesheet" />
    <link href="assets/css/styleConnexion.css" rel="stylesheet" >

    <title>Connexion</title>
</head>

<body class="text-center d-flex align-items-center justify-content-center">

<form class="form-signin" action="connexion" method = "post">
    <div class="logo-container mb-4">
        <img class="logo" src="assets/images/dxlogo.png" alt="">
    </div>

      <h1 class="h2 mb-3 font-weight-normal">Page de connexion</h1>
      <label for="userMail" class="sr-only">Email address</label>
      <input type="email" id="userMail" class="form-control" placeholder="Email address" name="userMail" required autofocus>
      <label for="userPassword" class="sr-only">Password</label>
      <input type="password" id="userPassword" class="form-control mb-3" placeholder="Password" name="userPassword" required>

      <button class="btn btn-primary btn-lg btn-light mb-3" type="submit">SE CONNECTER</button>
      <a class="btn btn-link" href="creationCompte">créer un compte</a>

    </form>
</body>

</html>