<?php



class Coche {

    public $id;
    public $marca;
    public $color;

    public function __construct(){
        $this->id = "00";
        $this->marca = "RESET MARCA";
        $this->color = "rojo";
    }
    
    public function getColor(){
        return $this->color;
    }
}


