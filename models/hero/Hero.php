<?php
abstract class Hero extends Combattant{

    protected static int $maxInventoryWeight = 100;
    protected static int $InventorySize = 100; 

    protected int $xp;
    protected int $level;
    protected int $id;
    protected int $chapter;

    protected $inventory;  
     
    public function __construct($_id, $_level, $_chapter, $_name, $_hp, $_max_hp, $_xp, $_mana, $_max_mana, $_strength, $_initiative){
        parent::__construct($_name, $_hp, $_max_hp, $_mana, $_max_mana, $_initiative, $_strength);
        $this->id = $_id; 
        $this->chapter = $_chapter;  
        $this->level = $_level;  
        $this->xp = $_xp; 
    }

    /**
     * adds an item to the inventory 
     * @param Item l'item à ajouter
     * @return bool si l'ajout est réussi 
     */
    public function addItem($item){

        if( (self::$maxInventoryWeight - $this->inventoryWeight()) < $item->getWeight()){
            throw new Exception("il n'y a pas assez de place das l'inventaire"); 
        }
        else if ( (self::$InventorySize - $this->InventoryUsedSize()) < $item->getSize() ){
            throw new Exception("il n'y a pas assez de place das l'inventaire");
        }
        else{
            $index = count($this->inventory);
            $inventory[$index] = $item; 
        }  
    }

    /**
     * @return int le poids actuel de l'inventaire
     */
    public function inventoryWeight(){
        $weight = 0; 
        foreach($this->inventory as $index => $item){
            $weight += $item->getWeight(); 
        }
    }

    /**
     * @return int le volume occupé de l'inventaire
     */
    public function InventoryUsedSize(){
        $size = 0; 
        foreach($this->inventory as $index => $item){
            $size += $item->getSize(); 
        }
    }

    /**
     * @return string la classe de l'héro
     */
    public abstract function getClass(); 

    /*
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
    }*/


}
?>