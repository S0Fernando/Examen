<?php
require_once("../config/sesiones.php");
require_once("../models/Categorias.models.php");

class CategoriasController {
    private $modelo;

    public function __construct() {
        $this->modelo = new Categorias();
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

    public function uno($idCategoria) {
        try {
            if (!isset($idCategoria)) {
                throw new Exception('ID de categoría no proporcionado');
            }
            $datos = $this->modelo->uno($idCategoria);
            $res = mysqli_fetch_assoc($datos);
            echo json_encode($res);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function insertar($nombre_categoria) {
        try {
            if (!isset($nombre_categoria)) {
                throw new Exception('Nombre de categoría no proporcionado');
            }
            $datos = $this->modelo->Insertar($nombre_categoria);
            echo json_encode($datos);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function actualizar($idCategoria, $nombre_categoria) {
        try {
            if (!isset($idCategoria, $nombre_categoria)) {
                throw new Exception('Datos insuficientes para actualizar categoría');
            }
            $datos = $this->modelo->Actualizar($idCategoria, $nombre_categoria);
            echo json_encode($datos);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function eliminar($idCategoria) {
        try {
            if (!isset($idCategoria)) {
                throw new Exception('ID de categoría no proporcionado');
            }
            $datos = $this->modelo->Eliminar($idCategoria);
            echo json_encode($datos);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}

$controller = new CategoriasController();

try {
    if (!isset($_GET["op"])) {
        throw new Exception('Operación no proporcionada');
    }

    switch ($_GET["op"]) {
        case 'todos':
            $controller->todos();
            break;
        case 'uno':
            if (!isset($_POST["idCategoria"])) {
                throw new Exception('ID de categoría no proporcionado');
            }
            $controller->uno($_POST["idCategoria"]);
            break;
        case 'insertar':
            if (!isset($_POST["nombre_categoria"])) {
                throw new Exception('Nombre de categoría no proporcionado');
            }
            $controller->insertar($_POST["nombre_categoria"]);
            break;
        case 'actualizar':
            if (!isset($_POST["idCategoria"], $_POST["nombre_categoria"])) {
                throw new Exception('Datos insuficientes para actualizar categoría');
            }
            $controller->actualizar($_POST["idCategoria"], $_POST["nombre_categoria"]);
            break;
        case 'eliminar':
            if (!isset($_POST["idCategoria"])) {
                throw new Exception('ID de categoría no proporcionado');
            }
            $controller->eliminar($_POST["idCategoria"]);
            break;
        default:
            throw new Exception('Operación no válida');
    }
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
