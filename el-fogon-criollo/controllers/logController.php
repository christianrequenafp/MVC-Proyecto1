<?php

class logController {
    protected static $archivoLogs = __DIR__ . './logs/logs.log';

    //Función para escribir en el archivo de logs
    public static function writeLog($mensaje) {
        $directorioLog = dirname(self::$archivoLogs); // Obtiene el directorio del archivo de logs
        if (!is_dir($directorioLog)) {
            mkdir($directorioLog, 0777, true); // Crea el directorio si no existe
        }

        $fecha = date('Y-m-d H:i:s');
        $mensajeLog = "[$fecha] $mensaje" . PHP_EOL; // Mensaje que se escribira en el archivo de logs
        file_put_contents(self::$archivoLogs, $mensajeLog, FILE_APPEND); // Escribe el mensaje en el archivo de logs
    }

    //Función para obtener los logs
    public static function getLogs() {
        if (file_exists(self::$archivoLogs)) {
            return file(self::$archivoLogs, FILE_IGNORE_NEW_LINES);
        }
        return []; //Devuelve un array vacío si no existe el archivo de logs
    }

    //Función para limpiar logs
    public static function clearLogs() {
        if (file_exists(self::$archivoLogs)) {
            file_put_contents(self::$archivoLogs, '');
        }
    }
}
?>