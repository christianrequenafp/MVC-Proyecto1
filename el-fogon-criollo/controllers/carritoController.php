<?php

// Inicia la sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once "models/Producto.php";
include_once "models/ProductoDAO.php";
include_once "models/PedidoDAO.php";

// Controlador para manejar el carrito de compras
class carritoController {

    // Muestra la vista del carrito
    public function cart(){
        $view = "views/users/products/cart.php";
        include_once "views/main.php";
    }

    // Función para agregae un producto al carrito
    public function addToCart() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        $producto_id = $_GET['id'];
    
        if (!$producto_id) {
            die("ID del producto no especificado.");
        }
    
        $producto = ProductoDAO::getById($producto_id); // Recupera el producto desde la base de datos
    
        if (!$producto) {
            die("Producto no encontrado.");
        }
        // Recupera el carrito actual de la sesión
        $carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];

        // Si el producto ya está en el carrito, incrementa la cantidad
        if (isset($carrito[$producto_id])) {
            $carrito[$producto_id]['cantidad'] += 1;
        } else {
            // Si el producto no está en el carrito, lo agrega con cantidad 1
            $carrito[$producto_id] = [
                'id' => $producto->getProducto_id(),
                'nombre' => $producto->getNombre(),
                'precio' => $producto->getPrecio(),
                'imagen' => "./assets/images/products/" . $producto->getImagen(),
                'cantidad' => 1,
            ];
        }
    
        $_SESSION['carrito'] = $carrito; // Actualiza el carrito en la sesión
    
        header("Location: ?controller=carrito&action=viewCart");
        exit();
    }

    // Muestra el contenido actual del carrito
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

    // Actualiza las cantidades de los productos en el carrito
    public function updateCart() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (isset($_POST['cantidades'])) {
            $carrito = $_SESSION['carrito'];
            foreach ($_POST['cantidades'] as $id => $cantidad) {
                if (isset($carrito[$id])) {
                    // Asegura que la cantidad no sea menor a 1
                    $carrito[$id]['cantidad'] = max(1, intval($cantidad));
                }
            }
            $_SESSION['carrito'] = $carrito; // Actualiza el carrito
        }
        header("Location: ?controller=carrito&action=viewCart");
        exit();
    }

    // Elimina un producto del carrito
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

    // Procesa la compra y genera un pedido
    public function checkout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        // Verifica si el usuario está autenticado y lo redirige al login si no lo està
        if (!isset($_SESSION['user_id'])) {
            header("Location: ?controller=usuario&action=logIn");
            exit();
        }
    
        $usuario_id = $_SESSION['user_id'];
        $carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];
    
        if (empty($carrito)) {
            die("El carrito está vacío. No se puede proceder al pago.");
        }
    
        $subtotal = 0;
        foreach ($carrito as $producto) {
            $subtotal += $producto['precio'] * $producto['cantidad'];
        }
        $envio = 0;
        $impuestos = 0;
        $total = $subtotal + $envio + $impuestos;
    
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
    
        // Inserta los productos del carrito en la base de datos
        foreach ($carrito as $producto) {
            $pedidoDAO->agregarProductoAlPedido($pedido_id, $producto['id'], $producto['cantidad']);
        }
    
        unset($_SESSION['carrito']);
    
        header("Location: ?controller=carrito&action=confirmation&pedidoId=" . $pedido_id);
        exit();
    }
    
    // Muestra la confirmación del pedido
    public function confirmation() {
        $pedido_id = $_GET['pedidoId'];
        $view = "views/users/products/confirmation.php";
        include_once "views/main.php";
    }
    
}
?>
