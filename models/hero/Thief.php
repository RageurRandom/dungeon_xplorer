<?php
class Thief extends Hero {

    public function __construct($biographyval,$classval,$xpval,$current_levelval,$max_inventory_weightval,$idval  ,$name, $pv, $mana, $initiative, $strenght){
        parent::__construct($biographyval,$classval,$xpval,$current_levelval,$max_inventory_weightval,$idval,$name, $pv, $mana, $initiative, $strenght);
    }

    public function getClassID() {
        return null; // doit retournée int
    }

}