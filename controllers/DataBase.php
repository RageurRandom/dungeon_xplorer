<?php

/**
 * classe permettant de gérer tous les traitments nécessaires avec la base de donnée dx_11
 */
class DataBase{

    private static $instance = null; 
    private $DB; 

    /**
     * créer une instance de la classe DataBase 
     *  dont l'attribut $DB est une PDO de connexion à la BDD dx_11 en localhost  
     */
    private function __construct(){
        $DB_adresse = 'mysql:host=mysql-etu.unicaen.fr;port=3306;dbname=remo231_0;charset=utf8'; 
        $user = 'remo231'; 
        $password = 'iewoh5RooghohFa4'; 

        $this->DB = new PDO($DB_adresse, $user, $password); 
        $this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->DB->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    /**
     * Summary of getInstance
     * @return DataBase l'instance static de cette classe connectée à la BDD dx_11 en localhost
     */
    public static function getInstance(){
        if(self::$instance === null){
            self::$instance = new Database(); 
        }
        return self::$instance; 
    }

    /**
     * exécute une requête autre que SELECT
     * @param string $query la reqête à éxecuter (pas de SELECT)
     * @return int le nombre de lignes affectées sans les retourner 
     * @see prepared_statement pour exécuter une reqûete avec possibilité de récupération des lignes 
     */
    public function excute($query){
        $nbLines = $this->DB->exec($query);
        return $nbLines; 
    }

    /**
     * prépare une requête en utilisant des paramètres pour être ensuite exécutée ou affichée
     * @param string $query la requête à préparer utilisant des paramètres sous form ":param"
     * @return PDOStatement les lignes affectées par la reqête 
     * @see PDOStatement::fetchAll() pour trasformer la valeur de retour en string pour l'afficher
     * @see PDOStatement::execute() pour exécuter la reqête préparée
     */
    public function prepare_statement($query){
        $statement = $this->DB->prepare($query);
        return $statement; 
    }


    /**
     * Summary of unprepared_statement
     * @param string $query la requête à executer sans utiliser des paramètres
     * @return PDOStatement les lignes affectées par la reqête
     * @see toString pour trasformer la valeur de retour en string pour l'afficher
     */
    public function unprepared_statement($query){
            $statement = $this->DB->query($query); 
            return $statement; 
    }

    /**
     * créer un compte dans la base de donnée
     * @param string $userMail adresse mail du compte à créer
     * @param string $userPassword MDP du compte à créer
     * @param string $userName nom d'utilisateur du compte à créer
     * @param bool $userAdmin si le compte est un compte admin ou pas
     * @throws Exception si un compte existe déjà avec cette adresse mail
     */
    public static function createAccount($userMail, $userPassword, $userName, $userAdmin) {
        $DB = DataBase::getInstance();
        $userMail = strtoupper($userMail); 
        $userAdmin = $userAdmin==true ? 1 : 0; 

        $query = "select count(*) nb from user where upper(user_mail) = '$userMail'"; 
        $statement = $DB->unprepared_statement($query);
        $result = $statement->fetchAll(); 

        //Si un compte existe déjà avec cette adresse mail
        if($result[0]["nb"] > 0){
            die("Un compte existe déjà avec cet adresse mail : $userMail"); 
        }

        //Si aucun compte existe avec cette adresse mail
        try{
            //On l'insère
            $query = "insert into user (user_mail, user_password, user_name, user_admin) values ('$userMail', '$userPassword', '$userName', $userAdmin)"; 
            $nbLines = $DB->excute($query);
        }
        catch (PDOException $ex) {
            die("erreur de creation de compte : ".$ex->getMessage()); 
        }
    }//fonction createAccount()

    /**
     * permet de supprimer le compte d'un utilisateur dont le mail est passé en paramètre
     * @param string $userMail le mail à supprimer
     */
    public static function deleteAccount2($userMail){
        $DB = DataBase::getInstance();
        $userMail = strtoupper($userMail);

        $query = "delete from user where upper(user_mail) = '$userMail'"; 
        $nbLines = $DB->excute($query); 

        if($nbLines == 0)
            die("Impossible de supprimer le comtpe de cette adresse mail : $userMail. soit le compte n'existe pas, soit une autre erreur s'est produite");
        else if($nbLines > 1)
            die("Une erreur s'est produite");
    }

    /**
     * permet de supprimer le compte de l'utilsiateur connnecté
     */
    public static function deleteAccount(){
        $DB = DataBase::getInstance();
        $userMail = strtoupper($_SESSION["userMail"]);

        $query = "delete from user where upper(user_mail) = '$userMail'"; 
        $nbLines = $DB->excute($query); 

        if($nbLines == 0)
            die("Impossible de supprimer le comtpe de cette adresse mail : $userMail. soit le compte n'existe pas, soit une autre erreur s'est produite");
        else if($nbLines > 1)
            die("Une erreur s'est produite");
    }

    /**
     * permet de changer le MDP de l'utilisateur connecté
     * @param string $newPassword le nouveau MDP déjà haché
     */
    public static function changePassword($newPassword){
        $DB = DataBase::getInstance();
        $userMail = strtoupper($_SESSION["userMail"]);

        //On change le MDP dans la BDD
        $query = "update user set user_password = '$newPassword' where upper(user_mail) = '$userMail'"; 
        $nbLines = $DB->excute($query); 

        if($nbLines == 0)
            die("Impossible de changer le MDP pour cette adresse mail : $userMail");
        else if($nbLines > 1)
            die("Une erreur s'est produite");
    }//fonction changePassword()

    /**
     * permet de changer le nom de l'utilisateur connecté
     * @param string $newUserName le nouveau nom
     */
    public static function changeUserName($newUserName){
        $DB = DataBase::getInstance();
        $userMail = strtoupper($_SESSION["userMail"]);

        //On change le MDP dans la BDD
        $query = "update user set user_name = '$newUserName' where upper(user_mail) = '$userMail'"; 
        $nbLines = $DB->excute($query); 

        if($nbLines == 0)
            die("Impossible de changer le nom pour cette adresse mail : $userMail");
        else if($nbLines > 1)
            die("Une erreur s'est produite");
    }//fonction changePassword()

    /**
     * retorun un tableau de toutes les lignes de user
     */
    public static function getAccounts(){
        $DB = DataBase::getInstance();
        $querry = "SELECT * FROM user";
        $statement = $DB->unprepared_statement($querry);
        $result = $statement->fetchAll();
        return $result;
    }//fonction getAccounts

    /**
     * récupère un compte depuis la base de donnée
     * @param string $userMail adresse mail du compte à récupérer
     * @return array $result un tableau contenant les infos du compte
     * @throws Exception si aucun compte existe pour cette adresse
     */
    public static function getAccount($userMail){
        $DB = DataBase::getInstance();
        $userMail = strtoupper($userMail);

        $query = "select * from user where upper(user_mail) = '$userMail'"; 
        $statement = $DB->unprepared_statement($query);
        $result = $statement->fetchAll();
        
        if(count($result) === 0)
            die("Aucun compte n'existe avec cette adresse mail : $userMail"); 

        return $result; 
    }//fonction getAccount()

    /**
     * permet de supprimer un chapitre de la BDD. Tous les heros qui se trouve à ce chapitre vont revenir au chapitre 1
     * @param int $chapterNum numéro du chapitre à suppriemr
     */
    public static function deleteChapter($chapterNum){
        $DB = DataBase::getInstance();

        //On enlève l'avancement de tout les heros qui se trouvent à ce chapitre
        $querry = "update hero set chapter_num = 1 where chapter_num = $chapterNum";
        $nbLines = $DB->excute($querry);

        //On supprime les liens du chapitre 
        $querry = "DELETE FROM link WHERE chapter_num = $chapterNum OR chapter_num_next = $chapterNum";
        $nbLines = $DB->excute($querry);

        //On décrémente de 1 les lines chapitre 
        $querry = "UPDATE link SET chapter_num = chapter_num - 1 WHERE chapter_num > $chapterNum";
        $nbLines = $DB->excute($querry);
        $querry = "UPDATE link SET chapter_num_next = chapter_num_next - 1 WHERE chapter_num_next > $chapterNum";
        $nbLines = $DB->excute($querry);

        //On supprime le chapitre
        $querry = "DELETE FROM chapter WHERE chapter_num = $chapterNum";
        $nbLines = $DB->excute($querry);

        //On décremente de 1 le numéro de tous les chapitres dont le num était sup à celui là
        $querry = "UPDATE chapter SET chapter_num = chapter_num - 1 WHERE chapter_num > $chapterNum";
        $nbLines = $DB->excute($querry);
        
    }//Fonction deleteChapter()

    /**
     * retorun un tableau de toutes les lignes de chapter
     */
    public static function getChapters(){
        $DB = DataBase::getInstance();
        $querry = "SELECT * FROM chapter";
        $statement = $DB->unprepared_statement($querry);
        $result = $statement->fetchAll();
        return $result;
    } 

    /**
     * @param int $chapterNum numéro du chapitre
     * @return array tableaux des infos du chapitre
     * @throws Exception si aucun chapitre existe pour ce numéro
     */
    public static function getChapter($chapterNum) {
        try{
            // Query to get chapter content
            $DB = DataBase::getInstance();
            $querry = "SELECT * FROM chapter WHERE chapter_num = $chapterNum";
            $statement = $DB->unprepared_statement($querry);
            $result = $statement->fetchAll();

        }catch(Exception $e){
            die("erreur getChapitre : " . $e->getMessage());
        }

        if (count($result) > 0) {
            return $result;
        } else {
            die("aucun chapitre existe avec ce numéro : $chapterNum");
        }
    }//fonction getChapter()

    /**
     * @param string $ClassName nom de la class à récupérer
     * @return array tableaux des infos de la classe
     * @throws Exception si aucune classe existe pour ce nom
     */
    public static function getClass($className){
        $DB = DataBase::getInstance();
        $className = strtoupper($className);

        $query = "select * from class where upper(class_name) = '$className'"; 
        $statement = $DB->unprepared_statement($query);
        $classInfos = $statement->fetchAll();

        if (count($classInfos) > 0) {
            return $classInfos;
        } else {
            die("aucune classe existe avec ce nom : $className");
        }
    }//fonction getClass()

    /**
     * @param int $ClassID id de la class à récupérer
     * @return array tableaux des infos de la classe
     * @throws Exception si aucune classe existe pour ce nom
     */
    public static function getClassByID($classID){
        $DB = DataBase::getInstance();

        $query = "select * from class where class_id = $classID"; 
        $statement = $DB->unprepared_statement($query);
        $classInfos = $statement->fetchAll();

        if (count($classInfos) > 0) {
            return $classInfos;
        } else {
            die("aucune classe existe avec cet ID : $classID");
        }
    }//fonction getClassByID()


    /**
     * retourne toutes les lignes de Inventory assiciée au hero passé en paramètre + les infos de chaque item
     * @param int $heroID le ID du héro
     */
    public static function getInventory($heroID){
        $DB = DataBase::getInstance();
        $query = "select * from inventory 
                    join item using (item_id)
                    where hero_id = $heroID"; 
        $statement = $DB->unprepared_statement($query); 
        $result = $statement->fetchAll();
        return $result;
    }

    /**
     * retourne toutes les lignes de spell_book assiciées au hero passé en paramètre + les infos de chaque spell
     * @param int $heroID le ID du héro
     */
    public static function getSpells($heroID){
        $DB = DataBase::getInstance();
        $query = "select * from spell_book 
                    join spell using (spell_id)
                    where hero_id = $heroID"; 
        $statement = $DB->unprepared_statement($query); 
        $result = $statement->fetchAll();
        return $result;
    }

    /**
     * @param int $chapter_num numéro du chapitre
     * @return array tableaux avec les différents choix possibles
     */
    public static function getLinks($chapter_num){
        try{
            $DB = DataBase::getInstance();
            $querry = "SELECT * FROM link WHERE chapter_num = ?";

            $statement = $DB->prepare_statement($querry);
            $statement->bindParam(1, $chapter_num);
            $statement->execute();
            $result = $statement->fetchAll();

        } catch(Exception $e){
            die("erreur getLinks : ".$e->getMessage());
        }

        if (count($result) > 0) {
            return $result; 
        } else {
            return "No link found for chapter " . $chapter_num;
        }
    }//fonction getLinks()

    public static function getItem($itemID){
        $DB = DataBase::getInstance(); 
        $query = "select * from item where item_id = $itemID"; 
        $statement = $DB->unprepared_statement($query); 
        $result = $statement->fetchAll();

        if(count($result) <= 0)
            die("impossible de trouver l'item $itemID dans la BDD"); 
        return $result; 
    }

    public static function getSpell($spellID){
        $DB = DataBase::getInstance(); 
        $query = "select * from spell where spell_id = $spellID"; 
        $statement = $DB->unprepared_statement($query); 
        $result = $statement->fetchAll();
        if(count($result) <= 0)
            die("impossible de trouver le spell $spellID dans la BDD"); 
        return $result;
    }

    /**
     * @param int $levelNum numéro du niveau
     * @param string $class type de l'hero : guerrier, voleur ou magicien
     * @return array|bool tableau contenant le niveau, false si le niveau n'existe pas 
     */
    public static function getLevel($levelNum, $class){
        $DB = DataBase::getInstance(); 
        $classID = null; 
        switch($class){
            case "magicien": $classID = 3; break; 
            case "voleur": $classID = 2; break; 
            case "guerrier": $classID = 1; break; 
            default : return false; 
        }
        $query = "select * from level where level_num = $levelNum and class_id = $classID"; 
        $statement = $DB->unprepared_statement($query); 
        $result = $statement->fetchAll();

        if (count($result) > 0) return $result; 
        else return false;
    }

    /**
     * permet de vérifier si un lien existe entre deux chapitres
     * @param int $currentChap chapitre actuel 
     * @param int $nextChap chapitre suivant
     * @return bool le résultat
     */
    public static function linkExists($currentChap, $nextChap){
        $DB = DataBase::getInstance(); 
        $query = "select count(*) nb from link where chapter_num = $currentChap and chapter_num_next = $nextChap"; 
        $statement = $DB->unprepared_statement($query); 
        $result = $statement->fetchAll();

        if($result[0]["nb"] == 0)
            return false; 

        return true; 
    }//fonction linkExists()

    /**
     * récupère un hero depuis la base de donnée
     * @param string $userMail adresse mail du compte possèdant le hero
     * @return array $result un tableau contenant les infos du hero et les infos de sa classe
     * @throws Exception si aucun hero n'est associé à ce compte
     */
    public static function getHero($userMail){
        $DB = DataBase::getInstance();
        $userMail = strtoupper($userMail);

        $query = "select * from user 
                    join hero using(hero_id)
                    join class using (class_id) 
                    where upper(user_mail) = '$userMail'"; 
        $statement = $DB->unprepared_statement($query); 
        $result = $statement->fetchAll();

        if ($result[0]["hero_id"] == null) {
            die("aucun hero n'est associé à cette adresse mail : $userMail");
        } else {
            return $result;
        }
        
    }

    /**
     * permet de savoir si une adresse mail est associé à un héro 
     * @param string $userMail l'adresse mail à vérifier
     * @return bool true si oui
     */
    public static function hasHero($userMail){
        $DB = DataBase::getInstance();
        $userMail = strtoupper($userMail);

        $query = "select count(*) nb from user where hero_id is not null and upper(user_mail) = '$userMail'"; 
        $statement = $DB->unprepared_statement($query); 
        $result = $statement->fetchAll();
        
        if($result[0]["nb"] == 0)
            return false; 
        return true; 
    }//fonction hasHero 

    /**
     * @return int $ID le prochain ID du hero à insérer
     */
    public static function nextHeroID(){
        $DB = DataBase::getInstance();

        $query = "select max(hero_id) max from hero"; 
        $statement = $DB->unprepared_statement($query); 
        $result = $statement->fetchAll(); 

        if($result[0]["max"] == null)
            return 1; 
        else
            return $result[0]["max"]+1; 
    }
    
    /**
     * permet de réinitialiser les valeur du hero d'un utilisateur
     * @param string $userMail adresse mail de l'utilisateur
     */
    public static function resetHero($userMail){
        $DB = DataBase::getInstance(); 
        $userMail = strtoupper($userMail); 

        //on récupère les infos du hero
        $infosHero = DataBase::getHero($_SESSION["userMail"])[0]; 

        //On réinitialise les infos 
        $query = "update hero set level_num = 1, chapter_num = 1, hero_HP = ".$infosHero["class_starting_HP"].",
                                    hero_max_HP = ".$infosHero["class_starting_HP"].", hero_XP = 0, 
                                    hero_mana = ".$infosHero["class_starting_mana"].", hero_max_mana = ".$infosHero["class_starting_mana"].",
                                    hero_strength = ".$infosHero["class_starting_strength"].", hero_initiative = ".$infosHero["class_starting_intitiative"].",
                                    hero_treasure = 0
                                    where hero_id = ".$infosHero["hero_id"];

        $nbLines = $DB->excute($query);
        if($nbLines != 1){
            die("une erreur s'est produite lors de la réinitialisation du hero ".$infosHero["hero_id"]); 
        } 
        else{
            //On vide l'inventaire et le spell_book
            $query = "delete from inventory where hero_id = ".$infosHero["hero_id"];
            $nbLines = $DB->excute($query);

            $query = "delete from spell_book where hero_id = ".$infosHero["hero_id"];
            $nbLines = $DB->excute($query);
        }

    }
    /**
     * insère un nouvel héro dans la base de donnée pour l'utilisateur connecté
     * @param string $heroClass nom de la classe de l'héro à insérer
     * @param string $heroName nom de l'héro
     */
    public static function addHero($heroClass, $heroName){
        $DB = DataBase::getInstance(); 
        $userMail = strtoupper($_SESSION["userMail"]); 

        //On récupère les inofs de la classe
        $classInfos = DataBase::getClass($heroClass);

        //on les stock dans des variables
        $classID = $classInfos[0]["class_id"]; 
        $classHP = $classInfos[0]["class_starting_HP"]; 
        $classMana = $classInfos[0]["class_starting_mana"]; 
        $classInitiative = $classInfos[0]["class_starting_intitiative"]; 
        $classStrength = $classInfos[0]["class_starting_strength"];

        //On récupère l'ID de lho à inserer
        $heroID = DataBase::nextHeroID(); 

        //On insère le héro avec les informations renseignés et rcupérées
        $query = "insert into hero (hero_id, class_id, level_num, chapter_num, hero_name, hero_HP, hero_max_HP, hero_XP, hero_mana,
                                    hero_max_mana, hero_strength, hero_initiative, hero_treasure) 
                                    values ($heroID, $classID, 1, 1, '$heroName', $classHP, $classHP, 0, $classMana, $classMana, $classStrength, $classInitiative, 0)"; 
        $nbLines = $DB->excute($query);

        if($nbLines == 0)
            die("impossible d'insérer le héro dans la base de donnée");
        else if($nbLines > 1)
            die("une erreure s'est produite");

        //On insère le hero dans la table user
        $query = "update user set hero_id = $heroID where upper(user_mail) = '$userMail'"; 
        $nbLines = $DB->excute($query); 

        if($nbLines == 0)
            die("impossible d'associer l'héro à l'utilisateur");
        else if($nbLines > 1)
            die("une erreure s'est produite");
    }//fontion addHero()

    /**
     * permet d'enregistrer les infos du hero dans la BDD
     * @param Hero $hero le hero à sauvegarder
     */
    public static function saveHero($hero){  
        $DB = DataBase::getInstance(); 

        //On stock les infos dans des variables
        $heroID = $hero->getID(); $levelNum = $hero->getLevel(); $ChapterNum = $hero->getChapter(); 
        $heroHP = $hero->getCurrentHP(); $heroMaxHP = $hero->getMaxHP(); $heroXP = $hero->getXP();
        $heroMana = $hero->getCurrentMana(); $heroMaxMana = $hero->getMaxMana(); $heroStrength = $hero->getStrength(); 
        $heroInitiative = $hero->getInitiative(); $heroTreasure = $hero->getTreasure(); $heroInventory = $hero->getInventory(); 
        $heroSpellBook = $hero->getSpellBook(); 

        //On met à jour la table hero
        $query = "update hero set 
                    level_num = $levelNum, chapter_num = $ChapterNum, hero_HP = $heroHP, hero_max_HP = $heroMaxHP,
                    hero_XP = $heroXP, hero_mana = $heroMana, hero_max_mana = $heroMaxMana, hero_strength = $heroStrength,
                    hero_initiative = $heroInitiative, hero_treasure = $heroTreasure
                    where hero_id = $heroID"; 
        $nbLines = $DB->excute($query); 

        //si la mise à jour de hero est impossible
        if($nbLines != 1){
            die("impossible de mettre à jour la table hero"); 
        }//si la mise à jour de hero est impossible

        //On met à jour la table inventory
        $query = "delete from inventory where hero_id = $heroID"; 
        $nbLines = $DB->excute($query);
        foreach($heroInventory as $index => $item){
            $itemID = $item->getID(); 
            $itemQuantity = $item->getQuantity(); 
            $query = "insert into inventory (hero_id, item_id, item_quantity) values ($heroID, $itemID , $itemQuantity)"; 
            $nbLines = $DB->excute($query);
            if($nbLines != 1){
                die("impossible de sauvegarder l'item $itemID");
            }
        }//On met à jour la table inventory

        //On met à jour la table spell
        $query = "delete from spell_book where hero_id = $heroID"; 
        $nbLines = $DB->excute($query);
        foreach($heroSpellBook as $index => $spell){
            $spellID = $spell->getID();  
            $query = "insert into spell_book (hero_id, spell_id) values ($heroID, $spellID)"; 
            $nbLines = $DB->excute($query);
            if($nbLines != 1){
                die("impossible de sauvegarder le spell $spellID");
            }
        }//On met à jour la table inventory

        //On revient au chapitres 
        header("Location: /dx_11/chapitre"); 
    }//fonction saveHero()

    /**
     * permet de retourner un monstre de la table monster
     * @param int $monster_id l'ID du monstre à retourner
     */
    public static function getMonster($monster_id){
        $DB = DataBase::getInstance();

        $querry = "SELECT * FROM monster WHERE monster_id = $monster_id";
        $statement = $DB->unprepared_statement($querry);
        $results = $statement->fetchAll();

        if(count($results) > 0){
            return $results; 
        }
        else{
            die("aucun monstre trouvé avec cet ID : $monster_id"); 
        }
    }//Fonction getMonster()

    /**
     * retourne toutes les lignes de loot associée au monstre passé en paramètre + les infos de chaque item
     * @param int $monster_id le ID du monstre
     * @return array resultats de la requete
     */
    public static function getLoot($monster_id){
        $DB = DataBase::getInstance();
        $query = "select * from loot 
                    join item using (item_id)
                    where monster_id = $monster_id"; 
        $statement = $DB->unprepared_statement($query); 
        $result = $statement->fetchAll();
        return $result;
    }//Fonction getLoot


}
?>