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

    /**
     * @return int $this->ID
     */
    public function getID(){
        return $this->ID; 
    }

    public function getQuantity(){
        return $this->quantity; 
    }

    public function addQuantity($quant){
        $this->quantity += $quant; 
    }

    /**
     * retorune un string représentant le type de l'item : item, armure, potion, bouclier ou arme
     */
    public function getType(){
        return "item"; 
    }

    /**
     * permet de comparer in item avec celui là. true si les deux possède le même ID
     * @param Item $item à comparer
     * @return bool le résultat
     */
    public function equals($item){ 
        return $this->ID == $item->getID(); 
    }

    
}
?>