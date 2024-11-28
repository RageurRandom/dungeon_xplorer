<?php
class PersonnageController {
    
    public function index() {
        //regarder si l'utilisateur a un perosnnage connnectée
        // si oui require_once 'view/personnage/profilePesonnage.php'
        require_once 'views/personnage/profilePersonnage.php';

        //si non require_once 'views/personnage/creationPersonnage.php';'
    }
}