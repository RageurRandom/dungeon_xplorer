<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- <link href="assets/css/choixPersonnage.css" rel="stylesheet" /> -->
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous" defer></script>

    <!-- Custom CSS -->
    <link href="assets/css/style.css" rel="stylesheet">
    
    <title>création héro</title>
</head>
<body>
    <form action="creationHero" method = "post">

    <div class="container text-center mt-5">
        <h1> Choix du héro</h1>
        <div class="wrapper">
            <div class="box"><input type="text" placeholder="nom de l'héro" id="heroName" name="heroName" required/></div>
        </div>

        <div class="row mt-4">

            <div class="col-md-4 col-sm-12">
                <div class="character">
                    <img src="assets/images/bw_guerrier.jpeg" alt="guerrier" class="img-fluid">
                    <p>GUERRIER</p>
                    <button class="btn" name="heroClass" type="submit" value="GUERRIER">GUERRIER</button>

                </div>
            </div>

            <div class="col-md-4 col-sm-12">
                <div class="character">
                    <img src="assets/images/bw_mage.jpeg" alt="guerrier" class="img-fluid">
                    <p>MAGICIEN</p>
                    <button class="btn" name="heroClass" type="submit" value="MAGICIEN">MAGICIEN</button>
                </div>
            </div>

            <div class="col-md-4 col-sm-12">
                <div class="character">
                    <img src="assets/images/bw_voleur.jpeg" alt="guerrier" class="img-fluid">
                    <p>VOLEUR</p>
                    <button class="btn" name="heroClass" type="submit" value="VOLEUR">VOLEUR</button>
                </div>
            </div>
                
		  
		<section class="MAGICIEN">
		</section>
		  
		<section class="VOLEUR">
		</section>

    </form>

    <footer>
        <p> pour revenir à l'accueil,<a href="">cliquer ici</a></p>
	</footer>


</body>
</html>