<?php
require_once("../config/sesiones.php");
require_once("../models/Usuarios.models.php");

class UsuariosController {
    private $modelo;

    public function __construct() {
        $this->modelo = new Usuarios();
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

    public function uno($idUsuario) {
        try {
            if (!isset($idUsuario)) {
                throw new Exception('ID de usuario no proporcionado');
            }
            $datos = $this->modelo->uno($idUsuario);
            $res = mysqli_fetch_assoc($datos);
            echo json_encode($res);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function insertar($nombre, $apellido, $correo_electronico) {
        try {
            if (!isset($nombre, $apellido, $correo_electronico)) {
                throw new Exception('Datos insuficientes para insertar usuario');
            }
            $datos = $this->modelo->Insertar($nombre, $apellido, $correo_electronico);
            echo json_encode($datos);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function actualizar($idUsuario, $nombre, $apellido, $correo_electronico) {
        try {
            if (!isset($idUsuario, $nombre, $apellido, $correo_electronico)) {
                throw new Exception('Datos insuficientes para actualizar usuario');
            }
            $datos = $this->modelo->Actualizar($idUsuario, $nombre, $apellido, $correo_electronico);
            echo json_encode($datos);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function eliminar($idUsuario) {
        try {
            if (!isset($idUsuario)) {
                throw new Exception('ID de usuario no proporcionado');
            }
            $datos = $this->modelo->Eliminar($idUsuario);
            echo json_encode($datos);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}

$controller = new UsuariosController();

try {
    if (!isset($_GET["op"])) {
        throw new Exception('Operación no proporcionada');
    }

    switch ($_GET["op"]) {
        case 'todos':
            $controller->todos();
            break;
        case 'uno':
            if (!isset($_POST["idUsuario"])) {
                throw new Exception('ID de usuario no proporcionado');
            }
            $controller->uno($_POST["idUsuario"]);
            break;
        case 'insertar':
            if (!isset($_POST["nombre"], $_POST["apellido"], $_POST["correo_electronico"])) {
                throw new Exception('Datos insuficientes para insertar usuario');
            }
            $controller->insertar($_POST["nombre"], $_POST["apellido"], $_POST["correo_electronico"]);
            break;
        case 'actualizar':
            if (!isset($_POST["idUsuario"], $_POST["nombre"], $_POST["apellido"], $_POST["correo_electronico"])) {
                throw new Exception('Datos insuficientes para actualizar usuario');
            }
            $controller->actualizar($_POST["idUsuario"], $_POST["nombre"], $_POST["apellido"], $_POST["correo_electronico"]);
            break;
        case 'eliminar':
            if (!isset($_POST["idUsuario"])) {
                throw new Exception('ID de usuario no proporcionado');
            }
            $controller->eliminar($_POST["idUsuario"]);
            break;
        default:
            throw new Exception('Operación no válida');
    }
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
