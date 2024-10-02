<?php
require_once("conexion.php");

class ClientesController extends Conexion
{
    public function insertarclientes($cliente)
    {
        $sql = "INSERT INTO dueno (nombre, apellido, direccion, telefono, email) 
                VALUES (?, ?, ?, ?, ?)";
        
        // Preparar la consulta
        $stmt = $this->cn()->prepare($sql);
        
        if ($stmt === false) {
            // Si falla la preparación de la consulta
            die('Error al preparar la consulta: ' . $this->cn()->error);
        }
        
        // Obtener los valores del cliente
        $nombre = $cliente->getNombre();
        $apellido = $cliente->getApellido();
        $direccion = $cliente->getDireccion();
        $telefono = $cliente->getTelefono();
        $email = $cliente->getEmail();
        
        // Vincular los parámetros de la consulta
        $stmt->bind_param("sssss", $nombre, $apellido, $direccion, $telefono, $email);
        
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
    

    public function actualizarCliente($id, $cliente)
    {
        $sql = "UPDATE dueno SET 
                nombre = '".$cliente->getNombre()."', 
                apellido = '".$cliente->getApellido()."', 
                direccion = '".$cliente->getDireccion()."', 
                telefono = '".$cliente->getTelefono()."', 
                email = '".$cliente->getEmail()."' 
                WHERE idDueno = $id";
        return $this->ejecutarSQL($sql);
    }

    public function eliminarCliente($id)
    {
        $sql = "DELETE FROM dueno WHERE idDueno = $id";
        return $this->ejecutarSQL($sql);
    }

    public function TotalClientes()
    {
        $resultado = array();
        $sql = "SELECT COUNT(DISTINCT idDueno) AS total FROM dueno";
        $rs = $this->ejecutarSQL($sql);
        while ($fila = $rs->fetch_assoc()) {
            $resultado[] = $fila;
        }
        return $resultado;
    }

    public function listarCliente()
    {
        $resultado = array();
        $sql = "SELECT * FROM dueno";
        $rs = $this->ejecutarSQL($sql);
        while ($fila = $rs->fetch_assoc()) {
            $resultado[] = $fila;
        }
        return $resultado;
    }
}
?>
