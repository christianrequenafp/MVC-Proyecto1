# El Fogón Criollo

## Descripción del Proyecto
**El Fogón Criollo** es un sitio web de comercio electrónico enfocado en la venta de productos de alta calidad relacionados con carnes y gastronomía. Ofrece funcionalidades como carrito de compras, registro e inicio de sesión de usuarios, y una experiencia visual intuitiva.

## Funcionalidades Principales
- **Carrito de Compras**: Los usuarios pueden agregar, actualizar y eliminar productos de su carrito de compras de manera sencilla.
- **Registro e Inicio de Sesión**: Los usuarios pueden registrarse con su nombre, correo electrónico y una contraseña segura.
- **Vista Unificada de Autenticación**: La página de inicio de sesión y registro están juntas, lo que simplifica el uso para el usuario.
- **Optimización de Imágenes**: Se utiliza el formato **WEBP** para imágenes, lo que mejora los tiempos de carga de la página y la experiencia del usuario.

## Estructura del Proyecto
El proyecto sigue una estructura organizada para facilitar su escalabilidad y mantenimiento:

```
- assets/
    - css/          # Archivos de estilos
    - fonts/        # Fuentes personalizadas
    - images/       # Recursos gráficos optimizados
- controllers/      # Controladores de la aplicación
- models/           # Lógica del negocio y base de datos
- views/            # Vistas para el usuario
- index.php         # Punto de entrada principal del proyecto
- config/           # Configuración de parámetros globales
- README.md         # Documentación del proyecto
```

## Requisitos Previos
Asegúrate de tener los siguientes componentes instalados:
- **PHP 7.4 o superior**
- **Servidor Web**: Apache o NGINX
- **Base de Datos**: MySQL/MariaDB

## Instalación
Sigue estos pasos para instalar y configurar el proyecto en tu entorno local:
1. Clona el repositorio:
   ```bash
   git clone https://github.com/usuario/el-fogon-criollo.git
   ```
2. Configura la base de datos:
   - Importa el archivo SQL proporcionado en tu servidor MySQL.
   - Configura las credenciales de la base de datos en `config/parameters.php`.

3. Inicia el servidor local:
   ```bash
   php -S localhost:8000
   ```
4. Abre tu navegador y accede a:
   ```
   http://localhost:8000
   ```

## Seguridad
- Las contraseñas se almacenan de forma segura utilizando `password_hash()` y `password_verify()`.