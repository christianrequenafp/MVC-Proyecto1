<?php

require_once 'models/UsuarioDAO.php';

class UsuarioController {
    private $usuarioDAO;

    public function __construct() {
        $this->usuarioDAO = new UsuarioDAO();
    }

    public function registrar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            if ($this->usuarioDAO->registrarUsuario($nombre, $email, $password)) {
                header('Location: index.php?action=login&success=1');
            } else {
                header('Location: index.php?action=register&error=1');
            }
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $usuario = $this->usuarioDAO->autenticarUsuario($email, $password);
            if ($usuario) {
                session_start();
                $_SESSION['usuario'] = $usuario;
                header('Location: index.php?action=home');
            } else {
                header('Location: index.php?action=login&error=1');
            }
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: index.php');
    }
}
