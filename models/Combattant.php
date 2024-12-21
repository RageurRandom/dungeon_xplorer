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

    //récupére le nom du combattant
    public function getName(){
        return $name;
    }

    //définie le nom du combattant
    public function setName($newName){
        $name = $newName
    }



    //récupére les poins de vis du combattant
    public function getPv(){
        return $pv;
    }

    //définie les poins de vis du combattant
    public function setPv($newPv){
        $pv = $newPv
    }



    //récupére les poins de Mana du combattant
    public function getMana(){
        return $mana;
    }

    //définie les poins de Mana du combattant
    public function setMana($newMana){
        $mana = $newMana;
    }


    //récupére l'initiative du combattant
    public function getInitiative(){
        return $initiative;
    }

    //définie l'initiative du combattant
    public function setMana($newInitiative){
        $initiative = $newInitiative;
    }


    //récupére les dégat du combattant
    public function getInitiative(){
        return $strenght;
    }

    //définie les dégat du combattant
    public function setMana($newStrenght){
        $strenght = $newStrenght;
    }
}
?>