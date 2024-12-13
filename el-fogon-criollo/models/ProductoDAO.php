<?php

include_once "./config/dataBase.php";
include_once "models/Producto.php";

class ProductoDAO {
    private $conexion;

    public function __construct() {
        $this->conexion = dataBase::connect();
    }

    public function obtenerProductos() {
        $sql = "SELECT * FROM productos";
        $result = $this->conexion->query($sql);

        $productos = [];
        while ($fila = $result->fetch_assoc()) {
            $productos[] = $fila;
        }

        return $productos;
    }

    public function obtenerProductoPorId($id) {
        $sql = "SELECT * FROM productos WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $resultado = $stmt->get_result();

        return $resultado->fetch_assoc();
    }
}
