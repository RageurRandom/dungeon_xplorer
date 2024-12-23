<?php
class Weapon extends Item{

    protected int $attackValue;

    public function __construct($_attakValue,$_weigt, $_name, $_desc, $_size)
    {
        parent::__construct($_weigt, $_name, $_desc, $_size);
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