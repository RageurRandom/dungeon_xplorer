<?php
class Potion extends Item{

    protected int $value;


    public function __construct($_value ,$_weigt, $_name, $_desc, $_size)
    {
        $this->value = $_value;
        parent::__construct($_weigt, $_name, $_desc, $_size);
    }

    /**
     * @return int le bonus de la potion
     */
    public function getValue(){
        return $this->value;
    }

    /**
     * retorune un string représentant le type de l'item : item, armure, potion, bouclier ou arme
     */
    public function getType(){
        return "potion"; 
    }

}
?>