<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once "models/Producto.php";
include_once "models/ProductoDAO.php";
include_once "models/PedidoDAO.php";


class carritoController {

    public function cart(){
        $view = "views/users/products/cart.php";
        include_once "views/main.php";
    }

    public function addToCart() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        $producto_id = $_GET['id'];
    
        if (!$producto_id) {
            die("ID del producto no especificado.");
        }
    
       
        $producto = ProductoDAO::getById($producto_id);
    
        if (!$producto) {
            die("Producto no encontrado.");
        }
    
        $carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];

        if (isset($carrito[$producto_id])) {
            $carrito[$producto_id]['cantidad'] += 1;
        } else {
            $carrito[$producto_id] = [
                'id' => $producto->getProducto_id(),
                'nombre' => $producto->getNombre(),
                'precio' => $producto->getPrecio(),
                'imagen' => "./assets/images/products/" . $producto->getImagen(),
                'cantidad' => 1,
            ];
        }
    
        $_SESSION['carrito'] = $carrito;
    
        header("Location: ?controller=carrito&action=viewCart");
        exit();
    }

    public function viewCart() {
        $carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];
        
        $subtotal = 0;
        foreach ($carrito as $producto) {
            $subtotal += $producto['precio'] * $producto['cantidad'];
        }
        $envio = 0; 
        $impuestos = 0;
        $total = $subtotal + $envio + $impuestos;

        $view = "views/users/products/cart.php";
        include_once "views/main.php";
    }

    public function updateCart() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_POST['cantidades'])) {
            $carrito = $_SESSION['carrito'];
            foreach ($_POST['cantidades'] as $id => $cantidad) {
                if (isset($carrito[$id])) {
                    $carrito[$id]['cantidad'] = max(1, intval($cantidad));
                }
            }
            $_SESSION['carrito'] = $carrito;
        }
        header("Location: ?controller=carrito&action=viewCart");
        exit();
    }

    public function removeFromCart() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $id = $_GET['id'];
        if ($id && isset($_SESSION['carrito'][$id])) {
            unset($_SESSION['carrito'][$id]);
        }
        header("Location: ?controller=carrito&action=viewCart");
        exit();
    }

    public function checkout() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        // Verificar si el usuario está autenticado
        if (!isset($_SESSION['user_id'])) {
            header("Location: ?controller=usuario&action=logIn");
            exit();
        }
    
        $usuario_id = $_SESSION['user_id'];
        $carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];
    
        if (empty($carrito)) {
            die("El carrito está vacío. No se puede proceder al pago.");
        }
    
        // Calcular el total
        $subtotal = 0;
        foreach ($carrito as $producto) {
            $subtotal += $producto['precio'] * $producto['cantidad'];
        }
        $envio = 0; 
        $impuestos = 0;
        $total = $subtotal + $envio + $impuestos;
    
        // Crear un nuevo pedido
        $pedidoDAO = new PedidoDAO();
        $pedido_id = $pedidoDAO->crearPedido([
            'usuario_id' => $usuario_id,
            'total' => $total,
            'metodo_pago' => 'tarjeta',
            'cupon_id' => null,
        ]);
    
        if (!$pedido_id) {
            die("Error al crear el pedido.");
        }
    
        // Insertar los productos del carrito en la tabla de pedidos
        foreach ($carrito as $producto) {
            $pedidoDAO->agregarProductoAlPedido($pedido_id, $producto['id'], $producto['cantidad']);
        }
    
        // Vaciar el carrito
        unset($_SESSION['carrito']);
    
        // Redirigir a la página de confirmación
        header("Location: ?controller=carrito&action=confirmation&pedidoId=" . $pedido_id);
        exit();
    }
    
    
    public function confirmation() {
        $pedido_id = $_GET['pedidoId'];
        $view = "views/users/products/confirmation.php";
        include_once "views/main.php";
    }
    
}
?>
