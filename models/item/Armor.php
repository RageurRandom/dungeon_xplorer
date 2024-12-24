<?php
class Armor extends Item{

    protected int $defenseValue;

    public function __construct($_ID, $_defenseValue, $_weigt, $_name, $_desc, $_size)
    {
        parent::__construct($_ID, $_weigt, $_name, $_desc, $_size);
        $this->defenseValue = $_defenseValue;
    }

    /**
     * @return int la valeur de défence de l'armure
     * */
    public function getDefenseValue(){
        return $this->defenseValue; 
    }

    /**
     * retorune un string représentant le type de l'item : item, armure, potion, bouclier ou arme
     */
    public function getType(){
        return "amure"; 
    }
}
?>