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

    public function getID(){
        return $this->ID; 
    }

    /**
     * permet de comparer un sort avec celui là. true si les deux possède le même ID
     * @param Spell $spell à comparer
     * @return bool le résultat
     */
    public function equals($spell){ 
        return $this->ID == $spell->getID(); 
    }

    /**
     * @return string le type du spell : attaque ou boost
     */
    public abstract function getType(); 
}
?>