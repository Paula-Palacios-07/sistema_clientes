<!-- para los iconos -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<?php
include_once 'controllers/ClienteController.php';
include_once 'includes/helpers.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'home';

switch ($action) {
    case 'home':
        include 'views/home.php';
        break;

    case 'create':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller = new ClienteController();
            if ($controller->create($_POST['cedula'], $_POST['nombres'], $_POST['apellidos'], $_POST['direccion'], $_POST['latitud'], $_POST['longitud'])) {
                header("Location: index.php?action=list");
                exit;
            } else {
                echo "Error al guardar el cliente";
            }
        } else {
            include 'views/create.php';
        }
        break;

    case 'update':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller = new ClienteController();
            if ($controller->update($_GET['id'], $_POST['cedula'], $_POST['nombres'], $_POST['apellidos'], $_POST['direccion'], $_POST['latitud'], $_POST['longitud'])) {
                header("Location: index.php?action=list");
                exit;
            } else {
                echo "Error al actualizar el cliente";
            }
        } else {
            echo "Método no permitido.";
        }
        break;

        case 'list_by_distance': //Listar clientes por distancia
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $lat = $_POST['latitud'];
                $lon = $_POST['longitud'];
                if (!empty($lat) && !empty($lon)) {
                    $controller = new ClienteController();
                    $clientes = $controller->listByDistance($lat, $lon);
                    include 'views/list.php';
                } else {
                    // Mostrar una alerta si la latitud o longitud están vacías
                    $error_message = "Por favor seleccione una ubicación en el mapa para calcular las distancias. Haga clic en el mapa para seleccionar un punto.";
                    include 'views/list.php';
                }
            } else {
                header("Location: index.php?action=list");
                exit;
            }
            break;
        

    case 'list':
        $controller = new ClienteController();
        $clientes = $controller->readAll();
        include 'views/list.php';
        break;

    case 'edit':
        if (isset($_GET['id'])) {
            include 'views/edit.php';
        } else {
            echo "Cliente no encontrado.";
        }
        break;

    case 'delete':
        if (isset($_GET['id'])) {
            $controller = new ClienteController();
            if ($controller->delete($_GET['id'])) {
                header("Location: index.php?action=list");
                exit;
            } else {
                echo "Error al eliminar el cliente";
            }
        }
        break;

    default:
        include 'views/home.php';
        break;
}
?>
