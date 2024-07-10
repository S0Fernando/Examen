<?php
require_once('../config/conexion.php');

class Categorias
{
    public function todos()
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "SELECT * FROM Categorias";
        $datos = mysqli_query($con, $cadena);
        return $datos;
        $con->close();
    }

    public function uno($idCategoria)
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "SELECT * FROM Categorias WHERE id_categoria = $idCategoria";
        $datos = mysqli_query($con, $cadena);
        return $datos;
        $con->close();
    }

    public function Insertar($nombre_categoria)
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "INSERT INTO Categorias(nombre_categoria) VALUES ('$nombre_categoria')";
        if (mysqli_query($con, $cadena)) {
            return mysqli_insert_id($con);
        } else {
            return 'Error al insertar en la base de datos';
        }
        $con->close();
    }

    public function Actualizar($idCategoria, $nombre_categoria)
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "UPDATE Categorias SET nombre_categoria='$nombre_categoria' WHERE id_categoria = $idCategoria";
        if (mysqli_query($con, $cadena)) {
            return $idCategoria;
        } else {
            return 'Error al actualizar el registro';
        }
        $con->close();
    }

    public function Eliminar($idCategoria)
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "DELETE FROM Categorias WHERE id_categoria = $idCategoria";
        if (mysqli_query($con, $cadena)) {
            return true;
        } else {
            return false;
        }
        $con->close();
    }
}