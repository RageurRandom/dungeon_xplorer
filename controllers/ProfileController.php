<?php
class ProfileController {
    
    /**
     * regarde si on est connecté puis affiche la page de profile
     */
    public function index() {
        session_start(); 
        //si on n'est pas connecté
        if(!isset($_SESSION["connected"]) || !($_SESSION["connected"] === true)){ 
            header("Location: /dx_11/connexion");
        }//si on n'est pas connecté

        else{
            $_SESSION["deletePermission"] = true; 
            require_once 'views/profile.php';
        }
    }//fonction index()

    /**
     * permet de vérifier si on est connecté puis fait le traitement nécessaire pour changer le MDP de l'Utilisateur connecté
     */
    public function changePassword(){
        session_start(); 
        unset($_SESSION["deletePermission"]); 

        //si on n'est pas connecté
        if(!isset($_SESSION["connected"]) || !($_SESSION["connected"] === true)){ 
            header("Location: /dx_11/connexion");
        }//si on n'est pas connecté

        //Si les champs ne sont pas renseignés
        if(!isset($_POST["newPassword"]) || !isset($_POST["oldPassword"])){
            header("Location: /dx_11/profile");
        }//Si les champs ne sont pas renseignés

        //Si les champs sont bien renseigné et qu'on est connecté
        else{
            $infosCompte = DataBase::getAccount($_SESSION["userMail"])[0];

            //Si l'ancien MDP n'est pas correcte
            if(!password_verify($_POST["oldPassword"], $infosCompte["user_password"])){
                $_SESSION["changePassword_error"] = "L'ancien mot de passe n'est pas correct";
                header("Location: /dx_11/profile");
                exit();
            }//Si l'ancien MDP n'est pas correcte

            //On cahnge le MDP
            $newPassword = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);
            DataBase::changePassword($newPassword); 
            $_SESSION["changePassword_error"] = "Mot de passe changé avec succés";
            header("Location: /dx_11/profile"); 
        }//Si les champs sont bien renseigné et qu'on est connecté

    }//fonction changePassword()

    /**
     * permet de changer le nom d'utilisateur du compte
     */
    public function changeUserName(){
        session_start(); 
        unset($_SESSION["deletePermission"]); 

        //si on n'est pas connecté
        if(!isset($_SESSION["connected"]) || !($_SESSION["connected"] === true)){ 
            header("Location: /dx_11/connexion");
        }//si on n'est pas connecté

        //Si les champs ne sont pas renseignés
        if(!isset($_POST["newUserName"])){
            $_SESSION["changeUserName_error"] = "Vous devez saisir un nouveau nom";
            header("Location: /dx_11/profile");
            exit();
        }//Si les champs ne sont pas renseignés

        //Si le nouveau nom est le même 
        if($_SESSION["userName"] === $_POST["newUserName"]){
            $_SESSION["changeUserName_error"] = "Vous devez saisir un nouveau nom";
            header("Location: /dx_11/profile");
            exit();
        }//Si le nouveau nom est le même 

        //Si les champs sont bien renseigné et qu'on est connecté
        else{
            //On change le nom
            DataBase::changeUserName($_POST["newUserName"]); 
            $_SESSION["changeUserName_error"] = "Nom changé avec succés";
            $_SESSION["userName"] = $_POST["newUserName"]; 
            header("Location: /dx_11/profile"); 
        }//Si les champs sont bien renseigné et qu'on est connecté
    }//fonction changeUserName()

    /**
     * permet de supprimer le compte de l'utilisateur connecté
     */
    public function deleteAccount(){
        session_start(); 

        //si on n'est pas connecté
        if(!isset($_SESSION["connected"]) || !($_SESSION["connected"] === true)){ 
            header("Location: /dx_11/connexion");
        }//si on n'est pas connecté

        //si on n'a pas accéder à la fonction par le bouton "supprimer" de la page profile
        if(!isset($_SESSION["deletePermission"]) || !($_SESSION["deletePermission"] === true)){ 
            header("Location: /dx_11/profile");
        }//si on n'a pas accéder à la fonction par le bouton "supprimer" de la page profile

        //Si on est connecté et qu'on a accédé à cette fonction par le bouton "supprimer"
        else{
            DataBase::deleteAccount(); 
            header("Location: /dx_11/deconnexion"); 
        }//Si on est connecté et qu'on a accédé à cette fonction par le bouton "supprimer"
    }

    public function printUser(){
        echo"nom d'utilisateur : ".$_SESSION["userName"]."<br>
                adresse mail : ".$_SESSION["userMail"]."<br>"; 
    }
}
?>