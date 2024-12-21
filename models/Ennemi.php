<?php
class Ennemi extends Combattant{


    public function __construct($name, $pv, $mana, $initiative, $strenght)
    {
        parent::__construct($name, $pv, $mana, $initiative, $strenght);
    }
}
?>