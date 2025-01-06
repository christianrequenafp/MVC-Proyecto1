<?php
// Mostrar errores en el servidor
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

ob_start(); // Captura cualquier salida accidental

include_once "./controllers/logController.php";
include_once "./config/dataBase.php"; // Incluir configuración de base de datos
include_once "./models/UsuarioDAO.php";
include_once "./models/ProductoDAO.php";
include_once "./models/PedidoDAO.php";

class apiController {
    private $conn;
    private $logController;

    public function index(){
        $view = "./views/admin/homeAdmin.php";
        include_once "./views/main.php";
    }

    // Constructor para inicializar la conexión a la base de datos
    public function __construct() {
        $this->conn = DataBase::connect();
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        // Instanciamos el logController
        $this->logController = new LogController($this->conn);
    }

    // Cerrar conexión al final de cada acción
    private function closeConnection() {
        $this->conn->close();
    }

    // Función para obtener los pedidos
    public function obtenerPedidos($orderBy = null, $orderDirection = 'ASC', $excludeUnregistered = false) {
        $orderClause = "";
        if ($orderBy) {
            $orderClause = " ORDER BY " . $orderBy . " " . $orderDirection;
        }
    
        $whereClause = "";
        if ($excludeUnregistered) {
            $whereClause = " WHERE PEDIDO.usuario_id IS NOT NULL";
        }
    
        $sql = "SELECT pedidos.pedido_id, 
                       IFNULL(usuarios.nombre, 'Este pedido fue realizado por un usuario sin registrar') AS usuario, 
                       pedidos.fecha, 
                       pedidos.total,
                       pedidos.estado,
                       pedidos.metodo_pago
                FROM PEDIDO AS pedidos 
                LEFT JOIN USUARIO AS usuarios ON pedidos.usuario_id = usuarios.usuario_id" . $whereClause . $orderClause;
    
        $result = $this->conn->query($sql);
    
        // Verificar si la consulta se ejecutó correctamente
        if ($result === false) {
            http_response_code(500); // Error interno del servidor
            echo json_encode(['error' => 'Error al ejecutar la consulta']);
            exit();
        }
    
        $pedidos = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $pedidos[] = $row;
            }
        }
    
        header('Content-Type: application/json');
        echo json_encode($pedidos);
    
        $this->closeConnection();
    }      

    //Función para eliminar pedidos
    public function eliminarPedido($pedido_id) {
        // Eliminar los productos asociados al pedido
        $sql = "DELETE FROM PEDIDO_PRODUCTO WHERE pedido_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $pedido_id);
        $stmt->execute();
        $stmt->close();
    
        // Eliminar el pedido
        $sql = "DELETE FROM PEDIDO WHERE pedido_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $pedido_id);
        $stmt->execute();
    
        $response = ($stmt->affected_rows > 0) 
            ? ['status' => 'success', 'message' => 'Pedido eliminado correctamente.'] 
            : ['status' => 'error', 'message' => 'No se pudo eliminar el pedido.'];
    
        $stmt->close();
        $this->closeConnection();
    
        header('Content-Type: application/json');
        echo json_encode($response);
    
        // logController::writeLog("Pedido eliminado: ID $pedido_id");
    }

    //Función para obtener productos
    public function obtenerProductos() {
        $productos = [];
    
        $sql = "SELECT producto_id, nombre, descripcion, tipo, precio FROM PRODUCTO";
        $result = $this->conn->query($sql);
        
        while ($row = $result->fetch_assoc()) {
            $productos[] = $row;
        }
    
        // Filtrar por tipo si se pasa en el GET
        if (isset($_GET['tipo'])) {
            $tipo = $_GET['tipo'];
            $productos = array_filter($productos, function($producto) use ($tipo) {
                return $producto['tipo'] === $tipo;
            });
        }
    
        header('Content-Type: application/json');
        echo json_encode(array_values($productos));

        // logController::writeLog("Se han obtenido todos los productos");
    
        $this->closeConnection();
    }
    
    // Función para obtener los usuarios
    public function obtenerUsuarios() {
        $sql = "SELECT usuario_id, nombre, email, rol FROM USUARIO";
        $result = $this->conn->query($sql);

        // Verificar si la consulta se ejecutó correctamente
        if ($result === false) {
            http_response_code(500); // Error interno del servidor
            echo json_encode(['error' => 'Error al ejecutar la consulta']);
            exit();
        }

        $usuarios = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $usuarios[] = $row; // Almacenar cada usuario en el array $usuarios
            }
        }

        // Enviar la respuesta en formato JSON
        header('Content-Type: application/json');
        echo json_encode($usuarios);

        // Cerrar la conexión
        $this->closeConnection();
    }

    // Función para crear usuarios
    public function crearUsuario() {
        header('Content-Type: application/json');
        // Obtener los datos de la solicitud POST (se espera JSON)
        $input = json_decode(file_get_contents('php://input'), true);
    
        // Verificar que los datos necesarios estén presentes
        if (isset($input['nombre'], $input['email'], $input['contrasena'])) {
            // Validar el email (debería ser único)
            $email = $input['email'];
    
            // Verificar si el correo electrónico ya está registrado
            $sql = "SELECT * FROM USUARIO WHERE email = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                $response = ['status' => 'error', 'message' => 'El correo electrónico ya está registrado.'];
                header('Content-Type: application/json');
                echo json_encode($response);
                return;
            }
    
            // Si el email no existe, crear el usuario
            $usuario = new Usuario(
                null,  // No es necesario enviar el ID porque se auto incrementa
                $input['nombre'],
                $email,
                password_hash($input['contrasena'], PASSWORD_BCRYPT),  // Encriptar la contraseña
                "usuario"
            );
    
            // Insertar el usuario en la base de datos
            $result = UsuarioDAO::save($usuario);
            
            // Verificar si la inserción fue exitosa
            if ($result) {
                $response = ['status' => 'success', 'message' => 'Usuario creado correctamente.'];
                Logger::log("Usuario creado: " . $email); // Registrar la acción
            } else {
                $response = ['status' => 'error', 'message' => 'No se pudo crear el usuario.'];
            }
    
            header('Content-Type: application/json');
            echo json_encode($response);
    
        } else {
            // Si falta algún dato, devolver un error
            $response = ['status' => 'error', 'message' => 'Datos incompletos.'];
            header('Content-Type: application/json');
            echo json_encode($response);
        }
        ob_end_clean(); // Borra el buffer de salida
        echo json_encode($response); // Devuelve solo JSON
        exit;
    }

    // Función para obtener los datos de un usuario
    public function obtenerUsuario($usuarioId) {
        header('Content-Type: application/json');

        // Verificar si se pasa un usuarioId
        if (!$usuarioId) {
            echo json_encode(['status' => 'error', 'message' => 'ID del usuario no proporcionado.']);
            return;
        }

        // Obtener los datos del usuario desde la base de datos
        $sql = "SELECT * FROM USUARIO WHERE usuario_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $usuarioId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $usuario = $result->fetch_assoc();
            echo json_encode($usuario);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Usuario no encontrado.']);
        }

        $stmt->close();
        $this->closeConnection();
    }

    // Función para editar un usuario
    public function editarUsuario($usuarioId) {
        header('Content-Type: application/json');
        
        // Obtener los datos enviados por la solicitud PUT
        $input = json_decode(file_get_contents('php://input'), true);
        
        $usuario_id = $input['usuario_id'] ?? null;
        $nombre = $input['nombre'] ?? null;
        $email = $input['email'] ?? null;
        $rol = $input['rol'] ?? null;

        if (!$usuario_id || !$nombre || !$email || !$rol) {
            echo json_encode(['status' => 'error', 'message' => 'Datos incompletos']);
            return;
        }

        // Actualizar los datos del usuario
        $sql = "UPDATE USUARIO SET nombre = ?, email = ?, rol = ? WHERE usuario_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssi", $nombre, $email, $rol, $usuario_id);
        $stmt->execute();

        $response = ($stmt->affected_rows > 0) 
            ? ['status' => 'success', 'message' => 'Usuario actualizado correctamente.'] 
            : ['status' => 'error', 'message' => 'No se pudo actualizar el usuario.'];

        $stmt->close();
        $this->closeConnection();

        echo json_encode($response);
    }

    public function eliminarUsuario() {
        header('Content-Type: application/json');
        $usuario_id = $_GET['usuario_id'] ?? null;
    
        if (!$usuario_id) {
            echo json_encode(['status' => 'error', 'message' => 'ID del usuario no proporcionado.']);
            return;
        }
    
        // Verificar si el usuario existe antes de eliminarlo
        $sql = "SELECT * FROM USUARIO WHERE usuario_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows === 0) {
            echo json_encode(['status' => 'error', 'message' => 'Usuario no encontrado.']);
            // Log de intento fallido de eliminación de usuario
            $this->logController->registrarLog(1, "Intento fallido de eliminar usuario: ID $usuario_id. Usuario no encontrado.");
            return;
        }
    
        // Eliminar el usuario
        $sql = "DELETE FROM USUARIO WHERE usuario_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();
    
        $response = ($stmt->affected_rows > 0) 
            ? ['status' => 'success', 'message' => 'Usuario eliminado correctamente.'] 
            : ['status' => 'error', 'message' => 'No se pudo eliminar el usuario.'];
    
        $stmt->close();
        $this->closeConnection();
    
        echo json_encode($response);
    
        // logController::writeLog("Se ha eliminado el usuario: $usuario_id");
    }

    // Función para obtener los logs
    function getLogs() {
        $logs = logController::getLogs();
        header('Content-Type: application/json');
        echo json_encode($logs);
    }
    // Función para borrar los logs
    function clearLogs() {
        logController::clearLogs();
        header('Content-Type: application/json');
        echo json_encode(['status' => 'success', 'message' => 'Logs borrados correctamente.']);
    }

}
