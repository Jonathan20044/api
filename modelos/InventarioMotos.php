<?php

class InventarioMotos extends Conectar {
    // Obtener todas las motos
    public function obtener_motos() {
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();
        $consulta_sql = "SELECT * FROM inventario_motos";
        $consulta = $conexion->prepare($consulta_sql);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener una moto por su ID
    public function obtener_moto_por_id($id_moto) {
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();
        $consulta_sql = "SELECT * FROM inventario_motos WHERE id = ?";
        $consulta = $conexion->prepare($consulta_sql);
        $consulta->bindValue(1, $id_moto, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetch(PDO::FETCH_ASSOC);
    }

    // Insertar una nueva moto
    public function insertar_moto($marca, $modelo, $año, $precio, $cantidad) {
        // Convertir el año a dos dígitos si es menor a 100
        if(strlen($año) == 2) {
            // Si el año tiene dos dígitos, lo dejamos tal cual
            $año = (int)$año; // Convierte el valor en entero para que se guarde sin ceros a la izquierda
        }
        
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();
        $sentencia_sql = "INSERT INTO inventario_motos (marca, modelo, año, precio, cantidad) VALUES (?, ?, ?, ?, ?)";
        $sentencia = $conexion->prepare($sentencia_sql);
        $sentencia->bindValue(1, $marca);
        $sentencia->bindValue(2, $modelo);
        $sentencia->bindValue(3, $año, PDO::PARAM_INT); // Guardamos el año tal cual
        $sentencia->bindValue(4, $precio, PDO::PARAM_INT);
        $sentencia->bindValue(5, $cantidad, PDO::PARAM_INT);
        $sentencia->execute();
    }
    

    // Actualizar una moto existente
    public function actualizar_moto($id_moto, $marca, $modelo, $año, $precio, $cantidad) {
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();
        $sentencia_sql = "UPDATE inventario_motos SET marca = ?, modelo = ?, año = ?, precio = ?, cantidad = ? WHERE id = ?";
        $sentencia = $conexion->prepare($sentencia_sql);
        $sentencia->bindValue(1, $marca);
        $sentencia->bindValue(2, $modelo);
        $sentencia->bindValue(3, $año, PDO::PARAM_INT);
        $sentencia->bindValue(4, $precio, PDO::PARAM_INT);
        $sentencia->bindValue(5, $cantidad, PDO::PARAM_INT);
        $sentencia->bindValue(6, $id_moto, PDO::PARAM_INT);
        $sentencia->execute();
    }

    // Eliminar una moto
    public function eliminar_moto($id_moto) {
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();
        $sentencia_sql = "DELETE FROM inventario_motos WHERE id = ?";
        $sentencia = $conexion->prepare($sentencia_sql);
        $sentencia->bindValue(1, $id_moto, PDO::PARAM_INT);
        $sentencia->execute();
    }
}
?> 
