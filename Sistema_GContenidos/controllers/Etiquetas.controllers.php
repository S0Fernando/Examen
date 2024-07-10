<?php
require_once("../config/sesiones.php");
require_once("../models/Etiquetas.models.php");

class EtiquetasController {
    private $modelo;

    public function __construct() {
        $this->modelo = new Etiquetas();
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

    public function uno($idEtiqueta) {
        try {
            if (!isset($idEtiqueta)) {
                throw new Exception('ID de etiqueta no proporcionado');
            }
            $datos = $this->modelo->uno($idEtiqueta);
            $res = mysqli_fetch_assoc($datos);
            echo json_encode($res);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function insertar($nombre_etiqueta) {
        try {
            if (!isset($nombre_etiqueta)) {
                throw new Exception('Nombre de etiqueta no proporcionado');
            }
            $datos = $this->modelo->Insertar($nombre_etiqueta);
            echo json_encode($datos);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function actualizar($idEtiqueta, $nombre_etiqueta) {
        try {
            if (!isset($idEtiqueta, $nombre_etiqueta)) {
                throw new Exception('Datos insuficientes para actualizar etiqueta');
            }
            $datos = $this->modelo->Actualizar($idEtiqueta, $nombre_etiqueta);
            echo json_encode($datos);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function eliminar($idEtiqueta) {
        try {
            if (!isset($idEtiqueta)) {
                throw new Exception('ID de etiqueta no proporcionado');
            }
            $datos = $this->modelo->Eliminar($idEtiqueta);
            echo json_encode($datos);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}

$controller = new EtiquetasController();

try {
    if (!isset($_GET["op"])) {
        throw new Exception('Operación no proporcionada');
    }

    switch ($_GET["op"]) {
        case 'todos':
            $controller->todos();
            break;
        case 'uno':
            if (!isset($_POST["idEtiqueta"])) {
                throw new Exception('ID de etiqueta no proporcionado');
            }
            $controller->uno($_POST["idEtiqueta"]);
            break;
        case 'insertar':
            if (!isset($_POST["nombre_etiqueta"])) {
                throw new Exception('Nombre de etiqueta no proporcionado');
            }
            $controller->insertar($_POST["nombre_etiqueta"]);
            break;
        case 'actualizar':
            if (!isset($_POST["idEtiqueta"], $_POST["nombre_etiqueta"])) {
                throw new Exception('Datos insuficientes para actualizar etiqueta');
            }
            $controller->actualizar($_POST["idEtiqueta"], $_POST["nombre_etiqueta"]);
            break;
        case 'eliminar':
            if (!isset($_POST["idEtiqueta"])) {
                throw new Exception('ID de etiqueta no proporcionado');
            }
            $controller->eliminar($_POST["idEtiqueta"]);
            break;
        default:
            throw new Exception('Operación no válida');
    }
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
