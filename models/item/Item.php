<?php
class Item {
    protected $weigt;
    protected $name;
    protected $desc;
    protected $size;

    public function __construct($weigt, $name, $desc, $size)

    {
        $this->weigt = $weigt;
        $this->name = $name;
        $this->desc = $desc;
        $this->size = $size;
    }

    
}
?>