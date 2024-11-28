<?php
class Inventory {
    protected $weight;
    protected $current_size;

    public function __construct($weight, $current_size)
    {
        $this->weight = $weight;
        $this->current_size = $current_size;
    }

    
}