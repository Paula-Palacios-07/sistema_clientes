<?php
class ClienteDTO {
    private $id;
    private $cedula;
    private $nombres;
    private $apellidos;
    private $direccion;
    private $latitud;
    private $longitud;

    public function __construct($cedula, $nombres, $apellidos, $direccion, $latitud, $longitud, $id = null) {
        $this->id = $id;
        $this->cedula = $cedula;
        $this->nombres = $nombres;
        $this->apellidos = $apellidos;
        $this->direccion = $direccion;
        $this->latitud = $latitud;
        $this->longitud = $longitud;
    }

    // Getters y Setters para cada atributo
    public function getId() {
        return $this->id;
    }

    public function getCedula() {
        return $this->cedula;
    }

    public function getNombres() {
        return $this->nombres;
    }

    public function getApellidos() {
        return $this->apellidos;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function getLatitud() {
        return $this->latitud;
    }

    public function getLongitud() {
        return $this->longitud;
    }

}
?>
