<?php
class Chapitre {
    protected $image;
    protected $text;
    protected $id;

    public function __construct($image, $text, $id)
    {
        $this->image = $image;
        $this->text = $text;
        $this->id = $id;
    }

    //recupére url de l'image
    public function getImage(){
        return $image;
    }

    //recupére le texte du chapitre 
    public function getText(){
        return $text;
    }

    //recupére le numero du chapitre 
    public function getId(){
        return $id;
    }
    

    
}
?>