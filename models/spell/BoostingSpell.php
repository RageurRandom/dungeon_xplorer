<?php
class BoostingSpell extends Spell{
    protected $boost_value;

    public function __construct($boost_values,$nomval,$priceval)
    {
        $this->boost_value = $boost_values;
        parent::__construct($nomval,$priceval);
    }

    //récupére la valeur du boost
    public function getBoost_value(){
        return $boost_value;
    }


}