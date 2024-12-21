<?php
class Potion extends Item{
    protected $value;
    protected $type;

    public function __construct($value, $type   ,$weigt, $name, $desc, $size)
    {
        $this->value = $value;
        $this->type = $type;
        parent::__construct($weigt, $name, $desc, $size);
    }

    //retourne le bonnus de la potion
    public function getValue(){
        return $value;
    }

    //retourne le type de potion
    public function getType(){
        return $type;
    }
}
?>