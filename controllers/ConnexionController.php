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
        unset($_SESSION["connected"]);
        unset($_SESSION["userMail"]);
        unset($_SESSION["userPassword"]);
        unset($_SESSION["userName"]); 
        header("Location: /dx_11"); 
    }//fonction logoff

    /**
     * regarde si les champs nécessaires pour la création d'un compte sont renseignés puis essaye de créer le compte 
     */
    public function create() { 
        
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
            $this->createAccount( $userMail, $userPassword, $userName );

            //On se connecte
            session_start(); 
            $this->login($userMail, $userPassword); 

            //on revient à la page d'accueil
            header("Location: /dx_11"); 
        }//Si les champs sont déjà renseignés
    }//fonction create()
    
    /**
     * créer un compte dans la base de donnée
     * @param string $userMail adresse mail du compte à créer
     * @param string $userPassword MDP du compte à créer
     * @param string $userName nom d'utilisateur du compte à créer
     * @see create()
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
    

    /**
     * vérifie si le mail et le mdp passés en paramètres sont correctes. si oui, initialise les variables de sessions
     * @param string $userMail
     * @param string $userPassword
     * @return void
     * @see connect()
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

                //on vérifie si l'utilisateur a un héro dans la base de donnée
                $query = "select count(*) nb from user where hero_id is not null and upper(user_mail) = '$userMail'"; 
                $statement = $DB->unprepared_statement($query); 
                $resultHero = $statement->fetchAll(); 
        
                //Si l'utilisateur possède déjà un héro dans la base de donnée
                if(intval($resultHero[0]["nb"]) != 0){
                    $_SESSION["hasHero"] = true; 
                }//Si l'utilisateur possède déjà un héro dans la base de donnée

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
?>