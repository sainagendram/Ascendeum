<?php 

class Players{

    private $name;
    private $position;

    public function __construct($name)
    {
        $this->name = $name;
        $this->position = 0;
    }

    public function getName()
    {
        return $this->name;
    }

    public function move($steps)
    {
        $this->position +=$steps;
    }

    public function getPosition()
    {
        return $this->position;
    }
    

}
