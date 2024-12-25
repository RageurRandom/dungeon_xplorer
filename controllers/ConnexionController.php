<?php
class ConnexionController {

    /**
     * regarde si l'utilisateur est connecté, sinon, le connecte
     */
    public function connect() { 
        session_start(); 

        //Si on est dèjà connecté
        if(isset($_SESSION["connected"]) && $_SESSION["connected"] === true) {
            //On revien à la page d'accueil
            header("Location: /dx_11"); 
        }//si on est déjà connecté 

        //Si on veut renseigner les champs de connexion 
        else if(!isset($_POST["userMail"]) || !isset($_POST["userPassword"])){
            require_once "views/connexion.php"; 
        }//Si on veut renseigner les champs 

        //Si on a dèjà renseigner les champs de connexion et qu'on n'est pas connecté
        else{
            
            //On récupère les infos du compte à créer
            $userMail = strtoupper($_POST['userMail']); 
            $userPassword =strtoupper($_POST['userPassword']);
            
            //On se connecte
            $this->login($userMail, $userPassword);

            //On revient à l'accueil 
            header("Location: /dx_11"); 

        }//Si on a dèjà renseigner les champs de connexion et qu'on n'est pas connecté

    }//fonction connect()

    /**
     * permet de se déconnecter
     * @return void
     */
    public function logoff(){
        session_start();
        session_unset();  
        header("Location: /dx_11"); 
    }//fonction logoff

    /**
     * regarde si les champs nécessaires pour la création d'un compte sont renseignés puis essaye de créer le compte 
     */
    public function create() { 
        session_start();

        if(isset($_SESSION["connected"]) && $_SESSION["connected"] === true) {
            // On revient à la page d'accueil
            header("Location: /dx_11"); 
        } // Si on est déjà connecté 
        
        // Si on veut renseigner les champs de création 
        if(!isset($_POST["userMail"]) || !isset($_POST["userPassword"]) || !isset($_POST["userName"])) {
            require_once "views/creationCompte.php"; 
        } // Si on veut renseigner les champs de création 
        
        // Si les champs sont déjà renseignés
        else {
            // On récupère les infos du compte à créer
            $userMail = strtoupper($_POST['userMail']); 
            $userPassword = password_hash($_POST['userPassword'], PASSWORD_DEFAULT); // Chiffrer le mot de passe
            $userName = strtoupper($_POST['userName']); 
        
            // On crée le compte
            DataBase::createAccount($userMail, $userPassword, $userName);
        
            // On se connecte 
            $this->login($userMail, $_POST['userPassword']); 
        
            // On revient à la page d'accueil
            header("Location: /dx_11"); 
        } // Si les champs sont déjà renseignés
    }//fonction create()
    
    

    /**
     * vérifie si le mail et le mdp passés en paramètres sont correctes. si oui, initialise les variables de sessions
     * @param string $userMail
     * @param string $userPassword
     * @return void
     * @see connect()
     */
    public function login($userMail, $userPassword) { 
        // On récupère le compte
        $result = DataBase::getAccount($userMail);
    
        // Si le mot de passe est correct
        if ($result && password_verify($userPassword, $result[0]["user_password"])) {
            // On vérifie si l'utilisateur a un héros dans la base de données et on stocke cette info dans la session
            $hasHero = DataBase::hasHero($userMail); 
            $_SESSION["hasHero"] = $hasHero; 
    
            // On initialise les variables de connexion
            $_SESSION["connected"] = true;
            $_SESSION["userMail"] = $userMail;
            $_SESSION["userName"] = $result[0]["user_name"]; 
            $_SESSION["userID"] = $result[0]["user_id"]; 
    
            // Rediriger vers la page d'accueil ou une autre page
            header("Location: /dx_11/accueil");
            exit();
        } else {
            // Si le mot de passe n'est pas correct, renvoyer un message d'erreur
            $_SESSION["login_error"] = "Le mot de passe n'est pas correct";
            header("Location: /dx_11/connexion");
            exit();
        }
    }//fonction login() 
}
?>