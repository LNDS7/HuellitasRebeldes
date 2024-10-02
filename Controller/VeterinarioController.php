<?php
require_once("conexion.php");

class VeterinarioController extends Conexion
{
    // Insertar Veterinario
    public function insertarVeterinario($veterinario)
    {
        $sql = "INSERT INTO veterinario (nombre, apellido, especialidad, telefono, email) 
                VALUES (?, ?, ?, ?, ?)";
        
        // Preparar la consulta
        $stmt = $this->cn()->prepare($sql);
        
        if ($stmt === false) {
            // Si falla la preparación de la consulta
            die('Error al preparar la consulta: ' . $this->cn()->error);
        }
        
        // Obtener los valores del veterinario
        $nombre = $veterinario->getNombre();
        $apellido = $veterinario->getApellido();
        $especialidad = $veterinario->getEspecialidad();
        $telefono = $veterinario->getTelefono();
        $email = $veterinario->getEmail();
        
        // Vincular los parámetros de la consulta
        $stmt->bind_param("sssss", $nombre, $apellido, $especialidad, $telefono, $email);
        
        // Ejecutar la consulta
        $stmt->execute();
        
        // Verificar si se insertó correctamente
        if ($stmt->affected_rows > 0) {
            $stmt->close();
            return true; // Éxito al insertar
        } else {
            $stmt->close();
            return false; // Error al insertar
        }
    }
    

    // Actualizar Veterinario
    public function actualizarveterinario($id, $veterinario)
    {
        $sql = "UPDATE veterinario SET 
                nombre = '".$veterinario->getNombre()."', 
                apellido = '".$veterinario->getApellido()."', 
                especialidad = '".$veterinario->getEspecialidad()."', 
                telefono = '".$veterinario->getTelefono()."', 
                email = '".$veterinario->getEmail()."' 
                WHERE idVeterinario = $id";
        return $this->ejecutarSQL($sql);
    }

    // Eliminar Veterinario
        public function eliminarVeterinario($id)
    {
        $sql = "DELETE FROM veterinario WHERE idVeterinario = $id";
        return $this->ejecutarSQL($sql);
    }

    // Listar Veterinarios
    public function listarVeterinarios()
    {
        $sql = "SELECT * FROM veterinario";
        $result = $this->cn()->query($sql);
        
        $veterinarios = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $veterinarios[] = $row;
            }
        }
        
        return $veterinarios;
    }

    public function TotalVeterinario()
    {
        $sql = "SELECT COUNT(DISTINCT idVeterinario) AS total FROM veterinario;
";
        $result = $this->cn()->query($sql);
        
        $veterinarios = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $veterinarios[] = $row;
            }
        }
        
        return $veterinarios;
    }
}
?>
