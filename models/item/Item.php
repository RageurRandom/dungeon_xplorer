<?php
class Item {
    protected int $weight;
    protected string $name;
    protected string $desc;
    protected int $size;

    public function __construct($_weight, $_name, $_desc, $_size)
    {
        $this->weight = $_weight;
        $this->name = $_name;
        $this->desc = $_desc;
        $this->size = $_size;
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

    /**
     * retorune un string représentant le type de l'item : item, armure, potion, bouclier ou arme
     */
    public function getType(){
        return "item"; 
    }

    
}
?>