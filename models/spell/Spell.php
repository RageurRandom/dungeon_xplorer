<?php
abstract class Spell {

    protected string $name;
    protected int $manaCost;
    protected int $ID;

    public function __construct($_ID, $_name, $_manaCost){
        $this->ID = $_ID;
        $this->name = $_name;
        $this->manaCost = $_manaCost ;
    }

    //récupére le nom du spell
    public function getName(){
        return $this->name;
    }

    //récupére le coût du spell
    public function getCost(){
        return $this->manaCost;
    }

    /**
     * @return string le type du spell : attaque ou boost
     */
    public abstract function getType(); 
}
?>