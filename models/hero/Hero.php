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


    //verifie les pv du hero 
    public function die() {
        return $pv > 0;
    }

    //recupére la biography du hero
    public function getBiography() {
        return $biography;
    }

    //définie la biography du hero
    public function setBiography() {
        return $biography;
    }

    //recupére la classe du hero
    public function getClass() {
        return $class;
    }

    //recupére le nombre l'expérience du hero
    public function getXp($experience) {
        $xp += $xp + $experience;
    }

    //ajoute de l'expérience au hero
    public function addXp($experience) {
        $xp += $xp + $experience;
        if(levelUp){
            echo "monter de niveau"; //a faire : montrer a l'écran qu'on monte de niveau
        }
    }

    //regarde si le hero a assez d'expérience pour monter de niveau
    public function levelUp() {
        if ($ex > 100 + log($current_level)){
            $ex = 0;
            $current_level = $current_level + 1;
            return true;
        }
        return false;
    }

    //regarde si je joueur a le droit de prendre l'objet
    public function addObjet($inventory_weight){
        return $max_inventory_weight > $inventory_weight;
    }


}
?>