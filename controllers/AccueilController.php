<?php
class AccueilController {
    
    //regarder si l'utilisateur et connnectée
    public function index() {
        session_start(); 
        
        //Si on n'est pas connecté
        if(!isset($_SESSION["connected"]) || !$_SESSION["connected"]){
            require_once 'views/accueil/accueilNonConnecte.php';
        }
            
        //sinon
        else{
            require_once 'views/accueil/accueilConnecte.php';  
        }

    }
}
?>