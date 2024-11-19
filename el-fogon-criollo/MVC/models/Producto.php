<?php

abstract class Producto{
    const TYPE_CAMISETA = 1;
    const TYPE_PANTALONES = 2;

    protected $id;
    protected $nombre;
    protected $talla;
    protected $precio;

    public function __construct($nombre, $talla, $precio){
        $this->nombre = $nombre;
        $this->talla = $talla;
        $this->precio = $precio;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;

        return $this;
    }

    public function getTalla(){
        return $this->talla;
    }

    public function setTalla($talla){
        $this->talla = $talla;

        return $this;
    }
 
    public function getPrecio(){
        return $this->precio;
    }

    public function setPrecio($precio){
        $this->precio = $precio;

        return $this;
    }

    public function getId(){
        return $this->id;
    }
}

?>