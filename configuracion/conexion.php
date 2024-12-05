<?php
// Clase Conectar para manejar la conexión a la base de datos
class Conectar {

    // Variable protegida para almacenar la instancia de la conexión
    protected $conexion_bd;

    // Método protegido para establecer la conexión con la base de datos
    protected function conectar_bd() {
        try {
            // Obtener las variables de entorno proporcionadas por Railway
            $host = getenv('MYSQLHOST');
            $dbname = getenv('MYSQLDATABASE');
            $user = getenv('MYSQLUSER');
            $password = getenv('MYSQLPASSWORD');
            $port = getenv('MYSQLPORT');

            // Crear la cadena DSN para PDO
            $dsn = "mysql:host=$host;port=$port;dbname=$dbname";

            // Establecer la conexión a la base de datos usando PDO
            $this->conexion_bd = new PDO($dsn, $user, $password);

            // Configurar el modo de errores de PDO
            $this->conexion_bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $this->conexion_bd;
        } catch (PDOException $e) {
            // Si ocurre un error, imprimir el mensaje de error
            echo "Error de conexión: " . $e->getMessage();
            die(); // Terminar la ejecución del script
        }
    }

    // Método público para establecer la codificación de caracteres a UTF-8
    public function establecer_codificacion() {
        // Ejecuta la sentencia SQL para configurar la codificación de caracteres a UTF-8
        return $this->conexion_bd->query("SET NAMES 'utf8'");
    }
}
