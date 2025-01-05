<?php

class dataBase{
    
    // Método para conectar a la base de datos
    public static function connect($host="127.0.0.1", $user="root", $pass="1234", $db="elfogoncriollo", $port="3307"){
        // Establece la conexión con la base de datos
        $con = new mysqli($host, $user, $pass, $db, $port);

        // Verifica si la conexión ha sido correcta
        if($con == false){
            die("ERROR: No se pudo conectar". $con->connect_error);
        }
        
        return $con;
    }
}
?>
