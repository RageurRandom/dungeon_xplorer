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

        //Si on est dèjà connecté
        if(isset($_SESSION["connected"]) && $_SESSION["connected"] === true) {
            //On revien à la page d'accueil
            header("Location: /dx_11"); 
        }//si on est déjà connecté 
        
        //Si on veut renseigner les champs de création 
        if(!isset($_POST["userMail"]) || !isset($_POST["userPassword"]) || !isset($_POST["userName"])){
            require_once "views/creationCompte.php"; 
        }//Si on veut renseigner les champs de création 

        //Si les champs sont déjà renseignés
        else{
            //On récupère les infos du compte à créer
            $userMail = strtoupper($_POST['userMail']); 
            $userPassword = strtoupper($_POST['userPassword']); 
            $userName = strtoupper($_POST['userName']); 

            //On créer le compte
            DataBase::createAccount($userMail, $userPassword, $userName);

            //On se connecte 
            $this->login($userMail, $userPassword); 

            //on revient à la page d'accueil
            header("Location: /dx_11"); 
        }//Si les champs sont déjà renseignés
    }//fonction create()
    
    

    /**
     * vérifie si le mail et le mdp passés en paramètres sont correctes. si oui, initialise les variables de sessions
     * @param string $userMail
     * @param string $userPassword
     * @return void
     * @see connect()
     */
    public function login($userMail, $userPassword){ 
        
        //On récupère le compte
        $result = DataBase::getAccount($userMail);

        //Si le mot de passe est correcte
        if($result[0]["user_password"] == $userPassword){

            //on vérifie si l'utilisateur a un héro dans la base de donnée et on stock cette infos dans la session
            $hasHero = DataBase::hasHero($userMail); 
            $_SESSION["hasHero"] = $hasHero; 

            //on initialise les variables de connexion
            $_SESSION["connected"] = true;
            $_SESSION["userMail"] = $userMail;
            $_SESSION["userPassword"] = $userPassword;
            $_SESSION["userName"] = $result[0]["user_name"]; 
            $_SESSION["userID"] = $result[0]["user_id"]; 
        }//si le mot de passe est correcte

        //si le mot de passe n'est pas correcte            
        else{
            die("le mot de passe n'est pas correcte"); 
        }//si le mot de passe n'est pas correcte 

    }//fonction login() 
}
?>