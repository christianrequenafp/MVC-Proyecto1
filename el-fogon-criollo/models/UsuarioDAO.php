<?php

include_once "./config/dataBase.php";

class UsuarioDAO {
    
    private $db;

    public function __construct() {
        $this->db = dataBase::connect();
    }

    public function save(Usuario $usuario){
        $query = $this->db->prepare("INSERT INTO usuario (nombre, email, contrasena, rol) VALUES (?, ?, ?, ?)");
        $query->bind_param(
            "ssss",
            $usuario->getNombre(),
            $usuario->getEmail(),
            $usuario->getPassword(),
            $usuario->getRol()
        );

        return $query->execute();
    }

    public function findByEmail($email){
        $query = $this->db->prepare("SELECT * FROM usuario WHERE email = ?");
        $query->bind_param("s", $email);
        $query->execute();
        $return = $query->get_result()->fetch_assoc();
    }
}
