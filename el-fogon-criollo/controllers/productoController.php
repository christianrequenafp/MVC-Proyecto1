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

    public function bestSeller(){
        $view = "views/users/products/bestSeller.php";
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

    public function cart(){
        $view = "views/users/company/cart.php";
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

}
?>