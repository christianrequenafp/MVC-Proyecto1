<?php
// Inicia sesión si no se ha iniciado aún
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica si el usuario es un administrador
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: ./"); // Redirige a la página principal si no es admin
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel de Administración</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <!-- Estilos personalizados -->
  <link rel="stylesheet" href="./assets/css/styles.css">
</head>
<body>
    <header class="p-3 text-white bg-dark">
        <div class="container">
        <h1>Panel de Administración</h1>
        </div>
    </header>

    <main class="container mt-4">

        <!-- Botones de logs -->
        <!-- <div class="button-group">
            <h3>Logs</h3>
            <button id="seeLogs" class="btn-admin">Ver Logs</button>
            <button id="clearLogs" class="btn-admin" style="display: none;">Borrar Logs</button>
        </div> -->
        <!-- Sección de Pedidos -->
        <section id="orders-section">
            <h2>Pedidos</h2>
            <table id="orders-table" class="table">
                <thead>
                <tr>
                    <th>ID del pedido</th>
                    <th>Usuario</th>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody id="orders-body">
                <!-- Las filas se cargarán mediante JavaScript -->
                </tbody>
            </table>
            <button id="create-order" class="btn btn-primary">Crear Nueva Orden</button>

            <!-- Formulario para Crear Nuevo Pedido (inicialmente oculto) -->
            <div id="create-order-form" class="mt-3" style="display:none;">
                <h3>Crear Nuevo Pedido</h3>
                <form id="form-create-order">
                    <div class="mb-3">
                        <label for="pedidoUsuario" class="form-label">Usuario</label>
                        <input type="text" class="form-control" id="pedidoUsuario" required>
                    </div>
                    <div class="mb-3">
                        <label for="pedidoTotal" class="form-label">Total</label>
                        <input type="number" class="form-control" id="pedidoTotal" required>
                    </div>
                    <div class="mb-3">
                        <label for="pedidoFecha" class="form-label">Fecha</label>
                        <input type="date" class="form-control" id="pedidoFecha" required>
                    </div>
                    <div class="mb-3">
                        <label for="pedidoEstado" class="form-label">Estado</label>
                        <input type="text" class="form-control" id="pedidoEstado" required>
                    </div>
                    <div class="mb-3">
                        <label for="pedidoMetodoPago" class="form-label">Método de Pago</label>
                        <input type="text" class="form-control" id="pedidoMetodoPago" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Crear Pedido</button>
                    <button type="button" class="btn btn-secondary" id="close-create-order-form">Cerrar</button>
                </form>
            </div>
        </section>


        <!-- Sección de Productos -->
        <section id="products-section" class="mt-5">
            <h2>Productos</h2>
            <table id="products-table" class="table">
                <thead>
                <tr>
                    <th>ID del producto</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Tipo</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody id="products-body">
                <!-- Las filas se cargarán mediante JavaScript -->
                </tbody>
            </table>
            <button id="create-product" class="btn btn-primary">Crear Nuevo Producto</button>

            <!-- Formulario para Crear Nuevo Producto (inicialmente oculto) -->
            <div id="create-product-form" class="mt-3" style="display:none;">
                <h3>Crear Nuevo Producto</h3>
                <form id="form-create-product">
                <div class="mb-3">
                    <label for="productoNombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="productoNombre" required>
                </div>
                <div class="mb-3">
                    <label for="productoDescripcion" class="form-label">Descripción</label>
                    <input type="text" class="form-control" id="productoDescripcion" required>
                </div>
                <div class="mb-3">
                    <label for="productoPrecio" class="form-label">Precio</label>
                    <input type="number" class="form-control" id="productoPrecio" required>
                </div>
                <div class="mb-3">
                    <label for="productoImagen" class="form-label">Imagen</label>
                    <input type="file" class="form-control" id="productoImagen" required>
                </div>
                <button type="submit" class="btn btn-primary">Crear Producto</button>
                <button type="button" class="btn btn-secondary" id="close-create-product-form">Cerrar</button>
                </form>
            </div>
        </section>



        <!-- Sección de Usuarios -->
        <section id="users-section" class="mt-5">
            <h2>Usuarios</h2>
            <table id="users-table" class="table">
                <thead>
                <tr>
                    <th>ID del usuario</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody id="users-body">
                <!-- Las filas se cargarán mediante JavaScript -->
                </tbody>
            </table>
            <button id="create-user" class="btn btn-primary">Crear Nuevo Usuario</button>

            <!-- Este formulario será mostrado cuando se haga clic en "Editar" -->
            <div id="editUserModal" style="display: none;">
                <h3>Editar Usuario</h3>
                <form id="editUserForm">
                    <input type="hidden" id="editUserId" />
                    <label for="editUserName">Nombre:</label>
                    <input type="text" id="editUserName" required />
                    
                    <label for="editUserEmail">Email:</label>
                    <input type="email" id="editUserEmail" required />
                    
                    <label for="editUserRole">Rol:</label>
                    <select id="editUserRole">
                        <option value="usuario">Usuario</option>
                        <option value="admin">Administrador</option>
                    </select>
                    
                    <button type="submit">Guardar cambios</button>
                </form>
                <button onclick="closeEditModal()">Cerrar</button>
            </div>

            <!-- Formulario para Crear Nuevo Usuario (inicialmente oculto) -->
            <div id="create-user-form" class="mt-3" style="display:none;">
                <h3>Crear Nuevo Usuario</h3>
                <form id="form-create-user">
                    <div class="mb-3">
                        <label for="usuarioNombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="usuarioNombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="usuarioEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="usuarioEmail" required>
                    </div>
                    <div class="mb-3">
                        <label for="usuarioContrasena" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="usuarioContrasena" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Crear Usuario</button>
                    <button type="button" class="btn btn-secondary" id="close-create-user-form">Cerrar</button>
                </form>
            </div>
        </section>
        <br>
    </main>

    <!-- Scripts JS personalizados -->
    <script src="./assets/js/pedidos.js"></script>
    <script src="./assets/js/productos.js"></script>
    <script src="./assets/js/usuarios.js"></script>
    <!-- <script src="./assets/js/logs.js"></script> -->
    <script>

        // Mostrar formulario de crear producto
        document.getElementById('create-product').addEventListener('click', function() {
            const form = document.getElementById('create-product-form');
            form.style.display = form.style.display === 'none' || form.style.display === '' ? 'block' : 'none';
        });

        // Mostrar formulario de crear pedido
        document.getElementById('create-order').addEventListener('click', function() {
            const form = document.getElementById('create-order-form');
            form.style.display = form.style.display === 'none' || form.style.display === '' ? 'block' : 'none';
        });

        // Mostrar formulario de crear usuario
        document.getElementById('create-user').addEventListener('click', function() {
            const form = document.getElementById('create-user-form');
            form.style.display = form.style.display === 'none' || form.style.display === '' ? 'block' : 'none';
        });

        // Cerrar formulario de crear producto
        document.getElementById('close-create-product-form').addEventListener('click', function() {
            document.getElementById('create-product-form').style.display = 'none'; // Oculta el formulario
        });

        // Cerrar formulario de crear usuario
        document.getElementById('close-create-user-form').addEventListener('click', function() {
            document.getElementById('create-user-form').style.display = 'none'; // Oculta el formulario
        });

        // Cerrar formulario de crear pedido
        document.getElementById('close-create-order-form').addEventListener('click', function() {
            document.getElementById('create-order-form').style.display = 'none'; // Oculta el formulario
        });

    </script>
</body>
</html>