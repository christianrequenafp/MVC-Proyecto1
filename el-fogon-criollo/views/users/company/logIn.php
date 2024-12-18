<div class="account-container">
    <div>
        <h4>Inicio de sesión</h4>
        <form class="login-form" action="index.php?controller=usuario&action=doLogin" method="POST">
            <label for="email">Dirección de correo <span class="required">*</span></label>
            <input type="email" id="email" name="email" required>
            <label for="password">Contraseña <span class="required">*</span></label>
            <input type="password" id="password" name="password" required>
            <div class="remember-me">
                <label for="remember">Recordarme &nbsp; <input type="checkbox" id="remember" name="remember"></label>
            </div>
            <button class="submit-login" type="submit-login">INICIAR SESIÓN</button>
        </form>
    </div>

    <div>
        <h4>Registro</h4>
        <form class="register-form" action="index.php?controller=usuario&action=saveUser" method="POST">
            <label for="register-name">Nombre <span class="required">*</span></label>
            <input type="text" id="register-name" name="nombre" required>
            
            <label for="register-email">Dirección de correo <span class="required">*</span></label>
            <input type="email" id="register-email" name="email" required>
            
            <label for="register-password">Contraseña <span class="required">*</span></label>
            <input type="password" id="register-password" name="password" required>
            
            <button class="submit-login" type="submit-login">REGISTRARSE</button>
        </form>
    </div>
</div>
