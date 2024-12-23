<?php
class Mage extends Hero {

    public function __construct($_id, $_level, $_chapter, $_name, $_hp, $_max_hp, $_xp, $_mana, $_max_mana, $_strength, $_initiative){
        parent::__construct($_id, $_level, $_chapter, $_name, $_hp, $_max_hp, $_xp, $_mana, $_max_mana, $_strength, $_initiative);

    }


    public function getClass(){
        return "MAGICIEN"; 
    }
}
?>