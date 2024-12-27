<?php
class Shield extends Item{

    protected int $defenseValue; 
    //protected int $counterValue;

    public function __construct($_ID, $_defenseValue, /*$_counterValue*/, $_weigt, $_name, $_desc, $_size, $_quantity){
        parent::__construct($_ID, $_weigt, $_name, $_desc, $_size, $_quantity);
        //$this->counterValue = $_counterValue; 
        $this->defenseValue = $_defenseValue; 
    }

    /**
     * @return int la valeur de défence du bouclier
     * */
    public function getDefenseValue(){
        return $this->defenseValue; 
    }

    // PAS PERTINENT
    // /**
    //  * @return int la valeur de contre attaque du boulier
    //  * */
    // public function getCounterValue(){
    //     return $this->counterValue; 
    // }

    /**
     * retorune un string représentant le type de l'item : item, armure, potion, bouclier ou arme
     */
    public function getType(){
        return "bouclier"; 
    }

}
?>