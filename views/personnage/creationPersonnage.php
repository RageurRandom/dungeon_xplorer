<!-- filepath: /c:/xampp/htdocs/dx_11/views/personnage/creationPersonnage.php -->
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
    <link href="assets/css/styleCreationPersonnage.css" rel="stylesheet">


    <title>création héro</title>
</head>

<body>

    <form action="creationHero" method="post">
        <a href="connexion" class="home-btn"><i class="fas fa-home"></i></a>

        <br><br>

        <h1> Choix du héro</h1>
        <div class="wrapper">
            <div class="box">
                <input type="text" placeholder="nom de l'héro" id="heroName" name="heroName" required />
            </div>
        </div>

        <div class="container mt-3 d-none d-lg-block">
            <div class="row">
                <div class="col justify-content-center d-flex align-items-center">
                    <div class="character guerrier">
                        <button class="btn btn-primary btn-lg btn-light mb-3" name="heroClass" type="submit"
                            value="GUERRIER">GUERRIER</button>
                    </div>
                </div>
                <div class="col justify-content-center d-flex align-items-center">
                    <div class="character magicien">
                        <button class="btn btn-primary btn-lg btn-light mb-3" name="heroClass" type="submit"
                            value="MAGICIEN">MAGICIEN</button>
                    </div>
                </div>
                <div class="col justify-content-center d-flex align-items-center">
                    <div class="character voleur">
                        <button class="btn btn-primary btn-lg btn-light mb-3" name="heroClass" type="submit"
                            value="VOLEUR">VOLEUR</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-3 d-lg-none">
            <div id="characterCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="d-flex justify-content-center">
                            <div class="character guerrier">
                                <button class="btn btn-primary btn-lg btn-light mb-3" name="heroClass" type="submit"
                                    value="GUERRIER">GUERRIER</button>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="d-flex justify-content-center">
                            <div class="character magicien">
                                <button class="btn btn-primary btn-lg btn-light mb-3" name="heroClass" type="submit"
                                    value="MAGICIEN">MAGICIEN</button>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="d-flex justify-content-center">
                            <div class="character voleur">
                                <button class="btn btn-primary btn-lg btn-light mb-3" name="heroClass" type="submit"
                                    value="VOLEUR">VOLEUR</button>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#characterCarousel" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#characterCarousel" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </form>

</body>

</html>