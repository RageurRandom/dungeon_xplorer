<?php
class Spell {

    private $nom = "";
    private $price = -1;

    public function __construct($nomval,$priceval){
        $nom = $nomval;
        $price = $priceval ;
    }

    //récupére le nom du spell
    public function getNom(){
        return $nom;
    }

    //récupére le prix du spelle
    public function getprice(){
        return $price;
    }
}