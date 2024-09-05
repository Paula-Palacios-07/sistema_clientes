<?php
include_once 'dao/ClienteDAO.php';
include_once 'dto/ClienteDTO.php';
include_once 'includes/helpers.php';

class ClienteController {
    private $clienteDAO;

    public function __construct() {
        $this->clienteDAO = ClienteDAO::getInstance();
    }

    public function create($cedula, $nombres, $apellidos, $direccion, $latitud, $longitud) {
        $cliente = new ClienteDTO($cedula, $nombres, $apellidos, $direccion, $latitud, $longitud);
        return $this->clienteDAO->create($cliente);
    }

    public function readAll() {
        return $this->clienteDAO->readAll();
    }

    public function update($id, $cedula, $nombres, $apellidos, $direccion, $latitud, $longitud) {
        $cliente = new ClienteDTO($cedula, $nombres, $apellidos, $direccion, $latitud, $longitud, $id);
        return $this->clienteDAO->update($cliente);
    }

    public function delete($id) {
        return $this->clienteDAO->delete($id);
    }

    public function getClienteById($id) {
        return $this->clienteDAO->getClienteById($id);
    }

    //listar clientes por distancia
    public function listByDistance($lat, $lon) {
        $clientes = $this->clienteDAO->readAll();
        $clientesWithDistance = [];

        // Calcular la distancia de cada cliente al punto dado
        while ($cliente = $clientes->fetch(PDO::FETCH_ASSOC)) {
            $distance = calculateDistance($lat, $lon, $cliente['latitud'], $cliente['longitud']);
            $cliente['distance'] = $distance;
            $clientesWithDistance[] = $cliente;
        }

        // Ordenar los clientes por distancia
        usort($clientesWithDistance, function ($a, $b) {
            return $a['distance'] <=> $b['distance'];
        });

        return $clientesWithDistance;
    }
}
?>
