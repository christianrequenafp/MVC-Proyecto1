<?php

include_once "./config/dataBase.php";

class UsuarioDAO {
    private $conexion;

    public function __construct() {
        $this->conexion = dataBase::connect();
    }

    public function registrarUsuario($nombre, $email, $password) {
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param('sss', $nombre, $email, $passwordHash);
        return $stmt->execute();
    }

    public function autenticarUsuario($email, $password) {
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $usuario = $resultado->fetch_assoc();

        if ($usuario && password_verify($password, $usuario['password'])) {
            return $usuario;
        }

        return false;
    }
}
