<?php
class Combattant {
    protected $name;
    protected $pv;
    protected $mana;
    protected $initiative;
    protected $strenght;

    public function __construct($name, $pv, $mana, $initiative, $strenght)
    {
        $this->name = $name;
        $this->$pv = $pv;
        $this->$mana = $mana;
        $this->initiative = $initiative;
        $this->strenght = $strenght;
    }
}