<?php

class DataBase{

    private static $instance = null; 
    private $DB; 

    /**
     * créer une instance de la classe DataBase 
     *  dont l'attribut $DB est une PDO de connexion à la BDD dx_11 en localhost  
     */
    private function __construct(){

        $DB_adresse = 'mysql:host=localhost;port=3306;dbname=dx_11;charset=utf8'; 
        $user = 'root'; 
        $password = ''; 

        try{
            $this->DB = new PDO($DB_adresse, $user, $password); 
            $this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->DB->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }
        catch(PDOException $e){
            die('erreure de connexion : '.$e->getMessage());
        }
        
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

        try{
            $nbLines = $this->DB->exec($query);
        }
        catch(PDOException $e){
            echo('requête impossible à excécuter excute()'.$e->getCode());
        } 

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

        try{
            $statement = $this->DB->prepare($query);
            return $statement; 
        }
        catch(PDOException $e){
            die('requête impossible à préparer prepared_statement() '.$e->getCode());
        }
    }


    /**
     * Summary of unprepared_statement
     * @param string $query la requête à executer sans utiliser des paramètres
     * @return PDOStatement les lignes affectées par la reqête
     * @see toString pour trasformer la valeur de retour en string pour l'afficher
     */
    public function unprepared_statement($query){

        try{
            $statement = $this->DB->query($query); 
            return $statement; 
        }
        catch(Exception $e){
            die('requête impossible à excécuter unprepared_statement '.$e->getCode()); 
        }
    }


}