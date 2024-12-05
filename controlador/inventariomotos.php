<?php

// Configuración de cabeceras para la API
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Habilitar la visualización de errores
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Inclusión de dependencias necesarias
require_once("../configuracion/conexion.php");
require_once("../modelos/InventarioMotos.php");

// Instancia del modelo
$inventario = new InventarioMotos();

// Obtener los datos enviados (JSON)
$body = json_decode(file_get_contents("php://input"), true);

// Determinar la operación solicitada
$op = isset($_GET["op"]) ? $_GET["op"] : null;

try {
    switch ($op) {
        case "ObtenerTodos":
            $datos = $inventario->obtener_motos();
            echo json_encode($datos);
            break;

        case "ObtenerPorId":
            if (!isset($body["id"])) {
                throw new Exception("ID no proporcionado.");
            }
            $datos = $inventario->obtener_moto_por_id($body["id"]);
            echo json_encode($datos);
            break;

            case "Insertar":
                if (!isset($body["marca"], $body["modelo"], $body["año"], $body["precio"], $body["cantidad"])) {
                    echo json_encode(["error" => "Faltan datos para insertar la moto."]);
                    return;
                }
                $resultado = $inventario->insertar_moto(
                    $body["marca"],
                    $body["modelo"],
                    $body["año"],
                    $body["precio"],
                    $body["cantidad"]
                );
                echo json_encode(["mensaje" => $resultado ? "Moto insertada con éxito" : "Error al insertar la moto"]);
                break;
            
            case "Actualizar":
                if (!isset($body["id"], $body["marca"], $body["modelo"], $body["año"], $body["precio"], $body["cantidad"])) {
                    echo json_encode(["error" => "Faltan datos para actualizar la moto."]);
                    return;
                }
                $resultado = $inventario->actualizar_moto(
                    $body["id"],
                    $body["marca"],
                    $body["modelo"],
                    $body["año"],
                    $body["precio"],
                    $body["cantidad"]
                );
                echo json_encode(["mensaje" => $resultado ? "Moto actualizada con éxito" : "Error al actualizar la moto"]);
                break;

        case "Eliminar":
            if (!isset($body["id"])) {
                throw new Exception("ID no proporcionado.");
            }
            $resultado = $inventario->eliminar_moto($body["id"]);
            echo json_encode(["mensaje" => $resultado ? "Moto eliminada con éxito" : "No se pudo eliminar la moto"]);
            break;

        default:
            echo json_encode(["error" => "Operación no válida"]);
            break;
    }
} catch (Exception $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?> 
