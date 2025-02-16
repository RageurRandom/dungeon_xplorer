<?php
class Weapon extends Item{

    protected int $attackValue;

    public function __construct($_ID, $_attakValue,$_weigt, $_name, $_desc, $_size, $_quantity)
    {
        parent::__construct($_ID, $_weigt, $_name, $_desc, $_size, $_quantity);
        $this->attackValue = $_attakValue;
    }

    // récupére la valeur d'attaque de l'arme
    public function getAttackValue(){
        return $this->attackValue;
    }

    /**
     * retorune un string représentant le type de l'item : item, armure, potion, bouclier ou arme
     */
    public function getType(){
        return "arme"; 
    }
}
?>