<?php
class ConnexionController {
    //regarder si l'utilisateur et connnectée
    public function index() { 
        session_start(); 

        //Si on est dèjà connecté
        if(isset($_SESSION["connected"]) && $_SESSION["connected"] === true) {
            //On se déconnecte 
            $this->logoff(); 
        }//si on est déjà connecté 

        //si on n'est pas connecté
        else{   
            echo"on essye de se connecter"; 
            //Véruifcation des variables nécessires (mail, password)
            $good = true; 
            if(!isset( $_POST['userMail']))
                $good = false;
            if(!isset( $_POST['userPassword']))
                $good = false;

            //Si tous les champs sont correctement renseignés
            if($good){

                //On récupère les infos du compte à créer
                $userMail = $_POST['userMail']; 
                $userPassword = $_POST['userPassword'];
                
                //On se connecte
                $this->login($userMail, $userPassword);
            }

            //Si tous les champs ne sont pas bine renseignés
            else{
                die("il manque des champs obligatoirs pour la connexion"); 
            }//Si tous les champs e sont as bien renseignés

        }//Si on n'est pas connecté

        //On revient à l'accueil 
        header("Location: /dx_11"); 
    }//fonction index()

    /**
     * permet de se déconnecter
     * @return void
     */
    public function logoff(){
        $_SESSION['connected'] = false; 
        $_SESSION['userMail'] = null;
        $_SESSION['userPassword'] = null;
        $_SESSION['userName'] = null;
        
    }//fonction logoff
    

    /**
     * permet de se connecter
     * @param string $userMail
     * @param string $userPassword
     * @return void
     */
    public function login($userMail, $userPassword){ 
        $DB = DataBase::getInstance();

        //On vérifie que le compte existe
        $query = "select count(*) nb from user where user_mail = '$userMail'"; 
        $statement = $DB->unprepared_statement($query);
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);


        //Si le compte n'existe pas
        if(intval($result[0]["nb"]) == 0)
            die("aucun compte existe avec cette adresse mail"); 
        else if(intval($result[0]["nb"]) != 1)
            die("un problème s'est passé");

        //si le compte existe
        else{

            //On vérifie le mot de passe
            $query = "select user_name, user_password from user where user_mail = '$userMail'"; 
            $statement = $DB->unprepared_statement($query);
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            //Si le mot de passe est correcte
            if($result[0]["user_password"] == $userPassword){
                //on initialise les variables de connexion
                $_SESSION["connected"] = true;
                $_SESSION["userMail"] = $userMail;
                $_SESSION["userPassword"] = $userPassword;
                $_SESSION["userName"] = $result[0]["user_name"]; 
            }//si le mot de passe est correcte

            //si le mot de passe n'est pas correcte            
            else{
                die("le mot de passe n'est pas correcte"); 
            }
        }//si le compte existe

    }//fonction login() 
}