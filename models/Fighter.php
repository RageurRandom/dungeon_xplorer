<?pHP
class Fighter {
    
    protected  string $name;
    protected int $HP;
    protected int $mana;
    protected int $initiative;
    protected int $strength;
    protected int $maxHP; 
    protected int $maxMana; 

    protected array $spellBook; 

    public function __construct($_name, $_HP, $_maxHP, $_mana, $_maxMana, $_initiative, $_strength)
    {
        $this->name = $_name;
        $this->HP = $_HP;
        $this->mana = $_mana;
        $this->initiative = $_initiative;
        $this->strength = $_strength;
        $this->maxHP = $_maxHP;
        $this->maxMana = $_maxMana;
        $this->spellBook = []; 
    }

    /**
     * fait des dégats à l'adversaire passé en paramètre
     * @param Combattant $adversaire à attaquer 
     * @return int nb de dégâts infligés
     */
    public function attack($opponent){
        $damages = rand(1, 6) + $this->strength;
        $trueDamage = $opponent->recieveAttack($damages);
    
        return $trueDamage;
    }

    /**
     * reçoit une attaque et diminue les PV
     * @param int $damage les dégâts à subire
     * @return int nb de dégâts réellement subis (après défense)
     */
    public function recieveAttack($damage){
        $defence = rand(1, 6) + (int)($this->strength / 2);
        $trueDamage = $damage - $defence;

        if($trueDamage > 0){
            $this->reduceHP($trueDamage);
            return $trueDamage;
        }

        return 0; //aucun dégât subis
    }

    /**
     * @param Spell $spell le sort à ajouter
     * @return bool true si l'ajout est réussi, false sinon
     */
    public function collecteSpell($spell){

        foreach($this->spellBook as $index => $spellS){
            if($spellS->equals($spell))
                return false; 
        }

        $index = count($this->spellBook);
        $this->spellBook[$index] = $spell; 
        return true; 
    }

    /**
     * la durée du spell n'est pas encore prise en compte
     * @param BoostingSpell $spell le sort à ajouter
     */
    public function useBoostingSpell($spell){

        if($spell->getType() != "boostingSpell")
            throw new Exception("useBoostingSpell : ce sort n'est pas un sort de boost"); 

        if($spell->getCost() > $this->getCurrentMana())
            return; 

        else{
            $spellTarget = $spell->getBoostTarget(); 

            switch($spellTarget){

                case "hp":
                    $this->addMaxHP($spell->getBoostValue());
                    $this->addHP($spell->getBoostValue());
                    break; 
                
                case "initiative":
                    $this->addInitiative($spell->getBoostValue());
                    break; 

                case "strength":
                    $this->addStrength($spell->getBoostValue());
                    break; 
            }

            $this->reduceMana($spell->getCost()); 
        }
    }

    /**
     * fait des dégats à l'adversaire passé en paramètre
     * @param Combattant $adversaire à attaquer
     * @param AttackingSpell $spell sort à utiliser 
     */
    public function useAttackingSpell($spell, $adversaire){

        if($spell->getType() != "attackingSpell")
            throw new Exception("useAttackingSpell : ce sort n'est pas un sort d'attaque"); 

        if($spell->getCost() > $this->getCurrentMana())
            return; 

        $adversaire->recieveAttack($spell->getAttackValue()); 

        $this->reduceMana($spell->getCost()); 
    }


    /**
     * @return bool si ce combattant est mort
     */
    public function isDead(){
        return $this->HP <= 0; 
    }
    

    /**
     * ajoute des PV aux PV actuels. le résultat ne dépasse pas PV max
     * @param int $quant la quantité de PV à ajouter
     * @return int la nouvelle valeur de PV
     */
    public function addHP($quant){

        $newHP = $this->HP + $quant;

        if($newHP >= $this->maxHP)
            $this->HP = $this->maxHP; 
        else
            $this->HP = $newHP;

        return $this->HP; 
    }


    /**
     * ajoute des PV aux PV max.
     * @param int $quant la quantité de PV à ajouter
     * @return int la nouvelle valeur de PV max
     */
    public function addMaxHP($quant){
        $this->maxHP += $quant; 
        return $this->maxHP; 
    }

    /**
     * ajoute du mana aux mana actuel. le résultat ne dépasse pas mana max
     * @param int $quant la quantité de mana à ajouter
     * @return int la nouvelle valeur de mana
     */
    public function addMana($quant){

        $newMana = $this->mana + $quant;

        if($newMana >= $this->maxMana)
            $this->mana = $this->maxMana; 
        else
            $this->mana = $newMana;

        return $this->mana; 
    }

    /**
     * ajoute du mana aux ana max.
     * @param int $quant la quantité de mana à ajouter
     * @return int la nouvelle valeur de mana max
     */
    public function addMaxMana($quant){
        $this->maxMana += $quant; 
        return $this->maxMana; 
    }

    /**
     * enlève des PV aux PV actuels.
     * @param int $quant la quantité de PV à enlever
     * @return int la nouvelle valeur de PV
     */
    public function reduceHP($quant){
        $newHP = $this->HP - $quant;

        if($newHP <= 0)
            $this->HP = 0; 
        else
            $this->HP = $newHP;

        return $this->HP; 
    }

    /**
     * enlève du mana aux mana actuel.
     * @param int $quant la quantité de mana à enlèver
     * @return int la nouvelle valeur de mana
     */
    public function reduceMana($quant){

        $newMana = $this->mana - $quant;

        if($newMana <= 0)
            $this->mana = 0; 
        else
            $this->mana = $newMana;

        return $this->mana; 
    }

    /**
     * ajoute de l'initiative.
     * @param int $quant la quantité à ajouter
     * @return int la nouvelle valeur de initiative
     */
    public function addInitiative($quant){
        $this->initiative += $quant; 
        return $this->initiative; 
    }


    /**
     * ajoute de la force.
     * @param int $quant la quantité à ajouter
     * @return int la nouvelle valeur de la force
     */
    public function addStrength($quant){
        $this->strength += $quant; 
        return $this->strength; 
    }
    
    /**
     * @return string le nom du combattant
     */
    public function getName(){
        return $this->name;
    }

    /**
     * @return array $this->spellBook
     */
    public function getSpellBook(){
        return $this->spellBook; 
    }

    /**
     * @return int les PV actuels du combattant
     */
    public function getCurrentHP(){
        return $this->HP;
    }

    /**
     * @return int les PV max du combattant
     */
    public function getMaxHP(){
        return $this->maxHP;
    }


    /**
     * @return int le mana actuel du combattant
     */
    public function getCurrentMana(){
        return $this->mana;
    }

    /**
     * @return int le mana max du combattant
     */
    public function getMaxMana(){
        return $this->maxMana;
    }


    /**
     * @return int l'initiative actuel du combattant
     */
    public function getInitiative(){
        return $this->initiative;
    }


    /**
     * @return int la force du combattant
     */
    public function getStrength(){
        return $this->strength;
    }
}
?>