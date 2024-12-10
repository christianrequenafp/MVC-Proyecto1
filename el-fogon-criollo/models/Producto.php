<?php

include_once "./config/dataBase.php";

class Producto{
    protected $producto_id;
    protected $nombre;
    protected $descripcion;
    protected $tipo;
    protected $precio;
    protected $imagen;

    public static function getAll(){
        $conn = dataBase::connect();
        $query = "SELECT producto_id, nombre, descripcion, tipo, precio, imagen FROM PRODUCTO";
        $result = $conn->query($query);

        $productos = [];
        
        if ($result && $result->num_rows > 0){
            while ($row = $result->fetch_assoc()){

                $producto = new Producto();

                $producto->setProducto_id($row['producto_id']);
                $producto->setNombre($row['nombre']);
                $producto->setDescripcion($row['descripcion']);
                $producto->setTipo($row['tipo']);
                $producto->setPrecio($row['precio']);
                $producto->setImagen($row['imagen']);

                $productos[] = $producto;
            }
        }

        $conn->close();
        return $productos;
    }

    public static function getById($id) {
        $db = dataBase::connect();
        $query = $db->prepare("SELECT * FROM PRODUCTO WHERE producto_id = ?");
        $query->bind_param("i", $id);
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows > 0) {
            $producto_data = $result->fetch_assoc();

            $producto = new Producto();

            $producto->setProducto_id($producto_data['producto_id']);
            $producto->setNombre($producto_data['nombre']);
            $producto->setDescripcion($producto_data['descripcion']);
            $producto->setTipo($producto_data['tipo']);
            $producto->setPrecio($producto_data['precio']);
            $producto->setImagen($producto_data['imagen']);
            
            return $producto;
        }
        return null;
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

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }
}

?>