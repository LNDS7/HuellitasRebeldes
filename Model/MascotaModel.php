<?php

class Mascota {
    private $idMascota;
    private $nombre;
    private $fechaNacimiento;
    private $dificultades;
    private $otraInformacion;
    private $razaAnimal;
    private $tipoAnimal;
    private $idDueno;

    public function __construct($idMascota="", $nombre="", $fechaNacimiento="", $dificultades="", $otraInformacion="", $razaAnimal="", $tipoAnimal="", $idDueno="") {
        $this->idMascota = $idMascota;
        $this->nombre = $nombre;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->dificultades = $dificultades;
        $this->otraInformacion = $otraInformacion;
        $this->razaAnimal = $razaAnimal;
        $this->tipoAnimal = $tipoAnimal;
        $this->idDueno = $idDueno;
    }

    // Getter y Setter para idMascota
    public function getIdMascota() {
        return $this->idMascota;
    }

    public function setIdMascota($idMascota) {
        $this->idMascota = $idMascota;
    }

    // Getter y Setter para nombre
    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    // Getter y Setter para fechaNacimiento
    public function getFechaNacimiento() {
        return $this->fechaNacimiento;
    }

    public function setFechaNacimiento($fechaNacimiento) {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    // Getter y Setter para dificultades
    public function getDificultades() {
        return $this->dificultades;
    }

    public function setDificultades($dificultades) {
        $this->dificultades = $dificultades;
    }

    // Getter y Setter para otraInformacion
    public function getOtraInformacion() {
        return $this->otraInformacion;
    }

    public function setOtraInformacion($otraInformacion) {
        $this->otraInformacion = $otraInformacion;
    }

    // Getter y Setter para razaAnimal
    public function getRazaAnimal() {
        return $this->razaAnimal;
    }

    public function setRazaAnimal($razaAnimal) {
        $this->razaAnimal = $razaAnimal;
    }

    // Getter y Setter para tipoAnimal
    public function getTipoAnimal() {
        return $this->tipoAnimal;
    }

    public function setTipoAnimal($tipoAnimal) {
        $this->tipoAnimal = $tipoAnimal;
    }

    // Getter y Setter para idDueno
    public function getIdDueno() {
        return $this->idDueno;
    }

    public function setIdDueno($idDueno) {
        $this->idDueno = $idDueno;
    }
}
