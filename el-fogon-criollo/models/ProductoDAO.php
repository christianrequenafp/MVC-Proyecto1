<?php

include_once "./config/dataBase.php";
include_once "models/Producto.php";

class ProductoDAO {
    private $conexion;

    // Establecer la conexión con la base de datos
    public function __construct() {
        $this->conexion = dataBase::connect();
    }

    // Método para obtener todos los productos desde la base de datos
    public static function getAll(){
        // Establecer la conexión a la base de datos
        $conn = dataBase::connect();

        // Consulta SQL para obtener los productos
        $query = "SELECT producto_id, nombre, descripcion, tipo, precio, imagen FROM PRODUCTO";
        $result = $conn->query($query);

        $productos = [];
        
        // Si la consulta devuelve resultados, se procesan
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

    // Método para obtener un producto por su ID
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