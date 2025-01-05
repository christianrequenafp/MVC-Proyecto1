<?php
include_once("models/Usuario.php");
include_once("models/UsuarioDAO.php");
include_once("models/PedidoDAO.php");

class UsuarioController {
    
    // Muestra la vista de login
    public function login(){
        $view = "views/users/company/logIn.php";
        include_once("views/main.php");
    }

    // Función para procesar el login del usuario
    public function doLogin(){
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $email = $_POST["email"];
            $password = $_POST["password"];
            // Verifica si los campos no están vacíos
            if($email && $password){
                $usuarioDAO = new UsuarioDAO();
                $userData = $usuarioDAO->findByEmail($email);

                // Verifica si el usuario existe y si la contraseña es correcta
                if($userData && password_verify($password, $userData["contrasena"])){
                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }
                    // Almacena los datos del usuario en la sesión
                    $_SESSION["user"] = $userData["nombre"];
                    $_SESSION["user_id"] = $userData["usuario_id"];
                    
                    $pedidoDAO = new PedidoDAO();
                    $ultimoPedido = $pedidoDAO->obtenerUltimoPedido($userData["usuario_id"]);

                    // Si existe un último pedido, recupera los productos de ese pedido
                    if ($ultimoPedido) {
                        $productosPedido = $pedidoDAO->obtenerProductosPorPedido($ultimoPedido["pedido_id"]);
                        $_SESSION["carrito"] = [];

                        // Rellena el carrito con los productos del último pedido
                        foreach ($productosPedido as $producto) {
                            $_SESSION["carrito"][$producto["producto_id"]] = [
                                "id" => $producto["producto_id"],
                                "nombre" => $producto["nombre"],
                                "precio" => $producto["precio"],
                                "cantidad" => $producto["cantidad"],
                            ];
                        }
                    } else {
                        // Si no hay pedidos previos, inicia el carrito vacío
                        $_SESSION["carrito"] = [];
                    }

                    header("Location: ?controller=producto&action=index");
                    exit();
                } else {
                    echo "Credenciales incorrectas";
                }
            } else {
                echo "Todos los campos son obligatorios";
            }
        }
    }

    // Función para registrar un nuevo usuario
    public function saveUser(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $nombre = $_POST["nombre"];
            $email = $_POST["email"];
            $password = $_POST["password"];

            // Verifica si todos los campos están completos
            if($nombre && $email && $password){
                $usuario = new Usuario();
                $usuario->setNombre($nombre);
                $usuario->setEmail($email);
                $usuario->setPassword(password_hash($password, PASSWORD_BCRYPT)); // Encripta la contraseña

                $usuarioDAO = new UsuarioDAO();
                $resultado = $usuarioDAO->save($usuario);

                // Verifica si el usuario se guardó correctamente
                if($resultado){
                    echo "Usuario registrado correctamente";
                    header("Location: ?controller=producto&action=logIn");
                } else {
                    echo "Error: El correo ya existe.";
                }
            } else {
                echo "Todos los campos son obligatorios.";
            }
        }
    }

    // Función que cierra la sesión y elimina el carrito y el último pedido de la sesión
    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        unset($_SESSION["carrito"]);
        unset($_SESSION["ultimo_pedido"]);
        session_destroy();

        $view = "views/users/company/logIn.php";
        include_once("views/main.php");
        exit();
    }
}
