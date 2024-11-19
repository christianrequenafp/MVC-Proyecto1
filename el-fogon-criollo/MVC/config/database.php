<?php

class dataBase{
    public static function connect($host="localhost", $user="root", $pass="", $db="productos"){
        $con = new mysqli($host, $user, $pass, $db);

        if($con == false){
            die("ERROR: No se pudo conectar". $con->connect_error);
        }
        
        return $con;
    }
}

?>