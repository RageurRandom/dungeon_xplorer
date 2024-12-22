<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>création héro</title>
</head>
<body>
    <h1> page de création de l'héro</h1>

    <form action="creationHero" method = "post">

    
        <label for="heroClass">Classe de l'héro</label>
        <select name="heroClass" id="heroClass" required>
            <option value="">euillez sélecionner une classe</option>
            <option value="mage">guerrier</option>
            <option value="thief">voleur</option>
            <option value="warrior">magicien</option>
        </select>

        <label for="heroName">nom de l'héro</label>
        <input type="text" id="heroName" name="heroName" required/>

        <button type="submit">créer le héro</button>

    </form>

    <p> pour revenir à l'accueil,<a href="">cliquer ici</a></p>

</body>
</html>