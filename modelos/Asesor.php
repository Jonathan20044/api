<?php

class Asesor extends Conectar {

    public function obtener_asesores() {
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();

        $consulta_sql = "SELECT * FROM asesores";
        $consulta = $conexion->prepare($consulta_sql);
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtener_asesor_por_id($id_asesor) {
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();

        $consulta_sql = "SELECT * FROM asesores WHERE id = ?";
        $consulta = $conexion->prepare($consulta_sql);
        $consulta->bindValue(1, $id_asesor);
        $consulta->execute();

        return $consulta->fetch(PDO::FETCH_ASSOC);
    }

    public function insertar_asesor($nombre, $edad, $correo, $motos_vendidas) {
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();

        $sentencia_sql = "INSERT INTO asesores (nombre, edad, correo, motos_vendidas) VALUES (?, ?, ?, ?)";
        $sentencia = $conexion->prepare($sentencia_sql);
        $sentencia->bindValue(1, $nombre);
        $sentencia->bindValue(2, $edad);
        $sentencia->bindValue(3, $correo);
        $sentencia->bindValue(4, $motos_vendidas);
        $sentencia->execute();
    }

    public function actualizar_asesor($id, $nombre, $edad, $correo, $motos_vendidas) {
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();

        $sentencia_sql = "UPDATE asesores SET nombre = ?, edad = ?, correo = ?, motos_vendidas = ? WHERE id = ?";
        $sentencia = $conexion->prepare($sentencia_sql);
        $sentencia->bindValue(1, $nombre);
        $sentencia->bindValue(2, $edad);
        $sentencia->bindValue(3, $correo);
        $sentencia->bindValue(4, $motos_vendidas);
        $sentencia->bindValue(5, $id);
        $sentencia->execute();
    }

    public function eliminar_asesor($id_asesor) {
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();

        $sentencia_sql = "DELETE FROM asesores WHERE id = ?";
        $sentencia = $conexion->prepare($sentencia_sql);
        $sentencia->bindValue(1, $id_asesor);
        $sentencia->execute();
    }
}
?>
