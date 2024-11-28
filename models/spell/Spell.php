<?php
class Spell {

    private $nom = "";
    private $price = -1;

    public function __construct($nomval,$priceval){
        $nom = $nomval;
        $price = $priceval ;
    }
}