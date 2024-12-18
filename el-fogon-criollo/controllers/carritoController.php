<?php

session_start();

include_once "models/Producto.php";
include_once "models/ProductoDAO.php";

class carritoController {

    public function cart(){
        $view = "views/users/products/cart.php";
        include_once "views/main.php";
    }

    public function addToCart() {
        session_start();
    
        $producto_id = $_GET['id'];
    
        if (!$producto_id) {
            die("ID del producto no especificado.");
        }
    
       
        $producto = ProductoDAO::getById($producto_id);
        var_dump($producto);
    
        if (!$producto) {
            die("Producto no encontrado.");
        }
    
        $carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];
        var_dump($carrito);

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
        session_start();
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
        session_start();
        $id = $_GET['id'];
        if ($id && isset($_SESSION['carrito'][$id])) {
            unset($_SESSION['carrito'][$id]);
        }
        header("Location: ?controller=carrito&action=viewCart");
        exit();
    }
}
?>
