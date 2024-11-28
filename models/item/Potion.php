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
}