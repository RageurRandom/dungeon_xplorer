<?php
class AttackingSpell extends Spell{


    protected int $attackValue;

    public function __construct($_attackValue ,$_name, $_manaCost)
    {
        parent::__construct($_name,$_manaCost);
        $this->attackValue = $_attackValue;
    }

    //récupére la valeur de l'attaque
    public function getAttackValue(){
        return $this->attackValue;
    }

    /**
     * @return string le type du spell : attaque ou boost
     */
    public function getType(){
        return "attackingSpell"; 
    }

}
?>