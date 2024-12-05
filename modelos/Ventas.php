<?php
class Ventas extends Conectar {

    public function obtener_ventas() {
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();
        $consulta_sql = "SELECT * FROM ventas_mensuales";
        $consulta = $conexion->prepare($consulta_sql);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtener_venta_por_id($id) {
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();
        $consulta_sql = "SELECT * FROM ventas_mensuales WHERE id = ?";
        $consulta = $conexion->prepare($consulta_sql);
        $consulta->bindValue(1, $id);
        $consulta->execute();
        return $consulta->fetch(PDO::FETCH_ASSOC);
    }

    public function insertar_venta($marca, $modelo, $año, $cantidad_vendida) {
        if(strlen($año) == 2) {
            // Si el año tiene dos dígitos, lo dejamos tal cual
            $año = (int)$año; // Convierte el valor en entero para que se guarde sin ceros a la izquierda
        }
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();
        $consulta_sql = "INSERT INTO ventas_mensuales (marca, modelo, año, cantidad_vendida) VALUES (?, ?, ?, ?)";
        $consulta = $conexion->prepare($consulta_sql);
        $consulta->bindValue(1, $marca);
        $consulta->bindValue(2, $modelo);
        $consulta->bindValue(3, $año);
        $consulta->bindValue(4, $cantidad_vendida);
        $consulta->execute();
        return $conexion->lastInsertId();
    }

    public function actualizar_venta($id, $marca, $modelo, $año, $cantidad_vendida) {
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();
        $consulta_sql = "UPDATE ventas_mensuales SET marca = ?, modelo = ?, año = ?, cantidad_vendida = ? WHERE id = ?";
        $consulta = $conexion->prepare($consulta_sql);
        $consulta->bindValue(1, $marca);
        $consulta->bindValue(2, $modelo);
        $consulta->bindValue(3, $año);
        $consulta->bindValue(4, $cantidad_vendida);
        $consulta->bindValue(5, $id);
        $consulta->execute();
    }

    public function eliminar_venta($id) {
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();
        $consulta_sql = "DELETE FROM ventas_mensuales WHERE id = ?";
        $consulta = $conexion->prepare($consulta_sql);
        $consulta->bindValue(1, $id);
        $consulta->execute();
    }
}
?>
