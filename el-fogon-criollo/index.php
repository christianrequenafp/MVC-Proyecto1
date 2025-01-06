<?php
// Controladores necesarios para gestionar productos, carrito y usuarios
include_once("controllers/productoController.php");
include_once("controllers/carritoController.php");
include_once("controllers/usuarioController.php");
include_once("controllers/apiController.php");

// Configuración general (URL base, acción por defecto, etc.)
include_once("config/parameters.php");

// Redirige al controlador de productos si no se especifica ninguno
if (!isset($_GET['controller'])) {
    header("Location:" . url . "?controller=producto");
} else {
    // Obtiene el nombre del controlador de la URL
    $nombre_controller = $_GET['controller'] . 'Controller';

    // Verifica si el controlador existe
    if (class_exists($nombre_controller)) {
        $controller = new $nombre_controller();

        // Verifica si la acción existe en el controlador
        if (isset($_GET['action']) && method_exists($controller, $_GET['action'])) {
            $action = $_GET['action'];
        } else {
            // Usa la acción por defecto si no se especifica una válida
            $action = default_action;
        }

        // Ejecuta la acción en el controlador
        $controller->$action();
    } else {
        // Muestra un mensaje si el controlador no existe
        echo "No existe el controlador: " . htmlspecialchars($nombre_controller);
    }
}
?>