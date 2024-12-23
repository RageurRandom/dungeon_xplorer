<?php
class BoostingSpell extends Spell{

    protected int $boostValue;
    protected string $boostTarget; 
    protected int $boostDuration;

    public function __construct($_boostValue, $_boostTarget, $_boostDuration ,$_name, $_manaCost)
    {
        parent::__construct($_name,$_manaCost);

        $_boostTarget = strtolower($_boostTarget); 
        if($_boostTarget != "hp" && $_boostTarget != "initiative" && $_boostTarget != "strength"){
            throw new Exception("la cible d'un sort de boost doit être hp ou initiative ou strength"); 
        }
        $this->boostValue = $_boostValue; 
        $this->boostTarget = $_boostTarget;
        $this->boostDuration = $_boostDuration;
    }


    public function getBoostValue(){
        return $this->boostValue; 
    }

    public function getBoostTarget(){
        return $this->boostTarget; 
    }

    public function getBoostDuration(){
        return $this->boostDuration; 
    }

    /**
     * @return string le type du spell : attaque ou boost
     */
    public function getType(){
        return "boostingSpell"; 
    }


}
?>