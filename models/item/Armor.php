<?php
class Armor extends Item{
    protected $defense_value;

    public function __construct($defense_value,$weigt, $name, $desc, $size)
    {
        $this->defense_value = $defense_value;
        parent::__construct($weigt, $name, $desc, $size);
    }
}