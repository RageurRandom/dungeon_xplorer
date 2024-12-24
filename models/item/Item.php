<?php
class Item {
    protected int $weight;
    protected string $name;
    protected string $desc;
    protected int $size;
    protected int $ID;
    protected int $quantity; 

    public function __construct($_ID, $_weight, $_name, $_desc, $_size, $_quantity)
    {
        $this->ID = $_ID; 
        $this->weight = $_weight;
        $this->name = $_name;
        $this->desc = $_desc;
        $this->size = $_size;
        $this->quantity = $_quantity;  
    }

    public function getWeight(){
        return $this->weight; 
    }

    public function getSize(){
        return $this->size; 
    }

    public function getName(){
        return $this->name; 
    }

    public function getDesc(){
        return $this->desc; 
    }

    public function getID(){
        return $this->ID; 
    }

    public function getQuantity(){
        return $this->quantity; 
    }

    /**
     * retorune un string représentant le type de l'item : item, armure, potion, bouclier ou arme
     */
    public function getType(){
        return "item"; 
    }

    
}
?>