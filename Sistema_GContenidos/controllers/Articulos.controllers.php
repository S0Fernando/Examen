<?php
require_once("../config/sesiones.php");
require_once("../models/Articulos.models.php");

class ArticulosController {
    private $modelo;

    public function __construct() {
        $this->modelo = new Articulos();
    }

    public function todos() {
        try {
            $datos = $this->modelo->todos();
            $todos = [];
            while ($row = mysqli_fetch_assoc($datos)) {
                $todos[] = $row;
            }
            echo json_encode($todos);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function uno($idArticulo) {
        try {
            if (!isset($idArticulo)) {
                throw new Exception('ID de artículo no proporcionado');
            }
            $datos = $this->modelo->uno($idArticulo);
            $res = mysqli_fetch_assoc($datos);
            echo json_encode($res);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function insertar($titulo, $contenido, $fecha_publicacion, $id_usuario) {
        try {
            if (!isset($titulo, $contenido, $fecha_publicacion, $id_usuario)) {
                throw new Exception('Datos insuficientes para insertar artículo');
            }
            $datos = $this->modelo->Insertar($titulo, $contenido, $fecha_publicacion, $id_usuario);
            echo json_encode($datos);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function actualizar($idArticulo, $titulo, $contenido, $fecha_publicacion, $id_usuario) {
        try {
            if (!isset($idArticulo, $titulo, $contenido, $fecha_publicacion, $id_usuario)) {
                throw new Exception('Datos insuficientes para actualizar artículo');
            }
            $datos = $this->modelo->Actualizar($idArticulo, $titulo, $contenido, $fecha_publicacion, $id_usuario);
            echo json_encode($datos);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function eliminar($idArticulo) {
        try {
            if (!isset($idArticulo)) {
                throw new Exception('ID de artículo no proporcionado');
            }
            $datos = $this->modelo->Eliminar($idArticulo);
            echo json_encode($datos);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}

$controller = new ArticulosController();

try {
    if (!isset($_GET["op"])) {
        throw new Exception('Operación no proporcionada');
    }

    switch ($_GET["op"]) {
        case 'todos':
            $controller->todos();
            break;
        case 'uno':
            if (!isset($_POST["idArticulo"])) {
                throw new Exception('ID de artículo no proporcionado');
            }
            $controller->uno($_POST["idArticulo"]);
            break;
        case 'insertar':
            if (!isset($_POST["titulo"], $_POST["contenido"], $_POST["fecha_publicacion"], $_POST["id_usuario"])) {
                throw new Exception('Datos insuficientes para insertar artículo');
            }
            $controller->insertar($_POST["titulo"], $_POST["contenido"], $_POST["fecha_publicacion"], $_POST["id_usuario"]);
            break;
        case 'actualizar':
            if (!isset($_POST["idArticulo"], $_POST["titulo"], $_POST["contenido"], $_POST["fecha_publicacion"], $_POST["id_usuario"])) {
                throw new Exception('Datos insuficientes para actualizar artículo');
            }
            $controller->actualizar($_POST["idArticulo"], $_POST["titulo"], $_POST["contenido"], $_POST["fecha_publicacion"], $_POST["id_usuario"]);
            break;
        case 'eliminar':
            if (!isset($_POST["idArticulo"])) {
                throw new Exception('ID de artículo no proporcionado');
            }
            $controller->eliminar($_POST["idArticulo"]);
            break;
        default:
            throw new Exception('Operación no válida');
    }
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
