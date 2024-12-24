<?php
class CombatController{
    public function index() {
        session_start();
        require_once 'views/combat.php';
    }
}

?>