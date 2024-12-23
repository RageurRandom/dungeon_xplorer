<?php
class Thief extends Hero {

    
    public function __construct($_id, $_level, $_chapter, $_name, $_hp, $_max_hp, $_xp, $_mana, $_max_mana, $_strength, $_initiative, $_treasure){
        parent::__construct($_id, $_level, $_chapter, $_name, $_hp, $_max_hp, $_xp, $_mana, $_max_mana, $_strength, $_initiative, $_treasure);
    }

    public function getClass(){
        return "voleur"; 
    }


}
?>