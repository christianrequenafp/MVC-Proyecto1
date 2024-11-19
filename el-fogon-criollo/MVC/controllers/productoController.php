<?php

include_once("models/CamisetaDAO.php");
include_once("models/Producto.php");

class productoController{

    public function index(){
        $productos = CamisetaDAO::getAll();
        $view = "views/productos/listado.php";
        include_once "views/main.php";
    }

    public function create(){
        $view = "views/productos/create.php";
        include_once "views/main.php";
    }

    public function store(){
        $nombre = $_POST["nombre"];
        $talla = $_POST["talla"];
        $precio = $_POST["precio"];

        $producto = new Camiseta();
        $producto->setNombre($nombre);
        $producto->setTalla($talla);
        $producto->setPrecio($precio);

        CamisetaDAO::store($producto);
        header('Location:?controller=producto');
    }

    public function destroy(){
        CamisetaDAO::destroy($_GET["id"]);
        header('Location:?controller=producto');
    }

    public function show(){
        $view = "views/productos/show.php";
        include_once "views/main.php";
    }

}

?>