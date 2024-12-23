<?php
abstract class Spell {

    protected string $name;
    protected int $manaCost;

    public function __construct($_name, $_manaCost){
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