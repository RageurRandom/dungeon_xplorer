<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>formulaire</title>
    <link rel="stylesheet" href="assets/css/formulaire.css">
</head>
<body>
    <div class="container" id="container">
        <div class="from-container sign-up-container">
            <form action="#">
                <h1>Crée un compte</h1>    
                <span>Utiliser un compte</span>
                <input type="text" placeholder="Nom">
                <input type="emai" placeholder="Email">
                <input type="password" placeholder="Mot de passe">
                <button>Creer un compte</button>
            </form>
        </div>


        <div class="from-container login-container">
            <form action="#">
                <h1>Se connecter</h1>    
                <span>je n'ai pas de compte</span>
                <input type="emai" placeholder="Email">
                <input type="password" placeholder="Mot de passe">
                <button>Se connecter</button>
            </form>
        </div>

        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>vous avez un compte DungeonXplorer ?</h1>
                    <p>connecter vous pour continuer votre aventure !</p>
                    <button class="ghost" id="login">Se connecter</button>
                </div>

                <div class="overlay-panel overlay-right">
                    <h1>vous n'avez pas de compte DungeonXplorer ?</h1>
                    <p>Cela ne prendra seulement quelque minutes et vous permétra de jouer une nouvelle avanture.</p>
                    <button class="ghost" id="signUp">Creer un compte</button>
                </div>
            </div>
        </div>
    </div>


    
    <script src="assets/js/formulaire.js"></script>
</body>
</html>