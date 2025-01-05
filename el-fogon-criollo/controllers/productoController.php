<?php

include_once("models/Producto.php");
include_once("models/ProductoDAO.php");

class productoController{

    // Muestra la página principal del sitio
    public function index(){
        $view = "views/users/home.php";
        include_once "views/main.php";
    }

    // Muestra la página para unirse al restaurante
    public function joinUs(){
        $view = "views/users/company/joinUs.php";
        include_once "views/main.php";
    }

    // Muestra la página de login
    public function logIn(){
        $view = "views/users/company/logIn.php";
        include_once "views/main.php";
    }

    // Muestra la página con todos los productos del carrito
    public function ourCart(){
        include_once "models/Producto.php";
        $productos = ProductoDAO::getAll();

        $view = "views/users/products/ourCart.php";
        include_once "views/main.php";
    }

    // Muestra la página "sobre nosotros"
    public function aboutUs(){
        $view = "views/users/company/aboutUs.php";
        include_once "views/main.php";
    }

    // Muestra la página de "contacto"
    public function contact(){
        $view = "views/users/company/contact.php";
        include_once "views/main.php";
    }

    // Muestra la página de "la historia de la carne argentina"
    public function carneArgentina(){
        $view = "views/users/history/carneArgentina.php";
        include_once "views/main.php";
    }

    // Muestra la página de la "elaboración de la carne"
    public function elaboracionCarne(){
        $view = "views/users/history/elaboracionCarne.php";
        include_once "views/main.php";
    }

    // Muestra la página de la "parrilla argentina"
    public function parrillaArgentina(){
        $view = "views/users/history/parrillaArgentina.php";
        include_once "views/main.php";
    }

    // Muestra los detalles de un producto específico
    public function productDetails(){
        include_once "models/Producto.php";

        $producto_id = $_GET["id"];

        // Verifica si el ID del producto es válido
        if ($producto_id){
            $producto = ProductoDAO::getById($producto_id); // Obtiene el producto desde la base de datos
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