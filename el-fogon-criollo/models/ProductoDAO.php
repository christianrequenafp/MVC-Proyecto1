<?php

include_once "./config/dataBase.php";
include_once "models/Producto.php";

class ProductoDAO {
    private $conexion;

    public function __construct() {
        $this->conexion = dataBase::connect();
    }

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
}
