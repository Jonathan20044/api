<?php
// Clase Conectar para manejar la conexión a la base de datos
class Conectar {
    // Variable protegida para almacenar la instancia de la conexión
    protected $conexion_bd;
    
    // Método protegido para establecer la conexión con la base de datos
    protected function conectar_bd() {
        try {
            // Configuración de conexión a la base de datos proporcionada por Railway
            $host = "mysql.railway.internal"; // Host interno de Railway
            $dbname = "sistema_ventas_motos"; // Nombre de la base de datos
            $user = "root"; // Usuario
            $password = "rHIvtfJQPmmdvubZiwYmVSpFIeHrThIX"; // Contraseña
            $port = "3306"; // Puerto
            
            // Establece la conexión utilizando PDO
            $dsn = "mysql:host=$host;port=$port;dbname=$dbname";
            $conexion = $this->conexion_bd = new PDO($dsn, $user, $password);
            
            // Configuración adicional para manejar errores
            $this->conexion_bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $conexion;
        } catch (PDOException $e) {
            // Si ocurre un error, muestra el mensaje de error y detiene la ejecución
            print "Error en la base de datos: " . $e->getMessage() . "<br/>";
            die(); // Detiene la ejecución
        }
    }

    // Método público para establecer la codificación de caracteres a UTF-8
    public function establecer_codificacion() {
        // Ejecuta la sentencia SQL para configurar la codificación de caracteres a UTF-8
        return $this->conexion_bd->query("SET NAMES 'utf8'");
    }
}
?>

