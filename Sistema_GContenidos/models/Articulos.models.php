<?php
require_once('../config/conexion.php');

class Articulos
{
    public function todos()
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "SELECT * FROM Articulos";
        $datos = mysqli_query($con, $cadena);
        return $datos;
        $con->close();
    }

    public function uno($idArticulo)
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "SELECT * FROM Articulos WHERE id_articulo = $idArticulo";
        $datos = mysqli_query($con, $cadena);
        return $datos;
        $con->close();
    }

    public function Insertar($titulo, $contenido, $fecha_publicacion, $id_usuario)
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "INSERT INTO Articulos(titulo, contenido, fecha_publicacion, id_usuario) VALUES ('$titulo', '$contenido', '$fecha_publicacion', $id_usuario)";
        if (mysqli_query($con, $cadena)) {
            return mysqli_insert_id($con);
        } else {
            return 'Error al insertar en la base de datos';
        }
        $con->close();
    }

    public function Actualizar($idArticulo, $titulo, $contenido, $fecha_publicacion, $id_usuario)
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "UPDATE Articulos SET titulo='$titulo', contenido='$contenido', fecha_publicacion='$fecha_publicacion', id_usuario=$id_usuario WHERE id_articulo = $idArticulo";
        if (mysqli_query($con, $cadena)) {
            return $idArticulo;
        } else {
            return 'Error al actualizar el registro';
        }
        $con->close();
    }

    public function Eliminar($idArticulo)
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "DELETE FROM Articulos WHERE id_articulo = $idArticulo";
        if (mysqli_query($con, $cadena)) {
            return true;
        } else {
            return false;
        }
        $con->close();
    }
}