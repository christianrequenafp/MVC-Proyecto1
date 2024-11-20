<?php

include_once("models/Producto.php");

class productoController{

    public function index(){
        $view = "views/users/home.php";
        include_once "views/main.php";
    }

}

?>