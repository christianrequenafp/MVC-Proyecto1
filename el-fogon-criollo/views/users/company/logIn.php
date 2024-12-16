<div class="account-container">
    <!-- Login Form -->
    <div class="login-form">
        <h2>Inicio de sesión</h2>
        <form action="index.php?controller=usuario&action=doLogin" method="POST">
            <label for="email">Dirección de correo</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required>
            <div class="remember-me">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Recordarme</label>
            </div>
            <button type="submit-login">INICIAR SESIÓN</button>
            <div class="form-links">
                <a href="#">Contraseña perdida?</a>
            </div>
        </form>
    </div>

    <!-- Register Form -->
    <div class="register-form">
        <h2>Registro</h2>
        <form action="index.php?controller=usuario&action=saveUser" method="POST">
            <label for="register-name">Nombre</label>
            <input type="text" id="register-name" name="nombre" placeholder="Tu nombre" required>
            
            <label for="register-email">Dirección de correo</label>
            <input type="email" id="register-email" name="email" placeholder="Tu email" required>
            
            <label for="register-password">Contraseña</label>
            <input type="password" id="register-password" name="password" placeholder="Tu contraseña" required>
            
            <button type="submit-login">REGISTRARSE</button>
        </form>
    </div>
</div>
