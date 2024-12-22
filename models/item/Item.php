<?php
class Item {
    protected $weight;
    protected $name;
    protected $desc;
    protected $size;

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

    
}
?>