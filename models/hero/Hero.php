<?php
abstract class Hero extends Fighter{

    protected static int $maxInventoryWeight = 100;
    protected static int $InventorySize = 100; 

    protected int $XP;
    protected int $level;
    protected int $ID;
    protected int $chapter;

    protected array $inventory = [];  

    protected ?Armor $armor; 
    protected ?Weapon $weapon; 

    protected int $treasure; 

    public function __construct($_ID, $_level, $_chapter, $_name, $_hp, $_max_hp, $_XP, $_mana, $_max_mana, $_strength, $_initiative, $_treasure){
        parent::__construct($_name, $_hp, $_max_hp, $_mana, $_max_mana, $_initiative, $_strength);
        $this->ID = $_ID; 
        $this->chapter = $_chapter;  
        $this->level = $_level;  
        $this->XP = $_XP; 
        $this->armor = null; 
        $this->weapon = null; 
        $this->treasure = $_treasure; 
    }

    /**
     * fait des dégats à l'adversaire passé en paramètre
     * @param Combattant $adversaire à attaquer 
     */
    public function attack($adversaire){

        if(isset($this->weapon))
            $adversaire->recieveAttack($this->weapon->getAttackValue() * $this->strength); //TODO modifier la formule si besoin
        else
            parent::attack($adversaire); 
    }

    /**
     * reçoit une attaque et diminue les PV
     * @param int $damage les dégâts à subire
     */
    public function recieveAttack($damage){

        if(isset($this->armor))
            $damage -= $this->armor->getDefenseValue();

        parent::recieveAttack($damage); 
    }

    /**
     * permet de porter une armure
     * @param Armor $armor l'armure à porter
     */
    public function putArmor($armor){
        $this->armor = $armor; 
    }

    /**
     * permet de retirer l'armure portée
     */
    public function removeArmor(){
        unset($this->armor); 
    }

    /**
     * permet de porter une arme
     * @param Weapon $weapon l'arme à porter
     */
    public function holdWeapon($weapon){
        $this->weapon = $weapon; 
    }

    /**
     * permet de retirer l'arme portée
     */
    public function removeWeapon(){
        unset($this->weapon); 
    }

    /**
     * permet de consommer une potion
     * @param Poion $potion la potion à consommer
     */
    public function consumePotion($potion){
        $this->addHP($potion->getValue()); 
    }

    /**
     * ajoute un item à l'inventaire
     * @param Item l'item à ajouter
     * @return bool si l'ajout est réussi 
     */
    public function collecteItem($item){

        if( (self::$maxInventoryWeight - $this->inventoryWeight()) < ($item->getWeight()*$item->getQuantity()) ){
            return false; 
        }
        else if ( (self::$InventorySize - $this->InventoryUsedSize()) < $item->getSize()*$item->getQuantity() ){
            return false;;
        }

        else{

            foreach($this->inventory as $index => $itemS){
                if($itemS->equals($item)){
                    $itemS->addQuantity($item->getQuantity());
                    return true; 
                }
            }

            $index = count($this->inventory);
            $this->inventory[$index] = $item; 
            return true; 
        }  
    }

    /**
     * retire un item de l'inventaire. la référence de l'item passé en parmètre doit correspondre à celle de l'item à retirer 
     * @param Item l'item à retirer
     * @return bool si c'est réussi 
     */
    public function dropItem($item){

        if(in_array($item, $this->inventory)){
            $index = array_search($item, $this->inventory, true); 
            unset($this->inventory[$index]); 
        }
    }

    /**
     * @return int le poids actuel de l'inventaire
     */
    public function inventoryWeight(){
        $weight = 0; 
        foreach($this->inventory as $index => $item){
            $weight += ($item->getWeight()*$item->getQuantity()); 
        }
        return $weight; 
    }

    /**
     * @return int le volume occupé de l'inventaire
     */
    public function InventoryUsedSize(){
        $size = 0; 
        foreach($this->inventory as $index => $item){
            $size += ($item->getSize()*$item->getQuantity()); 
        }
        return $size; 
    }

    /**
     * @return string la classe de l'héro
     */
    public abstract function getClass(); 

    /**
     * rajoute de l'XP au héro
     * @param int $eXPeirence à ajouter
     */
    public function addXP($eXPerience) {
        $this->XP += $eXPerience;
    }

    /**
     * rajoute du tresor au héro
     * @param int $quant à ajouter
     */
    public function addTreasure($quant) {
        $this->treasure += $quant;
    }

    /**
     * @return array $this->inventory
     */
    public function getInventory(){
        return $this->inventory; 
    }

    /**
     * augmente le niveau de 1 
     */
    public function levelUp() {
        $this->level++; 
    }

    public function getXP(){
        return $this->XP; 
    }

    public function getTreasure(){
        return $this->treasure; 
    }

    public function getLevel(){
        return $this->level; 
    }

    public function getID(){
        return $this->ID; 
    }

    public function getChapter(){
        return $this->chapter; 
    }

    public function setChapter($chap){
        return $this->chapter = $chap; 
    }

    public function getArmor(){
        return $this->armor; 
    }

    public function getWeapon(){
        return $this->weapon; 
    }

}
?>