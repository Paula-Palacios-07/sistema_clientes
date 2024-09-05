<?php
include_once 'config/database.php';
include_once 'dto/ClienteDTO.php';

class ClienteDAO {
    private $conn;
    private $table_name = "clientes";
    private static $instance = null;

    private function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new ClienteDAO();
        }
        return self::$instance;
    }

    //CRUD

    public function create(ClienteDTO $cliente) {
        $query = "INSERT INTO " . $this->table_name . " SET cedula=:cedula, nombres=:nombres, apellidos=:apellidos, direccion=:direccion, latitud=:latitud, longitud=:longitud";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":cedula", $cliente->getCedula());
        $stmt->bindParam(":nombres", $cliente->getNombres());
        $stmt->bindParam(":apellidos", $cliente->getApellidos());
        $stmt->bindParam(":direccion", $cliente->getDireccion());
        $stmt->bindParam(":latitud", $cliente->getLatitud());
        $stmt->bindParam(":longitud", $cliente->getLongitud());

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function readAll() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function update(ClienteDTO $cliente) {
        $query = "UPDATE " . $this->table_name . " SET cedula=:cedula, nombres=:nombres, apellidos=:apellidos, direccion=:direccion, latitud=:latitud, longitud=:longitud WHERE id=:id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":cedula", $cliente->getCedula());
        $stmt->bindParam(":nombres", $cliente->getNombres());
        $stmt->bindParam(":apellidos", $cliente->getApellidos());
        $stmt->bindParam(":direccion", $cliente->getDireccion());
        $stmt->bindParam(":latitud", $cliente->getLatitud());
        $stmt->bindParam(":longitud", $cliente->getLongitud());
        $stmt->bindParam(":id", $cliente->getId());

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function getClienteById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
}
?>
