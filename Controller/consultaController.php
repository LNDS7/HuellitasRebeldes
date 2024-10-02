<?php
require_once("conexion.php");

class ConsultaController extends Conexion
{
    public function insertarConsulta($consulta)
    {
        $sql = "INSERT INTO consulta (fecha, idCita, descripcion, observaciones) 
                VALUES (?, ?, ?, ?)";
        $stmt = $this->cn()->prepare($sql);

        if ($stmt === false) {
            die('Error al preparar la consulta: ' . $this->cn()->error);
        }

        $fecha = $consulta->getFecha();
        $idCita = $consulta->getIdCita();
        $descripcion = $consulta->getDescripcion();
        $observaciones = $consulta->getObservaciones();

        $stmt->bind_param("siss", $fecha, $idCita, $descripcion, $observaciones);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
    }

    public function actualizarConsulta($idConsulta, $descripcion, $observaciones)
    {
        $sql = "UPDATE consulta SET descripcion = ?, observaciones = ? WHERE idConsulta = ?";
        $stmt = $this->cn()->prepare($sql);

        if ($stmt === false) {
            die('Error al preparar la consulta: ' . $this->cn()->error);
        }

        $stmt->bind_param("ssi", $descripcion, $observaciones, $idConsulta);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
    }

    public function eliminarConsulta($idConsulta)
    {
        $sql = "DELETE FROM consulta WHERE idConsulta = ?";
        $stmt = $this->cn()->prepare($sql);

        if ($stmt === false) {
            die('Error al preparar la consulta: ' . $this->cn()->error);
        }

        $stmt->bind_param("i", $idConsulta);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
    }

    public function listarconsultaConVeterinario()
    {
        $sql = "SELECT 
                    c.idCita,
                    c.fecha,
                    c.hora,
                    c.razonCita,
                    m.nombre AS NombreMascota,
                    CONCAT(d.nombre, ' ', d.apellido) AS Dueno,
                    CONCAT(v.nombre, ' ', v.apellido) AS Veterinario
                FROM 
                    cita c
                JOIN 
                    mascota m ON c.idMascota = m.idMascota
                JOIN 
                    dueno d ON m.idDueno = d.idDueno
                JOIN 
                    veterinario v ON c.idVeterinario = v.idVeterinario";

        $result = $this->cn()->query($sql);

        $citas = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $citas[] = $row;
            }
        }

        return $citas;
    }

    public function listarconsulta()
    {
        $resultado = [];
        $sql = "SELECT c.idCita AS IDCita,
       d.nombre AS NombreDueno,
       m.nombre AS NombreMascota,
       c.fecha AS FechaCita,
       c.hora AS HoraCita,
       c.razonCita AS RazonCita,  
       v.nombre AS NombreVeterinario,
       COALESCE(con.descripcion, 'Sin descripción') AS DescripcionConsulta,
       COALESCE(con.observaciones, 'Sin observaciones') AS ObservacionesConsulta
FROM cita c
JOIN mascota m ON c.idMascota = m.idMascota
JOIN dueno d ON m.idDueno = d.idDueno
JOIN veterinario v ON c.idVeterinario = v.idVeterinario
LEFT JOIN consulta con ON c.idCita = con.idCita;";
        $rs = $this->cn()->query($sql);

        while ($fila = $rs->fetch_assoc()) {
            $resultado[] = $fila;
        }
        return $resultado;
    }
}
?>
