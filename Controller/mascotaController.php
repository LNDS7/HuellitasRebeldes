<?php
require_once("conexion.php");

class MascotaController extends Conexion
{
    public function insertarMascota($mascota)
    {
        $sql = "INSERT INTO mascota (nombre, fechaNacimiento, dificultades, otraInformacion, razaAnimal, tipoAnimal, idDueno) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->cn()->prepare($sql);

        if ($stmt === false) {
            die('Error al preparar la consulta: ' . $this->cn()->error);
        }

        // Obtener los valores de la mascota
        $nombre = $mascota->getNombre();
        $fechaNacimiento = $mascota->getFechaNacimiento();
        $dificultades = $mascota->getDificultades();
        $otraInformacion = $mascota->getOtraInformacion();
        $razaAnimal = $mascota->getRazaAnimal();
        $tipoAnimal = $mascota->getTipoAnimal();
        $idDueno = $mascota->getIdDueno();

        $stmt->bind_param("ssssssi", $nombre, $fechaNacimiento, $dificultades, $otraInformacion, $razaAnimal, $tipoAnimal, $idDueno);

        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $stmt->close();
            return true; // Éxito al insertar
        } else {
            $stmt->close();
            return false; // Error al insertar
        }
    }

    public function buscarID($ID)
    {
        $sql = "SELECT 
                    nombre,
                    fechaNacimiento,
                    dificultades,
                    otraInformacion,
                    razaAnimal,
                    tipoAnimal
                FROM 
                    mascota
                WHERE 
                    idDueno = $ID";

        $stmt = $this->cn()->prepare($sql);

        if ($stmt === false) {
            die('Error al preparar la consulta: ' . $this->cn()->error);
        }

        $stmt->bind_param("i", $ID);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $mascotas = $resultado->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        return $mascotas;
    }


    

    public function listarcliente()
    {
        $sql = "SELECT * FROM dueno";

        $result = $this->cn()->query($sql);

        $clientes = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $clientes[] = $row;
            }
        }

        return $clientes;
    }


    public function TotalMascota()
    {
        $sql = "SELECT COUNT(DISTINCT idMascota) AS total FROM mascota";

        $result = $this->cn()->query($sql);

        $mascotas = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $mascotas[] = $row;
            }
        }

        return $mascotas;
    }


    public function detalles()
    {
        $resultado = array();
        $sql = "SELECT m.idMascota, m.nombre AS nombreMascota, m.fechaNacimiento, m.dificultades, 
       m.otraInformacion, m.razaAnimal, m.tipoAnimal, 
       CONCAT(d.nombre, ' ', d.apellido) AS nombreDueno
FROM mascota m
INNER JOIN dueno d ON m.idDueno = d.idDueno;";
        $rs = $this->ejecutarSQL($sql);
        while ($fila = $rs->fetch_assoc()) {
            $resultado[] = $fila;
        }
        return $resultado;
    }



    public function actualizarMascota($id, $mascota)
    {
        $sql = "UPDATE mascota SET 
                nombre = '".$mascota->getNombre()."', 
                fechanacimiento = '".$mascota->getFechaNacimiento()."', 
                dificultades = '".$mascota->getDificultades()."', 
                otraInformacion = '".$mascota->getOtraInformacion()."', 
                razaAnimal = '".$mascota->getRazaAnimal()."',
                tipoAnimal = '".$mascota->getTipoAnimal()."'
    
                WHERE idMascota = $id";
        return $this->ejecutarSQL($sql);
    }



    public function eliminarmascota($id)
    {
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if ($id === false || $id <= 0) {
            return false; // ID inválido
        }
    
        $sql = "DELETE FROM mascota WHERE idMascota = $id";
    
        // Ejecutar la consulta y manejar errores
        try {
            $resultado = $this->ejecutarSQL($sql);
            if ($resultado) {
                return true; // Éxito
            } else {
                return false; // Falló la eliminación
            }
        } catch (Exception $e) {
            // Captura de excepciones
            echo "Error al ejecutar la consulta: " . $e->getMessage();
            return false;
        }
    }
    
    
}
?>
