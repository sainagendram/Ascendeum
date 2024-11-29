<?php 

class Board{

    private $size;
    private $snakeLadders = [];

    public function __construct($size,$snakeLadders)
    {
        $this->size = $size;
        $this->snakeLadders = $snakeLadders;
    }

    public function getSize(){
        return $this->size;
    }

    public function snakeLaddersPosition($position){
        return $this->snakeLadders[$position] ?? $position;
    }

}
