<?php

date_default_timezone_set('America/El_Salvador');

if(!defined('SERVIDOR')) define('SERVIDOR', 'localhost');
if(!defined('USUARIO')) define('USUARIO', 'root');
if(!defined('CLAVE')) define('CLAVE', '');
if(!defined('DATABASE')) define('DATABASE', 'huellitas');

class Conexion {
    private $connect;

    public function __construct() {
        $this->connect = new mysqli(SERVIDOR, USUARIO, CLAVE, DATABASE);

        if ($this->connect->connect_error) {
            die("Conexión fallida: " . $this->connect->connect_error);
        }
    }

    public function cn() {
        return $this->connect;
    }

    public function ejecutarSQL($sql) {
        return $this->cn()->query($sql);
    }
}

?>
