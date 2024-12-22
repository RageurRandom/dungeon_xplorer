<?php
class Warrior extends Hero {

    protected Armor $armor; 

    public function __construct($_id, $_level, $_chapter, $_name, $_hp, $_xp, $_mana, $_strength, $_initiative){
        parent::__construct($_id, $_level, $_chapter, $_name, $_hp, $_xp, $_mana, $_strength, $_initiative);
    }

    public function putArmor($_armor){
        $this->armor = $_armor; 
    }

    public function getClass(){
        return "GUERRIER"; 
    }
}
?>