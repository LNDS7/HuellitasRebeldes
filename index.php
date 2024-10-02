<?php
session_start();
if (!defined('URL')) define('URL', 'http://localhost/ProyectoHuellitasRebeldes1/');


// Modelos
require_once("Model/usuarioModel.php");
require_once("Model/diagnosticoModel.php");
require_once("Model/consultaModel.php");
require_once("Model/CitaModel.php");
require_once("Model/VeterinarioModel.php");
require_once("Model/ClienteModel.php");
require_once("Model/MascotaModel.php");

// Controladores
require_once("Controller/diagnosticoController.php");
require_once("Controller/consultaController.php");
require_once("Controller/conexion.php");
require_once("Controller/CitaController.php");
require_once("Controller/mascotaController.php");
require_once("Controller/VeterinarioController.php");
require_once("Controller/usuarioController.php");
require_once("Controller/contenido.php");
require_once("Controller/ClienteController.php");

$conexionController = new Contenido();

// Verificar nivel de sesión

if (isset($_SESSION["usuario"])) {
    if ($_SESSION["nivel"] == "admin") {
        require_once("View/admin/index.php");
    } elseif ($_SESSION["nivel"] == "ayudante") {
        require_once("View/ayudante/index.php");
    }else {
        require_once("View/usuario/index.php");
    }
} else {
    require_once("View/login.php");
}
