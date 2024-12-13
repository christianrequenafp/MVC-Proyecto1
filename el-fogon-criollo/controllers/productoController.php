<?php

include_once("models/Producto.php");

class productoController{

    public function index(){
        $view = "views/users/home.php";
        include_once "views/main.php";
    }

    public function joinUs(){
        $view = "views/users/company/joinUs.php";
        include_once "views/main.php";
    }

    public function logIn(){
        $view = "views/users/company/logIn.php";
        include_once "views/main.php";
    }

    public function ourCart(){
        include_once "models/Producto.php";
        $productos = Producto::getAll();
        
        $view = "views/users/products/ourCart.php";
        include_once "views/main.php";
    }

    public function aboutUs(){
        $view = "views/users/company/aboutUs.php";
        include_once "views/main.php";
    }

    public function contact(){
        $view = "views/users/company/contact.php";
        include_once "views/main.php";
    }

    public function carneArgentina(){
        $view = "views/users/history/carneArgentina.php";
        include_once "views/main.php";
    }

    public function elaboracionCarne(){
        $view = "views/users/history/elaboracionCarne.php";
        include_once "views/main.php";
    }

    public function parrillaArgentina(){
        $view = "views/users/history/parrillaArgentina.php";
        include_once "views/main.php";
    }

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
    
        include_once "models/Producto.php";
        $producto = Producto::getById($producto_id);
    
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
    
        header("Location: ?controller=producto&action=cart");
        exit();
    }

    public function productDetails(){
        include_once "models/Producto.php";

        $producto_id = $_GET["id"];

        if ($producto_id){
            $producto = Producto::getById($producto_id);
            if(!$producto){
                die("Producto no encontrado");
            }
        }else{
            die("ID de producto no especificado");
        }

        $view = "views/users/products/productDetails.php";
        include_once "views/main.php";
    }

}
?>