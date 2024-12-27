<?php
class Warrior extends Hero {

    protected Shield $shield; 

    public function __construct($_id, $_level, $_chapter, $_name, $_hp, $_max_hp, $_xp, $_strength, $_initiative, $_treasure){
        parent::__construct($_id, $_level, $_chapter, $_name, $_hp, $_max_hp, $_xp, 0, 0, $_strength, $_initiative, $_treasure);
        unset($this->shield); 
    }


    /**
     * permet de porter un buclier
     * @param Shield $_shield le buclier à porter 
     */
    public function holdShield($_shield){
        $this->shield = $_shield; 
    }

    /**
     * permet de retirer l'armure portée
     */
    public function removeShield(){
        unset($this->shield); 
    }

    /**
     * renvoie le bouclier tenu
     * @return Shield bouclier équipé
     */
    public function getShield(){
        return $shield;
    }

    /**
     * reçoit une attaque et diminue les PV
     * @param int $damage les dégâts à subire
     */
    public function recieveAttack($damage){

        if(isset($this->shield)){
            $damage -= $this->shield->getDefenseValue();
        }
        parent::recieveAttack($damage); 
    }

    public function getClass(){
        return "guerrier"; 
    }

    /**
     * ajoute du mana aux mana actuel. le résultat ne dépasse pas mana max
     * @param int $quant la quantité de mana à ajouter
     * @return int la nouvelle valeur de mana
     */
    public function addMana($quant){
        
    }

    /**
     * ajoute du mana aux mana max.
     * @param int $quant la quantité de mana à ajouter
     * @return int la nouvelle valeur de mana max
     */
    public function addMaxMana($quant){
        
    }

        /**
     * @param Spell $spell le sort à ajouter
     */
    public function collecteSpell($spell){
        
    }

    /**
     * la durée du spell n'est pas encore prise en compte
     * @param BoostingSpell $spell le sort à ajouter
     */
    public function useBoostingSpell($spell){
        
    }

    /**
     * fait des dégats à l'adversaire passé en paramètre
     * @param Combattant $adversaire à attaquer
     * @param AttackingSpell $spell sort à utiliser 
     */
    public function useAttackingSpell($spell, $adversaire){
        
    }
}
?>