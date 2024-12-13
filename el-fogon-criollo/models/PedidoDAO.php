<?php

include_once "./config/dataBase.php";

class PedidoDAO {
    private $conexion;

    public function __construct() {
        $this->conexion = dataBase::connect();
    }

    public function crearPedido($datosPedido) {
        $sql = "INSERT INTO pedidos (fecha, total, estado) VALUES (NOW(), ?, 'pendiente')";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param('d', $datosPedido['total']);
        $stmt->execute();

        return $this->conexion->insert_id;
    }

    public function agregarProductoAlPedido($pedidoId, $productoId, $cantidad) {
        $sql = "INSERT INTO pedido_producto (pedido_id, producto_id, cantidad) VALUES (?, ?, ?)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param('iii', $pedidoId, $productoId, $cantidad);
        $stmt->execute();
    }

    public function obtenerPedidos() {
        $sql = "SELECT * FROM pedidos";
        $result = $this->conexion->query($sql);

        $pedidos = [];
        while ($fila = $result->fetch_assoc()) {
            $pedidos[] = $fila;
        }

        return $pedidos;
    }
}
