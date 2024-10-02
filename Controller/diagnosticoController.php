<?php
require_once("conexion.php"); // Asumiendo que tienes un archivo de conexión llamado conexion.php

class DiagnosticoController extends Conexion
{
    public function insertarDiagnostico($diagnostico)
    {
        $sql = "INSERT INTO diagnostico (descripcion, idConsulta) 
                VALUES (?, ?)";
        
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
        $stmt->bind_param("si", $descripcion, $idConsulta);
        
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
                v.nombre AS NombreVeterinario,
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
            LEFT JOIN 
                consulta con ON c.idCita = con.idCita
            LEFT JOIN 
                diagnostico diag ON con.idConsulta = diag.idConsulta";
    
            $rs = $this->ejecutarSQL($sql);
            while ($fila = $rs->fetch_assoc()) {
                $resultado[] = $fila;
            }
            return $resultado;
        }
    }
    ?>