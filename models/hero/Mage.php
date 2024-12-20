<?php
class Mage extends Hero {

    public function __construct($biographyval,$classval,$xpval,$current_levelval,$max_inventory_weightval,$idval  ,$name, $pv, $mana, $initiative, $strenght){
        parent::__construct($biographyval,$classval,$xpval,$current_levelval,$max_inventory_weightval,$idval,$name, $pv, $mana, $initiative, $strenght);
    }

    public function getClassID() {
        return null; // doit retournée int
    }

        //récupére id de la classe
        public function getClassID() {
            return $id;
        }
        //récupére la classe
        public function getClass() {
            return $class;
        }

}