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

    

    
}