<?php
class Shield extends Item{

    protected int $defenseValue; 

    public function __construct($_ID, $_defenseValue, $_weigt, $_name, $_desc, $_size, $_quantity){
        parent::__construct($_ID, $_weigt, $_name, $_desc, $_size, $_quantity);

        $this->defenseValue = $_defenseValue; 
    }

    /**
     * @return int la valeur de défence du bouclier
     * */
    public function getDefenseValue(){
        return $this->defenseValue; 
    }



    /**
     * retorune un string représentant le type de l'item : item, armure, potion, bouclier ou arme
     */
    public function getType(){
        return "bouclier"; 
    }

}
?>