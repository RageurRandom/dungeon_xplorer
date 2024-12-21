<?php
class Inventory {
    protected $weight;
    protected $current_size;

    public function __construct($weight, $current_size)
    {
        $this->weight = $weight;
        $this->current_size = $current_size;
    }

    //récupére la taille de l'inventaire
    public function getWeight(){
        return $weight;
    }

    //récupére l'espace prisse de l'inventaire
    public function getCurrent_size(){
        return $current_size;
    }

    //auggmente l'espace prisse de l'inventaire
    public function setCurrent_size($add){
        $current_size += $add;
    }

    
}
?>