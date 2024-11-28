<?php
class Ennemi extends Combattant{
    protected $name;
    protected $pv;
    protected $mana;
    protected $initiative;
    protected $strenght;

    public function __construct($name, $pv, $mana, $initiative, $strenght)
    {
        parent::__construct($name, $pv, $mana, $initiative, $strenght);
    }
}