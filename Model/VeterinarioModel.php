<?php

class Veterinario {
    private $id;
    private $nombre;
    private $apellido;
    private $especialidad;
    private $telefono;
    private $email;

    // Constructor
    public function __construct($id = '', $nombre = '', $apellido = '', $especialidad = '', $telefono = '', $email = '') {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->especialidad = $especialidad;
        $this->telefono = $telefono;
        $this->email = $email;
    }

    // Getters y Setters
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getApellido() {
        return $this->apellido;
    }

    public function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    public function getEspecialidad() {
        return $this->especialidad;
    }

    public function setEspecialidad($especialidad) {
        $this->especialidad = $especialidad;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }
}
?>
