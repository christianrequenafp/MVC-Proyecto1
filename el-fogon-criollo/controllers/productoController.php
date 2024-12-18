<?php

include_once("models/Producto.php");
include_once("models/ProductoDAO.php");

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
        $productos = ProductoDAO::getAll();
        
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

    public function productDetails(){
        include_once "models/Producto.php";

        $producto_id = $_GET["id"];

        if ($producto_id){
            $producto = ProductoDAO::getById($producto_id);
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