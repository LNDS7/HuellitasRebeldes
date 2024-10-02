<?php

class Cita {
    private $idCita;
    private $idVeterinario;
    private $idMascota;
    private $fecha;
    private $hora;
    private $razonCita;

    public function __construct($idCita="", $idVeterinario="", $idMascota="", $fecha="", $hora="", $razonCita="") {
        $this->idCita = $idCita;
        $this->idVeterinario = $idVeterinario;
        $this->idMascota = $idMascota;
        $this->fecha = $fecha;
        $this->hora = $hora;
        $this->razonCita = $razonCita;
    }

    // Getter y Setter para idCita
    public function getIdCita() {
        return $this->idCita;
    }

    public function setIdCita($idCita) {
        $this->idCita = $idCita;
    }

    // Getter y Setter para idVeterinario
    public function getIdVeterinario() {
        return $this->idVeterinario;
    }

    public function setIdVeterinario($idVeterinario) {
        $this->idVeterinario = $idVeterinario;
    }

    // Getter y Setter para idMascota
    public function getIdMascota() {
        return $this->idMascota;
    }

    public function setIdMascota($idMascota) {
        $this->idMascota = $idMascota;
    }

    // Getter y Setter para fecha
    public function getFecha() {
        return $this->fecha;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    // Getter y Setter para hora
    public function getHora() {
        return $this->hora;
    }

    public function setHora($hora) {
        $this->hora = $hora;
    }

    // Getter y Setter para razonCita
    public function getRazonCita() {
        return $this->razonCita;
    }

    public function setRazonCita($razonCita) {
        $this->razonCita = $razonCita;
    }
}
