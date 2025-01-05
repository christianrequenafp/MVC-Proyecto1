<?php
include_once "models/PedidoDAO.php";
include_once "models/ProductoDAO.php";
include_once "models/UsuarioDAO.php";

class adminController {
    private $pedidoDAO;
    private $productoDAO;
    private $usuarioDAO;

    public function __construct() {
        $this->pedidoDAO = new PedidoDAO();
        $this->productoDAO = new ProductoDAO();
        $this->usuarioDAO = new UsuarioDAO();
    }

    public function index(){
        $view = "views/admin/homeAdmin.php";
        include_once "views/main.php";
    }

    // Método para ver todos los pedidos
    public function viewOrders() {
        $pedidos = $this->pedidoDAO->getOrders();
        include_once "views/admin/orders.php";
    }

    // Método para crear un nuevo pedido
    public function createOrder($datosPedido) {
        $orderId = $this->pedidoDAO->createOrder($datosPedido);
        echo json_encode(['status' => 'success', 'orderId' => $orderId]);
    }

    // Método para obtener todos los productos
    public function viewProducts() {
        $productos = $this->productoDAO->getAll();
        include_once "views/admin/products.php";
    }

    // Método para crear un nuevo producto
    public function createProduct($data) {
        $producto = new Producto();
        $producto->setNombre($data['nombre']);
        $producto->setDescripcion($data['descripcion']);
        $producto->setTipo($data['tipo']);
        $producto->setPrecio($data['precio']);
        $producto->setImagen($data['imagen']);
        
        // $this->productoDAO->save($producto);

        echo json_encode(['status' => 'success']);
    }

    // Método para obtener todos los usuarios
    public function viewUsers() {
        $usuarios = $this->usuarioDAO->getAllUsers();
        include_once "views/admin/users.php";
    }

    // Método para crear un nuevo usuario
    public function createUser($data) {
        $usuario = new Usuario();
        $usuario->setNombre($data['nombre']);
        $usuario->setEmail($data['email']);
        $usuario->setPassword($data['password']);
        $usuario->setRol($data['rol']);
        
        $this->usuarioDAO->save($usuario);

        echo json_encode(['status' => 'success']);
    }

    // Método para registrar las acciones (para historial)
    public function logAction($action, $userId) {
        // Falta crear clase para los LOG
    }
}
?>
