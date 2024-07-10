<?php
require_once('../config/conexion.php');

class Etiquetas
{
    public function todos()
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "SELECT * FROM Etiquetas";
        $datos = mysqli_query($con, $cadena);
        return $datos;
        $con->close();
    }

    public function uno($idEtiqueta)
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "SELECT * FROM Etiquetas WHERE id_etiqueta = $idEtiqueta";
        $datos = mysqli_query($con, $cadena);
        return $datos;
        $con->close();
    }

    public function Insertar($nombre_etiqueta)
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "INSERT INTO Etiquetas(nombre_etiqueta) VALUES ('$nombre_etiqueta')";
        if (mysqli_query($con, $cadena)) {
            return mysqli_insert_id($con);
        } else {
            return 'Error al insertar en la base de datos';
        }
        $con->close();
    }

    public function Actualizar($idEtiqueta, $nombre_etiqueta)
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "UPDATE Etiquetas SET nombre_etiqueta='$nombre_etiqueta' WHERE id_etiqueta = $idEtiqueta";
        if (mysqli_query($con, $cadena)) {
            return $idEtiqueta;
        } else {
            return 'Error al actualizar el registro';
        }
        $con->close();
    }

    public function Eliminar($idEtiqueta)
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "DELETE FROM Etiquetas WHERE id_etiqueta = $idEtiqueta";
        if (mysqli_query($con, $cadena)) {
            return true;
        } else {
            return false;
        }
        $con->close();
    }
}