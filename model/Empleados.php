<?php
class Empleados extends Conexion {

    public function get_roles($tabla){
        $conexion= parent::conexion();

        $sql="SELECT * FROM ".$tabla; 
        $sql=$conexion->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function get_empleados(){

        
        $conexion= parent::conexion();

        $sql="SELECT
        e.id,
        e.nombre,
        e.email,
        e.sexo,
        e.boletin,
        e.descripcion,
        a.nombre AS area
        FROM
        empleado e
        LEFT JOIN areas a ON
        a.id = e.area_id ";
        $sql=$conexion->prepare($sql);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function insertar_empleado($nombre,$email,$sexo,$area_id,$boletin,$descripcion){
        $conexion= parent::conexion();

        $sql="INSERT INTO empleado VALUES(null,?,?,?,?,?,?)";
        $sql=$conexion->prepare($sql);
        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $email);
        $sql->bindValue(3, $sexo);
        $sql->bindValue(4, $area_id);
        $sql->bindValue(5, $boletin);
        $sql->bindValue(6, $descripcion);
        $sql->execute();

        return $resultado=$conexion->lastInsertId();
    }

    public function insertar_roles($empleado_id ,$rol_id){
        $conexion= parent::conexion();

        $sql="INSERT INTO empleado_rol VALUES(?,?)";
        $sql=$conexion->prepare($sql);
        $sql->bindValue(1, $empleado_id);
        $sql->bindValue(2, $rol_id);
        $sql->execute();
    }

    public function actualizar_empleado($nombre,$email,$sexo,$area_id,$boletin,$descripcion,$id){
        $conexion= parent::conexion();
        $sql="UPDATE empleado SET
        nombre=?,
        email=?,
        sexo=?,
        area_id=?,
        boletin=?,
        descripcion=?
        WHERE
        id=?";
        $sql=$conexion->prepare($sql);
        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $email);
        $sql->bindValue(3, $sexo);
        $sql->bindValue(4, $area_id);
        $sql->bindValue(5, $boletin);
        $sql->bindValue(6, $descripcion);
        $sql->bindValue(7, $id);
        $sql->execute();
    }

    public function eliminar_empleado($id){
        $conexion= parent::conexion();
        $sql="DELETE FROM empleado  WHERE id=?";
        $sql=$conexion->prepare($sql);
        $sql->bindValue(1, $id);
        $sql->execute();
    }

    public function eliminar_empleado_rol($id){
        $conexion= parent::conexion();
        $sql="DELETE FROM empleado_rol  WHERE empleado_id =?";
        $sql=$conexion->prepare($sql);
        $sql->bindValue(1, $id);
        $sql->execute();
    }

    public function obtener_empleado($id){
        $conexion= parent::conexion();
        $sql="SELECT
        e.id,
        e.nombre,
        e.email,
        e.sexo,
        e.boletin,
        e.descripcion,
        e.area_id,
        a.nombre AS area
        FROM
        empleado e
        LEFT JOIN areas a ON
        a.id = e.area_id WHERE e.id=?";
        $sql=$conexion->prepare($sql);
        $sql->bindValue(1, $id);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

    public function obtener_empleado_rol($id){
        $conexion= parent::conexion();
        $sql="SELECT * FROM empleado_rol er 
        LEFT JOIN roles r ON r.id = er.rol_id 
        WHERE er.empleado_id =?";
        $sql=$conexion->prepare($sql);
        $sql->bindValue(1, $id);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }

}
?>
