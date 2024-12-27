<?php
class HistoireController {
    
    //regarder si l'utilisateur et connnectée
    public function index() {
        session_start(); 

        //si on n'est pas connecté
        if(!isset($_SESSION["connected"]) || !($_SESSION["connected"] === true)){ 
            header("Location: /dx_11/connexion");
        }//si on n'est pas connecté

        //Si ce n'est pas un compte admin
        if(!isset($_SESSION["adminAccount"]) ||!$_SESSION["adminAccount"]){
            header("Location: /dx_11/");
        }//si on n'est pas connecté

        //Si on est connecté et qu'on a un compte admin
        else{
            //On affiche la page de modification
            require_once 'views/histoire.php';
        }//Si on est connecté et qu'on a un compte admin
        
    }

    public function deleteAccount(){
        session_start(); 

        //si on n'est pas connecté
        if(!isset($_SESSION["connected"]) || !($_SESSION["connected"] === true)){ 
            header("Location: /dx_11/connexion");
        }//si on n'est pas connecté

        //Si ce n'est pas un compte admin
        if(!isset($_SESSION["adminAccount"]) ||!$_SESSION["adminAccount"]){
            header("Location: /dx_11/");
        }//si on n'est pas connecté

        //Si aucun compte n'est selectionné
        if(!isset($_POST["account"])){
            header("Location: /dx_11/modificationHistoire");
        }//si on n'est pas connecté

        else{
            DataBase::deleteAccount2($_POST["account"]); 
            header("Location: /dx_11/modificationHistoire"); 
        }
    }



    public function printAccounts(){
        $accounts = DataBase::getAccounts(); 
        
        foreach($accounts as $lineNum => $line){ 
            $userMail = $line["user_mail"]; 
            if(strtolower($userMail) !== strtolower($_SESSION["userMail"])){
                echo "  <option value = '$userMail'>
                            ".$userMail."
                        </option>"; 
            }
        }
    }

    public function printChapters(){
        $chapters = DataBase::getChapters(); 
        
        foreach($chapters as $lineNum => $line){ 
            $chapNum = $line["chapter_num"]; 
            echo "  <p>
                        chapitre numéro : ".($line["chapter_num"])."<br>
                    </p>"; 
        }
    }

}
?>