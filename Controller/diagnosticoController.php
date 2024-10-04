<?php
require_once("conexion.php"); // Asumiendo que tienes un archivo de conexión llamado conexion.php

class DiagnosticoController extends Conexion
{
    public function insertarDiagnostico($diagnostico)
{
    $sql = "INSERT INTO diagnostico (descripcion, idConsulta) VALUES (?, ?)";

    // Preparar la consulta
    $stmt = $this->cn()->prepare($sql);

    if ($stmt === false) {
        // Si falla la preparación de la consulta
        die('Error al preparar la consulta: ' . $this->cn()->error);
    }

    // Obtener los valores del diagnóstico
    $descripcion = $diagnostico->getDescripcion();
    $idConsulta = $diagnostico->getIdConsulta();

    // Vincular los parámetros de la consulta
    $stmt->bind_param("si", $descripcion, $idConsulta); // "si" indica que el primer parámetro es un string y el segundo es un entero

    // Ejecutar la consulta
    if ($stmt->execute()) {
        $stmt->close();
        return true; // Éxito al insertar
    } else {
        // Si ocurre un error al ejecutar la consulta
        die('Error al insertar diagnóstico: ' . $stmt->error);
    }
}

    public function actualizarDiagnosticoPorIdCita($idCita, $descripcionDiagnostico)
    {
        $sql = "UPDATE diagnostico SET descripcion = ? WHERE idConsulta = ?";

        // Preparar la consulta
        $stmt = $this->cn()->prepare($sql);

        if ($stmt === false) {
            die('Error al preparar la consulta: ' . $this->cn()->error);
        }

        $stmt->bind_param("si", $descripcionDiagnostico, $idCita);
        $stmt->execute();

        $actualizado = $stmt->affected_rows > 0;

        $stmt->close();

        return $actualizado;
    }

    public function eliminarDiagnostico($id)
    {
        $sql = "DELETE FROM diagnostico WHERE idDiagnostico = ?";

        // Preparar la consulta
        $stmt = $this->cn()->prepare($sql);

        if ($stmt === false) {
            die('Error al preparar la consulta: ' . $this->cn()->error);
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();

        $eliminado = $stmt->affected_rows > 0;

        $stmt->close();

        return $eliminado;
    }

    public function listar()
    {
        $resultado = array();
        $sql = "SELECT 
        c.idCita AS IDCita,
        d.nombre AS NombreDueno,
        m.nombre AS NombreMascota,
        c.fecha AS FechaCita,
        c.hora AS HoraCita,
        c.razonCita AS RazonCita,
        CONCAT(v.nombre, ' ', v.apellido) AS NombreVeterinario,  
        COALESCE(con.fecha, 'Sin fecha') AS FechaConsulta,  
        COALESCE(con.descripcion, 'Sin descripción') AS DescripcionConsulta,
        COALESCE(con.observaciones, 'Sin observaciones') AS ObservacionesConsulta,
        COALESCE(diag.descripcion, 'Sin diagnóstico') AS DiagnosticoConsulta
    FROM 
        cita c
    JOIN 
        mascota m ON c.idMascota = m.idMascota
    JOIN 
        dueno d ON m.idDueno = d.idDueno
    JOIN 
        veterinario v ON c.idVeterinario = v.idVeterinario
    JOIN 
        consulta con ON c.idCita = con.idCita  
    LEFT JOIN 
        diagnostico diag ON con.idConsulta = diag.idConsulta
    WHERE 
        con.idConsulta IS NOT NULL";


        $rs = $this->ejecutarSQL($sql);
        while ($fila = $rs->fetch_assoc()) {
            $resultado[] = $fila;
        }
        return $resultado;
    }
}
