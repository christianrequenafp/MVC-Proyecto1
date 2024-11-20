<?php

abstract class Producto{
    protected $id;
    protected $nombre;
    protected $tipo;
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
 
    public function getTipo(){
        return $this->tipo;
    }

    public function setTipo($tipo){
        $this->tipo = $tipo;

        return $this;
    }

    public function getPrecio(){
        return $this->precio;
    }

    public function setPrecio($precio){
        $this->precio = $precio;

        return $this;
    }
}

?>