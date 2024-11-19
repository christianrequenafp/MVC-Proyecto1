/assets/: Esta carpeta contiene todos los archivos estáticos (CSS, imágenes, JS) de la web. Aquí colocarás los estilos generales, scripts, y las imágenes (como el logo del restaurante).

/config/: Aquí irán los archivos de configuración. En db.php se configurará la conexión a la base de datos, mientras que config.php puede contener parámetros globales de la aplicación (como rutas base, configuración de moneda, etc.).

/controllers/: Contendrá los controladores de la aplicación. Estos se encargarán de recibir las peticiones del usuario, interactuar con los modelos para obtener los datos, y finalmente, devolver los resultados a las vistas. Cada entidad (producto, pedido, usuario) tendrá su propio controlador.

/includes/: Archivos comunes que se incluyen en varias páginas, como el header, footer y la barra de navegación. Esto ayuda a evitar duplicación de código y facilita la gestión de la estructura.

/models/: Esta carpeta contiene las clases del Modelo, las cuales representan los datos y las interacciones con la base de datos. Cada modelo maneja una entidad de la aplicación (productos, pedidos, usuarios, etc.).

/views/: Aquí se encuentran las Vistas, que son las interfaces de usuario. Cada controlador llamará a una vista específica para mostrar la información al usuario. Para hacer más claro el flujo, se divide en dos partes: una para usuario y otra para administrador.

/MVC/: Modelo/Vista/Controlador de clase el qual aplicare en mi proyecto.