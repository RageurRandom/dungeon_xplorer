<?php

/**
 * Une classe permettant de fabriquer des instances du modèle 
 */
class Factory{

    /**
     * céer et retourne une insence de Hero
     * @return Hero le héro
     */
    public static function heroInstance($_id, $_level, $_chapter, $_name, $_hp, $_max_hp, $_xp, $_mana, $_max_mana, $_strength, $_initiative, $_treasure, $_class){
        $_className = strtoupper($_class); 
        $hero = null; 

        switch($_className){

            case "GUERRIER":
                $hero = new Warrior($_id, $_level, $_chapter, $_name, $_hp, $_max_hp, $_xp, $_strength, $_initiative, $_treasure); 
                break; 
            
            case "VOLEUR":
                $hero = new Thief($_id, $_level, $_chapter, $_name, $_hp, $_max_hp, $_xp, $_mana, $_max_mana, $_strength, $_initiative, $_treasure); 
                break; 

            case "MAGICIEN":
                $hero = new Mage($_id, $_level, $_chapter, $_name, $_hp, $_max_hp, $_xp, $_mana, $_max_mana, $_strength, $_initiative, $_treasure); 
                break; 
            
        }

        return $hero; 
    }//fonction heroInstance()

    /**
     * crée et retourne une instece de l'item 
     * @param int $_id l'id de l'item dans la BDD
     * @return Item l'item
     */
    public static function itemInstance($_id, $_weight, $_name, $_desc, $_size, $_quantity){
        $DB = DataBase::getInstance(); 

        //Vérifier le type de l'item grâce à son ID

        $query = "select count(*) nb from weapon where item_id = $_id"; 
        $statement = $DB->unprepared_statement($query); 
        $result = $statement->fetchAll();

        //Si c'est une arme
        if($result[0]["nb"] > 0){
            //On récupère sa valeur d'attaque
            $query = "select weapon_attack_value from weapon where item_id = $_id"; 
            $statement = $DB->unprepared_statement($query); 
            $result = $statement->fetchAll();
            return new Weapon($_id, $result[0]["weapon_attack_value"], $_weight, $_name, $_desc, $_size, $_quantity); 
        }//Si c'est une arme

        $query = "select count(*) nb from armor where item_id = $_id"; 
        $statement = $DB->unprepared_statement($query); 
        $result = $statement->fetchAll();

        //Si c'est une armure
        if($result[0]["nb"] > 0){
            //On récupère sa valeur d'attaque
            $query = "select armor_defence_rate, armor_is_shield from armor where item_id = $_id"; 
            $statement = $DB->unprepared_statement($query); 
            $result = $statement->fetchAll();
            
            //Si c'est un bouclier
            if($result[0]["armor_is_shield"]){
                return new Shield($_id, $result[0]["armor_defence_rate"],0, $_weight, $_name, $_desc, $_size, $_quantity); 
            }//Si c'est un bouclier 

            //Si ce n'est pas un bouclier
            else{
                return new Armor($_id, $result[0]["armor_defence_rate"], $_weight, $_name, $_desc, $_size, $_quantity);
            }
        }//Si c'est une armure

        $query = "select count(*) nb from potion where item_id = $_id"; 
        $statement = $DB->unprepared_statement($query); 
        $result = $statement->fetchAll();

        //Si c'est une potion
        if($result[0]["nb"] > 0){
            //On récupère sa valeur d'attaque
            $query = "select potion_value from potion where item_id = $_id"; 
            $statement = $DB->unprepared_statement($query); 
            $result = $statement->fetchAll();
            return new Potion($_id, $result[0]["potion_value"], $_weight, $_name, $_desc, $_size, $_quantity); 
        }//Si c'est une potion

        //Si aucun de ces types
        return new Item($_id, $_weight, $_name, $_desc, $_size, $_quantity); 

    }//fonction itemInstance()


    /**
     * crée une instence de Spell en fonction des paramètres passés
     * @param int $_spellID l'ID du spell dans la BDD
     * @return Spell le sort
     */
    public static function spellInstance($_spellID, $_name, $_manaCost){
        $DB = DataBase::getInstance();
        //Vérifier le type de l'item grâce à son ID

        $query = "select count(*) nb from spell_boost where spell_id = $_spellID"; 
        $statement = $DB->unprepared_statement($query); 
        $result = $statement->fetchAll();

        //Si c'est un sort de boost
        if($result[0]["nb"] > 0){
            //On récupère sa cible et sa durée
            $query = "select spell_boost_value, spell_boost_target, spell_boost_duration from spell_boost where spell_id = $_spellID"; 
            $statement = $DB->unprepared_statement($query); 
            $result = $statement->fetchAll();
            return new BoostingSpell($_spellID, $result[0]["spell_boost_value"], $result[0]["spell_boost_target"], $result[0]["spell_boost_duration"],  $_name, $_manaCost); 
        }//Si c'est un sort de boost

        $query = "select count(*) nb from spell_attack where spell_id = $_spellID"; 
        $statement = $DB->unprepared_statement($query); 
        $result = $statement->fetchAll();

        //Si c'est un sort d'attaque
        if($result[0]["nb"] > 0){
            //On récupère sa valeur
            $query = "select spell_attack_value from spell_attack where spell_id = $_spellID"; 
            $statement = $DB->unprepared_statement($query); 
            $result = $statement->fetchAll();
            return new AttackingSpell($_spellID, $result[0]["spell_attack_value"], $_name, $_manaCost); 
        }//Si c'est un sort sort d'attaque

        return null; 
    }//fonction spellInstance()

}


?>