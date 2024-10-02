<?php
// Instanciar el controlador de citas una sola vez
$citaController = new CitaController();

// Obtener las citas con veterinario asignado
$citas_con_veterinario = $citaController->listarCitasConVeterinario();
// Obtener la lista de nombres de veterinarios
$nombre_veterinario = $citaController->listarNombreVeterinario();
$veterinarios = $citaController->listarVeterinarios(); // Necesitamos este método en el controlador

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="estilo/letra.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
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

    label,p {
    color: #333; /* Color más oscuro para mejor visibilidad */
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

<button class="tablink" onclick="openPage('Home', this, 'lightseagreen')">Citas Aceptadas</button>
<button class="tablink" onclick="openPage('News', this, 'lightseagreen')" id="defaultOpen">Cita en Espera</button>

<div id="Home" class="tabcontent">
    <center>
        <div class="container mt-3">
            <div class="card">
                <div class="card-body">
                    <h2>Citas con Veterinario Asignado</h2>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="citasVeterinario">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Razón de la Cita</th>
                                <th>Nombre de la Mascota</th>
                                <th>Dueño</th>
                                <th>Veterinario</th>
                                <th>Actualizar</th>
                                <!--<th>Eliminar</th>-->
                                <!-- Añade aquí las columnas adicionales según tu necesidad -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($citas_con_veterinario as $cita): ?>
                                <tr>
                                    <td><?php echo $cita['fecha']; ?></td>
                                    <td><?php echo $cita['hora']; ?></td>
                                    <td><?php echo $cita['razonCita']; ?></td>
                                    <td><?php echo $cita['NombreMascota']; ?></td>
                                    <td><?php echo $cita['Dueno']; ?></td>
                                    <td><?php echo $cita['Veterinario']; ?></td>
                                    <td>
                                        <button class="btn btn-primary btn-update" data-id="<?php echo $cita['idCita']; ?>"
                                            data-fecha="<?php echo $cita['fecha']; ?>" data-hora="<?php echo $cita['hora']; ?>"
                                            data-razon="<?php echo $cita['razonCita']; ?>" data-toggle="modal" data-target="#updateModal">
                                            Actualizar
                                        </button>
                                    </td>
                                    <!--<td>
                                        <button class="btn btn-danger btn-delete" data-id="<?php echo $cita['idCita']; ?>"
                                            data-toggle="modal" data-target="#deleteModal">
                                            Eliminar
                                        </button>
                                    </td>-->
                                    <!-- Agregar más columnas según tus necesidades -->
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center" id="pagination3">
                            <!-- Puedes agregar paginación si es necesario -->
                            <li class="page-item disabled" id="previousPage3">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                            </li>
                            <li class="page-item" id="nextPage3">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </center>
</div>

<div id="News" class="tabcontent">
    <center>
        <div class="container mt-3">
            <div class="card">
                <div class="card-body">
                    <h2>Clientes Sin Citas</h2>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="citasSinVeterinario">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Razon de la Cita</th>
                                <th>Nombre de la Mascota</th>
                                <th>Dueno</th>
                                <th>Cliente</th>
                                <th>Actualizar</th>
                                <!--<th>Eliminar</th>-->
                                <th>Agregar Veterinario</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($nombre_veterinario as $info): ?>
                                <tr>
                                    <td><?php echo $info['fecha']; ?></td>
                                    <td><?php echo $info['hora']; ?></td>
                                    <td><?php echo $info['razonCita']; ?></td>
                                    <td><?php echo $info['NombreMascota']; ?></td>
                                    <td><?php echo $info['Dueno']; ?></td>
                                    <td><?php echo $info['Veterinario']; ?></td>
                                    <td>
                                        <button class="btn btn-primary btn-update" data-id="<?php echo $info['idCita']; ?>"
                                            data-fecha="<?php echo $info['fecha']; ?>" data-hora="<?php echo $info['hora']; ?>"
                                            data-razon="<?php echo $info['razonCita']; ?>" data-toggle="modal" data-target="#updateModal">
                                            Actualizar
                                        </button>
                                    </td>
                                    <!--<td>
                                        <button class="btn btn-danger btn-delete" data-id="<?php echo $info['idCita']; ?>"
                                            data-toggle="modal" data-target="#deleteModal">
                                            Eliminar
                                        </button>
                                    </td>-->
                                    <td>
                                        <button class="btn btn-dark btn-agregar-veterinario" data-id="<?php echo $info['idCita']; ?>"
                                            data-toggle="modal" data-target="#assignVeterinarioModal">
                                            Agendar Veterinario
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center" id="pagination2">
                            <!-- Puedes agregar paginación si es necesario -->
                            <li class="page-item disabled" id="previousPage2">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                            </li>
                            <li class="page-item" id="nextPage2">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </center>
</div>

<!-- Modal para Actualizar -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar Cita</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post">
                <div class="modal-body">
                    <input type="hidden" name="idCita" id="idCita">
                    <div class="form-group">
                        <label for="fecha">Fecha:</label>
                        <input type="date" class="form-control" name="fecha" id="fecha" required>
                    </div>
                    <div class="form-group">
                        <label for="hora">Hora:</label>
                        <input type="time" class="form-control" name="hora" id="hora" required>
                    </div>
                    <div class="form-group">
                        <label for="razonCita">Razón de la Cita:</label>
                        <textarea class="form-control" name="razonCita" id="razonCita" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" name="actualizarCita">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para Eliminar -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar Cita</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post">
                <div class="modal-body">
                    <input type="hidden" name="idCita" id="deleteIdCita">
                    ¿Estás seguro de que quieres eliminar esta cita?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-danger" name="delete">Eliminar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para Asignar Veterinario -->
<div class="modal fade" id="assignVeterinarioModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Asignar Veterinario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post">
                <div class="modal-body">
                    <input type="hidden" name="idCita" id="assignIdCita">
                    <div class="form-group">
                        <label for="idVeterinario">Seleccionar Veterinario:</label>
                        <select name="idVeterinario" class="form-control" id="idVeterinario" required>
                            <?php foreach ($veterinarios as $veterinario): ?>
                                <option value="<?php echo $veterinario['idVeterinario']; ?>"><?php echo $veterinario['nombre']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" name="asignarVeterinario">Asignar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#citasVeterinario').DataTable(); // Inicializa DataTables en la tabla de citas con veterinario
        $('#citasSinVeterinario').DataTable(); // Inicializa DataTables en la tabla de clientes sin citas

        // Rellenar los datos en el modal de actualización
        $('.btn-update').click(function() {
            var id = $(this).data('id');
            var fecha = $(this).data('fecha');
            var hora = $(this).data('hora');
            var razon = $(this).data('razon');

            $('#idCita').val(id);
            $('#fecha').val(fecha);
            $('#hora').val(hora);
            $('#razonCita').val(razon);
        });

        // Rellenar el id en el modal de eliminación
        $('.btn-delete').click(function() {
            var id = $(this).data('id');
            $('#deleteIdCita').val(id);
        });

        // Rellenar el id en el modal de asignación de veterinario
        $('.btn-agregar-veterinario').click(function() {
            var id = $(this).data('id');
            $('#assignIdCita').val(id);
        });
    });

    function openPage(pageName, btn, color) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";  
        }
        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(pageName).style.display = "block";  
        btn.className += " active";
    }

    document.getElementById("defaultOpen").click();
</script>
<?php
// Procesar formulario para actualizar cita
if (isset($_POST['actualizarCita'])) {
    $cita = new Cita();
    $cita->setFecha($_POST['fecha']);
    $cita->setHora($_POST['hora']);
    $cita->setRazonCita($_POST['razonCita']);
    $id = $_POST['idCita'];

    if ($citaController->actualizarcita($id, $cita)) {
        echo "<script>
                Swal.fire({
                    title: 'Actualizada!',
                    text: 'La cita ha sido actualizada exitosamente.',
                    icon: 'success'
                }).then(() => {
                    window.location.replace('Consulta');
                });
              </script>";
        exit;
    } else {
        echo "<script>
                Swal.fire({
                    title: 'Error!',
                    text: 'Error al actualizar los datos de la cita.',
                    icon: 'error'
                });
              </script>";
    }
} elseif (isset($_POST['delete'])) {
    // Procesar el formulario de eliminación
    $id = $_POST['idCita']; // Asegúrate que 'idCita' coincide con el name del campo en el formulario

    if ($citaController->eliminarCita($id)) {
        echo "<script>
                Swal.fire({
                    title: 'Eliminada!',
                    text: 'La cita ha sido eliminada exitosamente.',
                    icon: 'success'
                }).then(() => {
                    window.location.replace('Consulta');
                });
              </script>";
        exit;
    } else {
        echo "<script>
                Swal.fire({
                    title: 'Error!',
                    text: 'Error al eliminar los datos de la cita.',
                    icon: 'error'
                });
              </script>";
    }
} elseif (isset($_POST['asignarVeterinario'])) {
    // Procesar el formulario de asignación de veterinario
    $idCita = $_POST['idCita'];
    $idVeterinario = $_POST['idVeterinario'];

    if ($citaController->asignarVeterinario($idCita, $idVeterinario)) {
        echo "<script>
                Swal.fire({
                    title: 'Veterinario Asignado!',
                    text: 'El veterinario ha sido asignado exitosamente.',
                    icon: 'success'
                }).then(() => {
                    window.location.replace('Consulta');
                });
              </script>";
        exit;
    } else {
        echo "<script>
                Swal.fire({
                    title: 'Error!',
                    text: 'Error al asignar el veterinario.',
                    icon: 'error'
                });
              </script>";
    }
} ?>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
