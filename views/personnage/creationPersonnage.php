<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/choixPersonnage.css" rel="stylesheet" />
    <title>création héro</title>
</head>
<body>
    <form action="creationHero" method = "post">

    <header>
        <h1> Choix du héro</h1>
        <div class="wrapper">
            <div class="box"><input type="text" placeholder="nom de l'héro" id="heroName" name="heroName" required/></div>
        </div>
    </header>

        <section class="GUERRIER">
            <button class="btn" name="heroClass" type="submit" value="GUERRIER">GUERRIER</button>
		</section>
		  
		<section class="MAGICIEN">
            <button class="btn" name="heroClass" type="submit" value="MAGICIEN">MAGICIEN</button>
		</section>
		  
		<section class="VOLEUR">
            <button class="btn" name="heroClass" type="submit" value="VOLEUR">VOLEUR</button>
		</section>

    </form>

    <footer>
        <p> pour revenir à l'accueil,<a href="">cliquer ici</a></p>
	</footer>


</body>
</html>