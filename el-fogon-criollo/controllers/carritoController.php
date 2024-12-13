<?php

session_start();

class carritoController {
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
                    $carrito[$id]['cantidad'] = max(1, intval($cantidad)); // Asegurarse de que sea al menos 1
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
