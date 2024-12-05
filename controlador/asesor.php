<?php

// Configuración de encabezados y errores
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Conexión y modelo
require_once("../configuracion/conexion.php");
require_once("../modelos/Asesor.php");

$asesor = new Asesor();

$body = json_decode(file_get_contents("php://input"), true);

switch ($_GET["op"]) {

    case "ObtenerTodos":
        $datos = $asesor->obtener_asesores();
        echo json_encode($datos);
        break;

    case "ObtenerPorId":
        $datos = $asesor->obtener_asesor_por_id($body["id"]);
        echo json_encode($datos);
        break;

    case "Insertar":
        $datos = $asesor->insertar_asesor($body["nombre"], $body["edad"], $body["correo"], $body["motos_vendidas"]);
        echo json_encode(["Correcto" => "Inserción realizada"]);
        break;

    case "Actualizar":
        $datos = $asesor->actualizar_asesor($body["id"], $body["nombre"], $body["edad"], $body["correo"], $body["motos_vendidas"]);
        echo json_encode(["Correcto" => "Actualización realizada"]);
        break;

    case "Eliminar":
        $datos = $asesor->eliminar_asesor($body["id"]);
        echo json_encode(["Correcto" => "Eliminación realizada"]);
        break;
}
?>
