<?php
class AccueilController {
    
    //regarder si l'utilisateur et connnectée
    public function index() {
        // si oui require_once 'view/acceilConnecter'
        require_once 'views/accueil/accueilNonConnecter.php';

        //si non require_once 'views/accueil/acceilNonConnecter'
    }
}