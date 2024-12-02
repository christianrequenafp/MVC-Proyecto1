<?php

class dataBase{
    public static function connect($host="127.0.0.1", $user="root", $pass="Qweasd!23", $db="elfogoncriollo", $port="3307"){
        $con = new mysqli($host, $user, $pass, $db, $port);

        if($con == false){
            die("ERROR: No se pudo conectar". $con->connect_error);
        }
        
        return $con;
    }
}
?>