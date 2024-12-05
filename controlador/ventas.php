<?php

// Configuración de cabeceras y errores
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Incluye los archivos necesarios
require_once("../configuracion/conexion.php");
require_once("../modelos/Ventas.php");

// Instancia de la clase VentasMensuales
$ventas = new Ventas();

// Obtiene los datos enviados en formato JSON
$body = json_decode(file_get_contents("php://input"), true);

// Define las operaciones según el parámetro "op" en la URL
switch ($_GET["op"]) {

    case "ObtenerTodos":
        $datos = $ventas->obtener_ventas();
        echo json_encode($datos);
        break;

    case "ObtenerPorId":
        $datos = $ventas->obtener_venta_por_id($body["id"]);
        echo json_encode($datos);
        break;

    case "Insertar":
        $datos = $ventas->insertar_venta($body["marca"], $body["modelo"], $body["año"], $body["cantidad_vendida"]);
        echo json_encode(["Correcto" => "Inserción realizada"]);
        break;

    case "Actualizar":
        $datos = $ventas->actualizar_venta($body["id"], $body["marca"], $body["modelo"], $body["año"], $body["cantidad_vendida"]);
        echo json_encode(["Correcto" => "Actualización realizada"]);
        break;

    case "Eliminar":
        $datos = $ventas->eliminar_venta($body["id"]);
        echo json_encode(["Correcto" => "Eliminación realizada"]);
        break;
}
?>
