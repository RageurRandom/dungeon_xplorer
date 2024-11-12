<?php 


    $DB_adresse = 'mysql:host=mysql.info.unicaen.fr;port3306;dbname=remo231_dev;charset=utf8'; 
    $user = 'remo231'; 
    $password = 'iewoh5RooghohFa4'; 

    $DB = DB_connexion($DB_adresse, $user, $password); 

    function DB_connexion($DB_adresse, $user, $password){
        try{
            $DB = new PDO($DB_adresse, $user, $password);
        } 
        catch(PDOException $e){
            die('erreur de connexion :'.$e->getCode());
        }
        return $DB; 
    }

    function prepared_statement($BD, $query){

        try{
            $statement = $BD->prepare($query);
            $nbLines = $BD->exec($statement);
        }
        catch(PDOException $e){
            die('requête impossible à excécuter'.$e->getCode());
        } 

        return $nbLines; 
    }

    function unprepared_statement($BD, $query){

        try{
            $BD->query($query); 
        }
        catch(PDOException $e){
            die('requête impossible à excécuter'.$e->getCode());
        }
    }



?>
