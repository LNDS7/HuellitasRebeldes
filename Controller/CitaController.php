<?php
require_once ("conexion.php");
class CitaController extends Conexion
{

    public function insertarCita($cita)
    {
        $sql = "INSERT INTO cita (fecha,hora,razonCita,idMascota) 
            VALUES (?, ?, ?, ?)";

        $stmt = $this->cn()->prepare($sql);

        if ($stmt === false) {
            die('Error al preparar la consulta: ' . $this->cn()->error);
        }

        // Obtener los valores de la cita
        $idMascota = $cita->getIdMascota();
        $fecha = $cita->getFecha();
        $hora = $cita->getHora();
        $razonCita = $cita->getRazonCita();

        // Bind parameters
        $stmt->bind_param("sssi", $fecha, $hora, $razonCita, $idMascota);

        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $stmt->close();
            return true; // Éxito al insertar
        } else {
            $stmt->close();
            return false; // Error al insertar
        }
    }

    public function actualizarcita($id, $cita)
    {
        $sql = "UPDATE cita SET 
                   fecha = ?,
                   hora = ?,
                   razonCita = ?
               WHERE idCita = ?";
    
        $stmt = $this->cn()->prepare($sql);
    
        if ($stmt === false) {
            die('Error al preparar la consulta: ' . $this->cn()->error);
        }
    
        // Obtener los valores de la cita
        $fecha = $cita->getFecha();       // Suponiendo que $cita->getFecha() devuelve la fecha en formato correcto para la base de datos
        $hora = $cita->getHora();         // Suponiendo que $cita->getHora() devuelve la hora en formato correcto para la base de datos
        $razonCita = $cita->getRazonCita(); // Suponiendo que $cita->getRazonCita() devuelve la razón de la cita como string
    
        // Bind parameters
        $stmt->bind_param("sssi", $fecha, $hora, $razonCita, $id);
    
        $stmt->execute();
    
        if ($stmt->affected_rows > 0) {
            $stmt->close();
            return true; // Éxito al actualizar
        } else {
            $stmt->close();
            return false; // Error al actualizar
        }
    }
    

    public function eliminarCita($id)
{
    // Preparar la consulta SQL con una sentencia preparada
    $sql = "DELETE FROM cita WHERE idCita = ?";
    
    // Preparar la declaración
    $stmt = $this->cn()->prepare($sql);
    
    if ($stmt === false) {
        die('Error al preparar la consulta: ' . $this->cn()->error);
    }
    
    // Bind parameter (vincular el parámetro)
    $stmt->bind_param("i", $id); // "i" indica que $id es un entero
    
    // Ejecutar la consulta
    $stmt->execute();
    
    // Verificar si se afectaron filas (se eliminó correctamente)
    if ($stmt->affected_rows > 0) {
        $stmt->close();
        return true; // Éxito al eliminar
    } else {
        $stmt->close();
        return false; // Error al eliminar
    }
}


    public function TotalCitas()
    {
        $sql = "SELECT COUNT(DISTINCT idCita) AS total FROM cita";

        $result = $this->cn()->query($sql);

        $citas = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $citas[] = $row;
            }
        }

        return $citas;
    }

    public function listarCitas()
    {
        $sql = "SELECT
                        CONCAT(dueno.nombre, ' ', dueno.apellido) AS nombreDueno,
                        mascota.nombre AS nombreMascota,
                        cita.fecha,
                        cita.hora,
                        cita.razonCita
                    FROM 
                        cita
                    JOIN 
                        mascota ON cita.idMascota = mascota.idMascota
                    JOIN 
                        dueno ON mascota.idDueno = dueno.idDueno";

        $result = $this->cn()->query($sql);

        $citas = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $citas[] = $row;
            }
        }

        return $citas;
    }


    public function listarNombreVeterinario()
    {
        $resultado = array();
        $sql = "SELECT 
    c.idCita,
    c.fecha,
    c.hora,
    c.razonCita,
    m.nombre AS NombreMascota,
    CONCAT(d.nombre, ' ', d.apellido) AS Dueno,
    IFNULL(CONCAT(v.nombre, ' ', v.apellido), 'No hay citas para este paciente') AS Veterinario
FROM 
    cita c
JOIN 
    mascota m ON c.idMascota = m.idMascota
JOIN 
    dueno d ON m.idDueno = d.idDueno
LEFT JOIN 
    veterinario v ON c.idVeterinario = v.idVeterinario
WHERE 
    c.idVeterinario IS NULL OR v.idVeterinario IS NULL;

";
        $rs = $this->ejecutarSQL($sql);
        while ($fila = $rs->fetch_assoc()) {
            $resultado[] = $fila;
        }
        return $resultado;
    }

    public function listarCitasConVeterinario()
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


    public function asignarVeterinario($idCita, $idVeterinario)
{
    $sql = "UPDATE cita SET idVeterinario = ? WHERE idCita = ?";
    $stmt = $this->cn()->prepare($sql);

    if ($stmt === false) {
        die('Error al preparar la consulta: ' . $this->cn()->error);
    }

    $stmt->bind_param("ii", $idVeterinario, $idCita);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $stmt->close();
        return true; // Éxito al asignar
    } else {
        $stmt->close();
        return false; // Error al asignar
    }
}
public function listarVeterinarios()
{
    $sql = "SELECT idVeterinario, nombre, apellido FROM veterinario";
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
