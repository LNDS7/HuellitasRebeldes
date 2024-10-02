<?php

class Contenido
{
    public function mostrar_archivo()
    {

        $pagina = "";
        $url = isset($_GET["url"]) ? $_GET["url"] : null;
        @$url = explode('/', $url);
        var_dump($_SESSION["nivel"]);
        var_dump($url);

        if (isset($_SESSION["usuario"])) {
            if ($_SESSION["nivel"] == "admin") {
                $pagina = $this->cargarVistaAdmin($url);
            }else if ($_SESSION["nivel"] == "ayudante") {
                $pagina = $this->cargarVistaAyudante($url);
            } else {
                $pagina = $this->cargarVistaUsuario($url);
            }
        } else {
            require_once("View/login.php");
        }

        var_dump($pagina);
        return $pagina;
    }

    public function cargarVistaAdmin($url)
    {
        // Cargar vistas del administrador
        
        switch ($url[0]) {
            case "":
                return "View/admin/Inicio/inicio.php";
            case "Inicio":
                return "View/admin/Inicio/inicio.php";
            case "Registro":
                return "View/admin/Registro/registro.php";
            case "Veterinarios":
                return "View/admin/Veterinarios/veterinarios.php";
            case "Mascotas":
                return "View/admin/Mascotas/mascotas.php";
            case "Clientes":
                return "View/admin/Clientes/clientes.php";
            case "Citas":
                return "View/admin/Cita/citas.php";
            case "Aprobadas":
                return "View/admin/Aprobadas/Aprobadas.php";
            case "Diagnostico":
                return "View/admin/Diagnostico/diagnostico.php";
            case "Cerrar_Sesion":
                return "View/cerrar/cerrar.php";
            default:
            return "View/e404.php"; // Página de error si no coincide
        }
    }

    public function cargarVistaUsuario($url)
    {
        // Cargar vistas del usuario normal
        switch ($url[0]) {
            case "":
                return "View/usuario/Inicio/inicio.php";
            case "Inicio":
                return "View/usuario/Inicio/inicio.php";
            case "Registro":
                return "View/usuario/Registro/registro.php";
            case "Veterinarios":
                return "View/usuario/Veterinarios/veterinarios.php";
            case "Mascotas":
                return "View/usuario/Mascotas/mascotas.php";
            case "Clientes":
                return "View/usuario/Clientes/clientes.php";
            case "Citas":
                return "View/usuario/Cita/citas.php";
            case "Aprobadas":
                return "View/usuario/Aprobadas/Aprobadas.php";
            case "Diagnostico":
                return "View/usuario/Diagnostico/diagnostico.php";
            case "Cerrar_Sesion":
                return "View/cerrar/cerrar.php";
            default:
                return "View/e404.php"; // Página de error si no coincide
        }
    }

    public function cargarVistaAyudante($url)
    {
        // Cargar vistas del usuario normal
        switch ($url[0]) {
            case "":
                return "View/ayudante/Inicio/inicio.php";
            case "Inicio":
                return "View/ayudante/Inicio/inicio.php";
            case "Registro":
                return "View/ayudante/Registro/registro.php";
            case "Veterinarios":
                return "View/ayudante/Veterinarios/veterinarios.php";
            case "Mascotas":
                return "View/ayudante/Mascotas/mascotas.php";
            case "Clientes":
                return "View/ayudante/Clientes/clientes.php";
            case "Citas":
                return "View/ayudante/Cita/citas.php";
            case "Aprobadas":
                return "View/ayudante/Aprobadas/Aprobadas.php";
            case "Diagnostico":
                return "View/ayudante/Diagnostico/diagnostico.php";
            case "Cerrar_Sesion":
                return "View/cerrar/cerrar.php";
            default:
            return "View/e404.php"; // Página de error si no coincide
        }
    }
}
