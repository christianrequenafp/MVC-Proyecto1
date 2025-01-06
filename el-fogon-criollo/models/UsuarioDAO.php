<?php

include_once "./config/dataBase.php";

class UsuarioDAO {
    private $db;
    // Establece la conexión a la base de datos
    public function __construct() {
        $this->db = dataBase::connect();
    }

    // Método para guardar un usuario en la base de datos
    public function save(Usuario $usuario){
        $query = $this->db->prepare("INSERT INTO USUARIO (nombre, email, contrasena, rol) VALUES (?, ?, ?, ?)");
        $query->bind_param(
            "ssss",
            $usuario->getNombre(),
            $usuario->getEmail(),
            $usuario->getPassword(),
            $usuario->getRol()
        );
        return $query->execute();
    }

    // Método para buscar un usuario por su correo
    public function findByEmail($email){
        $query = $this->db->prepare("SELECT * FROM USUARIO WHERE email = ?");
        $query->bind_param("s", $email);
        $query->execute();
        $result = $query->get_result();
        return $result->fetch_assoc();
    }

    // Método para obtener todos los usuarios
    public function getAllUsers() {
        $query = $this->db->prepare("SELECT * FROM USUARIO");
        $query->execute();
        $result = $query->get_result();
        
        $usuarios = [];
        while ($row = $result->fetch_assoc()) {
            $usuarios[] = $row;
        }
        return $usuarios;
    }
}
