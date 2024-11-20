/assets/: Esta carpeta contiene todos los archivos estáticos (CSS, imágenes, JS, tipografía) de la web. Aquí colocaré los estilos generales, scripts, y las imágenes (como el logo del restaurante).

/config/: Aquí irán los archivos de configuración. En dataBase.php se configurará la conexión a la base de datos, mientras que parameters.php contiene parámetros globales de la aplicación.

/controllers/: Contendrá los controladores de la aplicación. Estos se encargarán de recibir las peticiones del usuario, interactuar con los modelos para obtener los datos, y finalmente, devolver los resultados a las vistas. 

/models/: Esta carpeta contiene las clases del Modelo, las cuales representan los datos y las interacciones con la base de datos.

/views/: Aquí se encuentran las Vistas, que son las interfaces de usuario. Cada controlador llamará a una vista específica para mostrar la información al usuario. Para hacer más claro el flujo, se divide en dos partes: una para usuario y otra para administrador.