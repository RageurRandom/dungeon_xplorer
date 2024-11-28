<?php
class Hero extends Combattant{

    protected $biography;
    protected $class ;
    protected $xp;
    protected $current_level;
    protected $max_inventory_weight;
    protected $id;

    public function __construct($biographyval,$classval,$xpval,$current_levelval,$max_inventory_weightval,$idval   ,$name, $pv, $mana, $initiative, $strenght){
        $biography = $biographyval;
        $class = $classval;
        $xp = $xpval;
        $current_level = $current_levelval;
        $max_inventory_weight = $max_inventory_weightval;
        $id = $idval;
        parent::__construct($name, $pv, $mana, $initiative, $strenght);
    }


    public function getClassID() {

        
        return null; // doit retournée int
    }

    public function die() {
    }


}