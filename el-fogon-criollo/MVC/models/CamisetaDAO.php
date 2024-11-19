<?php

include_once("config/dataBase.php");
include_once("models/Camiseta.php");

class CamisetaDAO{

    public static function getAll(){
        $con = DataBase::connect();
        $stmt = $con->prepare("SELECT * FROM camisetas");

        $stmt->execute();
        $result = $stmt->get_result();

        $productos = [];
        while($producto = $result->fetch_object('Camiseta')){
            $productos[] = $producto;
        }

        $con->close();

        return $productos;
    }

    public static function store($producto){
        $con = DataBase::connect();
        $stmt = $con->prepare("INSERT INTO camisetas (nombre, talla, precio) VALUES (?,?,?);");

        $nombre = $producto->getNombre();
        $talla = $producto->getTalla();
        $precio = $producto->getPrecio();

        $stmt->bind_param("ssd",$nombre,$talla,$precio);

        $stmt->execute();
        $con->close();
    }

    public static function destroy($id){
        $con = DataBase::connect();
        $stmt = $con->prepare("DELETE FROM camisetas WHERE id = ?");
        $stmt->bind_param("i",$id);

        $stmt->execute();
        $con->close();
    }
}
?>