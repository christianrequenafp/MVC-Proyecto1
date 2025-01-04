<?php

include_once "./config/dataBase.php";

class PedidoDAO {
    private $conexion;

    public function __construct() {
        $this->conexion = dataBase::connect();
    }

    public function crearPedido($datosPedido) {
        $sql = "INSERT INTO PEDIDO (usuario_id, fecha, total, estado, metodo_pago, cupon_id) 
                VALUES (?, NOW(), ?, 'Procesado', ?, ?)";
        $stmt = $this->conexion->prepare($sql);
    
        $stmt->bind_param('idss', 
            $datosPedido['usuario_id'], 
            $datosPedido['total'], 
            $datosPedido['metodo_pago'], 
            $datosPedido['cupon_id']
        );
        $stmt->execute();
    
        return $this->conexion->insert_id; // Devuelve el ID del pedido creado
    }
    
    

    public function agregarProductoAlPedido($pedidoId, $productoId, $cantidad) {
        $sql = "INSERT INTO PEDIDO_PRODUCTO (pedido_id, producto_id, cantidad) VALUES (?, ?, ?)";
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
