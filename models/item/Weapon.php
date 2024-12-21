<?php
class Weapon extends Item{
    protected $attak_value;

    public function __construct($attak_value,$weigt, $name, $desc, $size)
    {
        $this->attak_value = $attak_value;
        parent::__construct($weigt, $name, $desc, $size);
    }

    // récupére la valeur d'attaque de l'arme
    public function getAttak_value(){
        return attak_value;
    }
}