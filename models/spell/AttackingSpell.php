<?php
class AttackingSpell extends Spell{
    protected $attack_values;

    public function __construct($attack_values,$nomval,$priceval)
    {
        $this->attack_values = $attack_values;
        parent::__construct($nomval,$priceval);
    }

    //récupére la valeur de l'attaque
    public function getAttack_values(){
        return $attack_values;
    }


}