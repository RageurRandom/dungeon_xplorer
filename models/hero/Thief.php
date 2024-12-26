<?php
class Thief extends Hero {

    
    public function __construct($_id, $_level, $_chapter, $_name, $_hp, $_max_hp, $_xp, $_mana, $_max_mana, $_strength, $_initiative, $_treasure){
        parent::__construct($_id, $_level, $_chapter, $_name, $_hp, $_max_hp, $_xp, $_mana, $_max_mana, $_strength, $_initiative, $_treasure);
    }

    public function getClass(){
        return "voleur"; 
    }

    /**
     * reçoit une attaque et diminue les PV
     * @param int $damage les dégâts à subire
     */
    public function recieveAttack($damage){
        if(isset($this->armor))
            $damage -= $this->armor->getDefenseValue();

        $defence = rand(1, 6) + (int)($this->initiative / 2);

        $true_damage = $damage - $defence;

        if($true_damage > 0){
            $this->reduceHP($true_damage);
        }
    }
}
?>