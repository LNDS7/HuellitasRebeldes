<?php

require_once("conexion.php");

class Usuario_controller extends Conexion {

    // Método para iniciar sesión
    public function login($usuario) {
        $sql = "SELECT * FROM usuario WHERE loginusuario=? AND clave=?";
        $stmt = $this->cn()->prepare($sql);
        
        if ($stmt === false) {
            die('Error al preparar la consulta: ' . $this->cn()->error);
        }

        $loginusuario = $usuario->getLoginusuario();
        $clave = $usuario->getClave();
        
        $stmt->bind_param("ss", $loginusuario, $clave);
        $stmt->execute();
        $rs = $stmt->get_result();
        
        $respuesta = array();

        while ($fila = $rs->fetch_assoc()) {
            $respuesta[] = new Usuario($fila["loginusuario"], $fila["nom_usuario"], $fila["email"], $fila["clave"], $fila["rol"]); // Cambiado a $fila["rol"]
        }
        
        $stmt->close();
        
        return $respuesta;
    }

    // Método para agregar un nuevo usuario
    public function agregar($user) {
        $sql = "INSERT INTO usuario (loginusuario, nom_usuario, email, clave, rol) 
                VALUES (?, ?, ?, ?, ?)"; // Cambiado a rol

        $conn = $this->cn();
        
        if ($conn === null) {
            die('Error al obtener la conexión a la base de datos.');
        }
        
        $stmt = $conn->prepare($sql);
        
        if ($stmt === false) {
            die('Error al preparar la consulta: ' . $conn->error);
        }
    
        $loginusuario = $user->getLoginusuario();
        $nom_usuario = $user->getNomUsuario();
        $email = $user->getEmail();
        $clave = $user->getClave();
        $rol = $user->getRol(); // Cambiado a getRol
    
        $stmt->bind_param("ssssi", $loginusuario, $nom_usuario, $email, $clave, $rol);
    
        $resultado = $stmt->execute();
        
        $stmt->close();
    
        return $resultado;
    }

    // Método para obtener un usuario por loginusuario
    public function obtenerUsuarioPorLogin($loginusuario) {
        // Consulta para obtener el usuario por su login
        $sql = "SELECT * FROM usuario WHERE loginusuario = ?";
        
        // Preparar la consulta
        $stmt = $this->cn()->prepare($sql);
        
        if ($stmt === false) {
            die('Error al preparar la consulta: ' . $this->cn()->error);
        }
        
        // Enlazar el parámetro
        $stmt->bind_param("s", $loginusuario);
        
        // Ejecutar la consulta
        $stmt->execute();
        
        // Obtener el resultado
        $rs = $stmt->get_result();
        
        // Verificar si se encontró un usuario
        if ($rs->num_rows > 0) {
            // Obtener los datos del usuario
            $fila = $rs->fetch_assoc();
            
            // Retornar una instancia de Usuario con los datos
            $usuario = new Usuario($fila["loginusuario"], $fila["nom_usuario"], $fila["email"], $fila["clave"], $fila["rol"]); // Cambiado a $fila["rol"]
            
            // Cerrar la declaración
            $stmt->close();
            
            // Retornar el objeto Usuario
            return $usuario;
        } else {
            // No se encontró el usuario, cerrar la declaración
            $stmt->close();
            
            // Retornar null si no se encontró el usuario
            return null;
        }
    }
}
?>
