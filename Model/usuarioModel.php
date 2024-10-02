<?php

class Usuario {
    private $loginusuario;
    private $nom_usuario;
    private $email;
    private $clave;
    private $rol; // Cambiado de administrador a rol

    // Constructor con valores por defecto
    public function __construct($loginusuario = "", $nom_usuario = "", $email = "", $clave = "", $rol = 0) {
        $this->loginusuario = $loginusuario;
        $this->nom_usuario = $nom_usuario;
        $this->email = $email;
        $this->clave = $clave;
        $this->rol = $rol; // Inicializa el rol
    }

    // Getters y Setters
    public function getLoginusuario() {
        return $this->loginusuario;
    }

    public function setLoginusuario($loginusuario) {
        $this->loginusuario = $loginusuario;
    }

    public function getNomUsuario() {
        return $this->nom_usuario;
    }

    public function setNomUsuario($nom_usuario) {
        $this->nom_usuario = $nom_usuario;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getClave() {
        return $this->clave;
    }

    public function setClave($clave) {
        $this->clave = $clave;
    }

    // Cambiado de esAdministrador a getRol
    public function getRol() {
        return $this->rol;
    }

    // Cambiado de setAdministrador a setRol
    public function setRol($rol) {
        $this->rol = $rol;
    }
}

?>
