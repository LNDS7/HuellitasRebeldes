<?php

class Diagnostico {
    private $idDiagnostico;
    private $descripcion;
    private $idConsulta;

    // Constructor
    public function __construct($idDiagnostico="", $descripcion="", $idConsulta="") {
        $this->idDiagnostico = $idDiagnostico;
        $this->descripcion = $descripcion;
        $this->idConsulta = $idConsulta;
    }

    // Métodos GET
    public function getIdDiagnostico() {
        return $this->idDiagnostico;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getIdConsulta() {
        return $this->idConsulta;
    }

    // Métodos SET
    public function setIdDiagnostico($idDiagnostico) {
        $this->idDiagnostico = $idDiagnostico;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function setIdConsulta($idConsulta) {
        $this->idConsulta = $idConsulta;
    }
}
