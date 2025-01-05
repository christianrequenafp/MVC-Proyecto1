<?php

include_once "./config/dataBase.php";

class PedidoDAO {
    private $conexion;

    // Establece la conexión con la base de datos
    public function __construct() {
        $this->conexion = dataBase::connect();
    }

    // Método para crear un nuevo pedido
    public function createOrder($datosPedido) {
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
    
        return $this->conexion->insert_id;
    }
    
    // Método para obtener los productos asociados a un pedido
    public function getProductsPerOrder($pedido_id) {
        $sql = "SELECT pp.producto_id, p.nombre, p.precio, pp.cantidad 
                FROM PEDIDO_PRODUCTO pp
                JOIN PRODUCTO p ON pp.producto_id = p.producto_id
                WHERE pp.pedido_id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param('i', $pedido_id);
        $stmt->execute();
        
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }    

    // Método para obtener el último pedido de un único usuario
    public function getLastOrder($usuario_id) {
        $sql = "SELECT * FROM PEDIDO WHERE usuario_id = ? ORDER BY fecha DESC LIMIT 1";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param('i', $usuario_id);
        $stmt->execute();
        
        return $stmt->get_result()->fetch_assoc();
    }

    // Método para obtener todos los pedidos
    public function getOrders() {
        $sql = "SELECT * FROM PEDIDO";
        $result = $this->conexion->query($sql);

        $pedidos = [];
        
        // Se procesan los resultados de la consulta y se almacenan en el array $pedidos
        while ($fila = $result->fetch_assoc()) {
            $pedidos[] = $fila;
        }

        return $pedidos;
    }

    // Método para agregar un producto a un pedido
    public function addProductToOrder($pedidoId, $productoId, $cantidad) {
        $sql = "INSERT INTO PEDIDO_PRODUCTO (pedido_id, producto_id, cantidad) VALUES (?, ?, ?)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param('iii', $pedidoId, $productoId, $cantidad);
        $stmt->execute();
    }
}