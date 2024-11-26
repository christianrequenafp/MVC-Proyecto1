<?php

abstract class Producto{
    protected $producto_id;
    protected $nombre;
    protected $tipo;
    protected $precio;
    protected $imagen;

    public function __construct($producto_id, $nombre, $tipo, $precio, $imagen){
        $this->producto_id = $producto_id;
        $this->nombre = $nombre;
        $this->tipo = $tipo;
        $this->precio = $precio;
        $this->imagen = $imagen;
    }

    public function getProducto_id(){
        return $this->producto_id;
    }
    
    public function setProducto_id($producto_id){
        $this->producto_id = $producto_id;

        return $this;
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

    public function getImagen(){
        return $this->imagen;
    }

    public function setImagen($imagen){
        $this->imagen = $imagen;

        return $this;
    }
}

?>