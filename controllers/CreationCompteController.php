<?php
class CreationCompteController {
    //regarder si l'utilisateur et connnectée
    public function index() { 
        
        //Véruifcation des variables nécessires (mail, username, password)
        $good = true; 

        if(!isset( $_POST['userMail']))
            $good = false;

        if(!isset( $_POST['userName']))
        $good = false;   
    
        if(!isset( $_POST['userPassword']))
        $good = false;

        //si les champs demandé sont bien renseignés
        if($good){

            //On récupère les infos du compte à créer
            $userMail = $_POST['userMail']; 
            $userPassword = $_POST['userPassword']; 
            $userName = $_POST['userName']; 

            //On créer le compte
            $this->createAccount( $userMail, $userPassword, $userName );

            //On démarre une session en stockant les informations de l'utilisateur
            session_start(); 
            $_SESSION['connected'] = true; 
            $_SESSION['userName'] = $userName;
            $_SESSION['userMail'] = $userMail;
            $_SESSION['userPassword'] = $userPassword;

            //on revient à la page d'accueil
            header("Location: /dx_11"); 
            
        }//si les champs demandés sont bien renseignés

        //Si les champs ne sont pas renseignés
        else{
            die("erreur de creation de compte : les champs obligatoirs ne sont pas renseignés"); 
        }
    }

    /**
     * créer un compte dans la base de donnée
     * @param string $userMail adresse mail du compte à créer
     * @param string $userPassword MDP du compte à créer
     * @param string $userName nom d'utilisateur du compte à créer
     */
    private function createAccount($userMail, $userPassword, $userName) {

        try{
            $DB = DataBase::getInstance(); 
            $query = "insert into user (user_mail, user_password, user_name) values ('$userMail', '$userPassword', '$userName')"; 
            $nbLines = $DB->excute($query);
        }
        catch (PDOException $ex) {
            die("erreur de creation de compte : ".$ex->getMessage()); 
        }
    }
}