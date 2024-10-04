<!--<?php
// Asegúrate de tener esta clase definida

$consultaController = new DiagnosticoController();
$idConsulta = $consultaController->listar();

// Manejar el envío del formulario de nueva consulta
if (isset($_POST['guardarConsulta'])) {
    $fecha = $_POST['fechaConsulta'];
    $hora = $_POST['horaConsulta'];
    $descripcion = $_POST['descripcion'];
    $observacion = $_POST['observacion'];
    $idCita = $_POST['idCita'];

    $consulta = new Consulta();
    $consulta->setFecha($fecha);
    $consulta->setIdCita($idCita);
    $consulta->setDescripcion($descripcion);
    $consulta->setObservaciones($observacion);

    if ($consultaController->insertarDiagnostico($consulta)) {
        echo json_encode(['status' => 'success', 'message' => 'Consulta agregada correctamente']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al agregar consulta']);
    }
    exit;
}

// Procesar formulario de actualización de consulta
if (isset($_POST['actualizarConsulta'])) {
    $idConsulta = $_POST['idConsultaUpdate'];
    $descripcion = $_POST['descripcionUpdate'];
    $observaciones = $_POST['observacionUpdate'];

    if ($consultaController->actualizarDiagnosticoPorIdCita($idConsulta, $descripcion)) {
        echo json_encode(['status' => 'success', 'message' => 'Consulta actualizada correctamente']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al actualizar consulta']);
    }
    exit;
}

// Procesar formulario de eliminación de consulta
if (isset($_POST['eliminarConsulta'])) {
    $idConsulta = $_POST['idConsulta'];

    if ($consultaController->eliminarDiagnostico($idConsulta)) {
        echo json_encode(['status' => 'success', 'message' => 'Consulta eliminada correctamente']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al eliminar consulta']);
    }
    exit;
}

// Obtener datos para mostrar en la tabla de consultas con veterinario asignado
$cons = $consultaController->listar();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Veterinario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
    * {
      box-sizing: border-box;
    }

    body,
    html {
      height: 100%;
      margin: 0;
    }

    .tablink {
      background-color: #555;
      color: white;
      float: left;
      border: none;
      outline: none;
      cursor: pointer;
      padding: 14px 16px;
      font-size: 17px;
      width: 50%;
    }

    .tablink:hover {
      background-color: #777;
    }

    .tabcontent {
      color: white;
      display: none;
      padding: 100px 20px;
      height: 100%;
      background-color: inherit;
    }

    #Home {background-color: lightseagreen;}
    #News {background-color: lightseagreen;}
  </style>
</head>

<body>
    <table class="table table-striped">

        <center>

            <div class="card-header">
                <h2>Destalles de Diagnostico</h2>
            </div>

            <thead>
                <tr>
                    <th>Dueño</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Razón de la Consulta</th>
                    <th>Nombre de la Mascota</th>
                    <th>Veterinario</th>
                    <th>Descripcion de Consulta</th>
                    <th>Observacion de Consulta</th>
                    <th>Diagnostico</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($idConsulta as $consulta): ?>
                    <tr>
                        <td><?php echo $consulta['NombreDueno']; ?></td>
                        <td><?php echo $consulta['NombreMascota']; ?></td>
                        <td><?php echo $consulta['FechaCita']; ?></td>
                        <td><?php echo $consulta['HoraCita']; ?></td>
                        <td><?php echo $consulta['RazonCita']; ?></td>
                        <td><?php echo $consulta['NombreVeterinario']; ?></td>
                        <td><?php echo $consulta['DescripcionConsulta']; ?></td>
                        <td><?php echo $consulta['ObservacionesConsulta']; ?></td>
                        <td><?php echo $consulta['DiagnosticoConsulta']; ?></td>
                        <td>
                            <button class="btn btn-danger btn-delete" data-id="<?php echo $consulta['IDCita']; ?>"
                                data-toggle="modal" data-target="#deleteModal">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
    </table>
    </div>

    <!-- Modal para eliminar consulta -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Eliminar Consulta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="deleteConsultaForm">
                        <input type="hidden" id="idConsulta" name="idConsulta">
                        <p>¿Estás seguro de que quieres eliminar esta consulta?</p>
                        <button type="submit" name="eliminarConsulta" class="btn btn-danger">Eliminar Consulta</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function () {
                // Capturar el id de la cita desde el atributo data-id del botón
                var citaId = this.getAttribute('data-id');

                // Establecer el valor en el campo oculto deleteId del modal de eliminación
                document.getElementById('deleteId').value = citaId;
            });
        });

    </script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>