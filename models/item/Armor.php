<?php
class Armor extends Item{
    protected $defense_value;

    public function __construct($defense_value,$weigt, $name, $desc, $size)
    {
        $this->defense_value = $defense_value;
        parent::__construct($weigt, $name, $desc, $size);
    }

    //récupére la valeur de défence de l'objet
    public function getDefense_value(){
        return $defense_value
    }
}
?>