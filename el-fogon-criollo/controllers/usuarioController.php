<?php
include_once("models/Usuario.php");
include_once("models/UsuarioDAO.php");

class UsuarioController {
    
    public function login(){
        $view = "views/users/company/logIn.php";
        include_once("views/main.php");
    }

    public function doLogin(){
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $email = $_POST["email"];
            $password = $_POST["password"];

            if($email && $password){
                $usuarioDAO = new UsuarioDAO();
                $userData = $usuarioDAO->findByEmail($email);

                if($userData && password_verify($password, $userData["contrasena"])){
                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }
                    $_SESSION["user"] = $userData["nombre"];
                    $_SESSION["user_id"] = $userData["usuario_id"];
                    echo "Inicio de sesión completado con exito";
                    header("Location: ?controller=producto&action=index");
                }else{
                    echo "Credenciales incorrectas";
                    // header("Location: ?controller=usuario&action=login&error=1");
                }
            }else{
                echo "Todos los campos son obligatorios";
            }
        }
    }

    public function saveUser(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $nombre = $_POST["nombre"];
            $email = $_POST["email"];
            $password = $_POST["password"];

            if($nombre && $email && $password){
                $usuario = new Usuario();
                $usuario->setNombre($nombre);
                $usuario->setEmail($email);
                $usuario->setPassword(password_hash($password,PASSWORD_BCRYPT));

                $usuarioDAO = new UsuarioDAO();
                $resultado = $usuarioDAO->save($usuario);

                if($resultado){
                    echo "Usuario registrado correctamente";
                    header("Location: ?controller=producto&action=logIn");
                }else{
                    echo "Error: El correo ya existe.";
                }
            }else{
                echo "Todos los campos son obligatorios.";
            }
        }
    }

    public function logout(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
        $view = "views/users/company/logIn.php";
        include_once("views/main.php");
        exit;
    }    
   
}
