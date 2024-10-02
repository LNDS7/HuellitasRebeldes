<?php

class Consulta {
    private $idConsulta;
    private $fecha;
    private $idCita;
    private $descripcion;
    private $observaciones;

    // Constructor
    public function __construct($idConsulta="", $fecha="", $idCita="", $descripcion="", $observaciones="") {
        $this->idConsulta = $idConsulta;
        $this->fecha = $fecha;
        $this->idCita = $idCita;
        $this->descripcion = $descripcion;
        $this->observaciones = $observaciones;
    }

    // Métodos GET
    public function getIdConsulta() {
        return $this->idConsulta;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getIdCita() {
        return $this->idCita;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getObservaciones() {
        return $this->observaciones;
    }

    // Métodos SET
    public function setIdConsulta($idConsulta) {
        $this->idConsulta = $idConsulta;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function setIdCita($idCita) {
        $this->idCita = $idCita;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function setObservaciones($observaciones) {
        $this->observaciones = $observaciones;
    }
}