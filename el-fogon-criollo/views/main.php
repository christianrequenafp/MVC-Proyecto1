<?php
// Inicia la sesión si no está ya iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Fogón Criollo</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Iconos de Bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <!-- Archivo con los estilos CSS personalizados -->
    <link rel="stylesheet" href="assets/css/styles.css">
    <!-- Favicon para el icono de la pestaña en el navegador -->
    <link rel="icon" href="./assets/images/Logo.png" type="image/png">
    <!-- Kit de Font Awesome para los iconos -->
    <script src="https://kit.fontawesome.com/246f3af3e1.js" crossorigin="anonymous"></script>
</head>
<!-- Header -->
<header class="p-3 text-white">
    <div class="container-fluid py-3">
        <div class="row align-items-center">
            <!-- Logo -->
            <div class="col-md-4 d-flex justify-content-start ps-5">
                <a href="?controller=producto&action=index">
                    <img src="./assets/images/Logo.png" alt="Imagen logo">
                </a>
                
                <!-- Botón de acceso al Panel de Administrador visible solo si el usuario tiene rol "admin" -->
                <?php if (isset($_SESSION["admin"]) && $_SESSION["admin"] === true): ?>
                    <button class="admin-button"><a href="?controller=api&action=index" class="text-decoration-none text-white">ACCEDER AL PANEL DE ADMINISTRADOR</a></button>
                <?php endif; ?>
            </div>
            
            <div class="col-md-8 d-flex flex-column align-items-end pe-5">
                <div class="d-flex align-items-center">
                    <!-- Mensaje de bienvenida y enlaces según estado de la sesión -->
                    <?php if (isset($_SESSION["user"])): ?>
                        <a class="welcome-user text-decoration-none mx-3">Bienvenido, <?= htmlspecialchars($_SESSION["user"]); ?></a>
                        <span class="text-white">|</span>
                        <a href="?controller=usuario&action=logout" class="text-warning text-decoration-none mx-3">Cerrar sesión</a>
                    <?php else: ?>
                        <a href="?controller=producto&action=joinUs" class="text-warning text-decoration-none me-3">Únete a nosotros</a>
                        <span class="text-white">|</span>
                        <a href="?controller=producto&action=logIn" class="text-warning text-decoration-none mx-3">Inicio de sesión</a>
                    <?php endif; ?>
                    <span class="text-white">|</span>
                    <button class="btn btn-link p-0 ms-3"><i class="fas fa-search lupa"></i></button>
                </div>
                
                <!-- Menú de navegación principal -->
                <nav class="mt-3">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link fw-bold" href="?controller=producto&action=ourCart">Nuestra carta</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-bold" href="?controller=producto&action=aboutUs">Sobre nosotros</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-bold" href="?controller=producto&action=contact">Contacto</a>
                        </li>
                        <li class="nav-item text-center">
                            <a href="?controller=carrito&action=viewCart">
                                <button class="btn btn-link text-white p-0"><i class="fas fa-shopping-cart"></i></button>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
<body>

    <?php
    // Incluir la vista dinámica dependiendo de la acción solicitada
    include_once $view;
    ?>

    <!-- Scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
<!-- Footer -->
<footer>
    <div class="footer-content">
        <div class="footer-logo">
            <a href="?controller=producto&action=index">
                <img src="./assets/images/Logo.png" alt="Logo El Fogon Criollo">
            </a>
        </div>
        
        <div class="social-icons">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
        </div>

        <div class="privacy-policy">
            <a href="#">Política de privacidad</a>
        </div>

        <div class="copyright">
            ©2024, www.elfogoncriollo.com. Todos los derechos reservados
        </div>
    </div>
</footer>
</html>
