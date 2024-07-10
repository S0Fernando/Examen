<?php
require_once('../config/conexion.php');

class Usuarios
{
    public function todos()
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "SELECT * FROM Usuarios";
        $datos = mysqli_query($con, $cadena);
        return $datos;
        $con->close();
    }

    public function uno($idUsuario)
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "SELECT * FROM Usuarios WHERE id_usuario = $idUsuario";
        $datos = mysqli_query($con, $cadena);
        return $datos;
        $con->close();
    }

    public function Insertar($nombre, $apellido, $correo_electronico)
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "INSERT INTO Usuarios(nombre, apellido, correo_electronico) VALUES ('$nombre', '$apellido', '$correo_electronico')";
        if (mysqli_query($con, $cadena)) {
            return mysqli_insert_id($con);
        } else {
            return 'Error al insertar en la base de datos';
        }
        $con->close();
    }

    public function Actualizar($idUsuario, $nombre, $apellido, $correo_electronico)
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "UPDATE Usuarios SET nombre='$nombre', apellido='$apellido', correo_electronico='$correo_electronico' WHERE id_usuario = $idUsuario";
        if (mysqli_query($con, $cadena)) {
            return $idUsuario;
        } else {
            return 'Error al actualizar el registro';
        }
        $con->close();
    }

    public function Eliminar($idUsuario)
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "DELETE FROM Usuarios WHERE id_usuario = $idUsuario";
        if (mysqli_query($con, $cadena)) {
            return true;
        } else {
            return false;
        }
        $con->close();
    }
}