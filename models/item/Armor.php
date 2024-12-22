<?php
class Armor extends Item{

    protected int $defenseValue;
    protected bool $isShield; 

    public function __construct($_defenseValue, $_isShield, $weigt, $name, $desc, $size)
    {
        parent::__construct($weigt, $name, $desc, $size);
        $this->defenseValue = $_defenseValue;
        $this->isShield = $_isShield;
    }

    //récupére la valeur de défence de l'objet
    public function getDefenseValue(){
        return $this->defenseValue; 
    }
}
?>