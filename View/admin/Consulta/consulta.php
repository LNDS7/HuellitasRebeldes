<?php
// Instanciar controladores
$listarcliente = new ClientesController();
$veterinario = new CitaController();
$mascotacontroller = new MascotaController();
$clientecontroller = new ClientesController();
$listaraprobadas = new ConsultaController();


// Obtener lista de clientes y nombres de veterinarios
$listar = $listaraprobadas->listarconsultaConVeterinario();
$nombre_veterinario = $veterinario->listarNombreVeterinario();

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<style>
* {box-sizing: border-box}

body, html {
  height: 100%;
  margin: 0;
  font-family: Arial;
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

h1{
    color: black;
}

.tablink:hover {
  background-color: #777;
}

.tabcontent {
  color: white;
  display: none;
  padding: 100px 20px;
  height: 100%;
  text-align: center;
}

.center {
  text-align: center;
}

.pagination {
  display: inline-block;
}

.pagination a {
  color: black;
  float: left;
  padding: 8px 16px;
  text-decoration: none;
  transition: background-color .3s;
  border: 1px solid #ddd;
  margin: 0 4px;
}

.pagination a.active {
  background-color: #4CAF50;
  color: white;
  border: 1px solid #4CAF50;
}

.pagination a:hover:not(.active) {background-color: #ddd;}

#Home {background-color: lightseagreen;}
#News {background-color: lightseagreen;}
</style>
</head>
<body>

<button class="tablink" onclick="openPage('Home', this, 'lightseagreen')">Consultas Realizadas</button>
<button class="tablink" onclick="openPage('News', this, 'lightseagreen')" id="defaultOpen">Consultas Pendientes</button>
<div id="Home" class="tabcontent">
    <?php
    // Crear una instancia del controlador de consultas
    $consulta = new ConsultaController();
    // Obtener la lista de consultas
    $listarconsultas = $consulta->listarconsulta();
    ?>
    <div class="container mt-3">
        <div class="card">
            <div class="card-header">
                <h2>Consultas Realizadas</h2>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="myTable">
                    <thead>
                        <tr>
                            <th>Dueño</th>
                            <th>Mascota</th>
                            <th>Razón de cita</th>
                            <th>Veterinario</th>
                            <th>Descripción de consulta</th>
                            <th>Observación de consulta</th>
                            <th>Fecha de consulta</th>
                            <th>Actualizar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listarconsultas as $info): ?>
                        <tr>
                            <td><?php echo $info['NombreDueno']; ?></td>
                            <td><?php echo $info['NombreMascota']; ?></td>
                            <td><?php echo $info['RazonCita']; ?></td>
                            <td><?php echo $info['NombreVeterinario']; ?></td>
                            <td class="descripcion"><?php echo $info['DescripcionConsulta']; ?></td>
                            <td class="observacion"><?php echo $info['ObservacionesConsulta']; ?></td>
                            <td class="fecha"><?php echo $info['FechaConsulta']; ?></td>
                            <td>
                                <button class="btn btn-warning btn-update" 
                                        data-id="<?php echo $info['IDConsulta']; ?>" 
                                        data-toggle="modal" data-target="#updateModal">
                                    Actualizar
                                </button>
                            </td>
                            <td>
                                <button class="btn btn-danger btn-delete" 
                                        data-id="<?php echo $info['IDConsulta']; ?>" 
                                        data-toggle="modal" data-target="#deleteModal">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Modal para Actualizar -->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Actualizar Consulta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="updateForm">
                    <div class="modal-body">
                        <input type="hidden" id="updateId" name="IDConsulta" value="">
                        <input type="hidden" id="updateCitaId" name="idCita" value="">
                        <div class="form-group">
                            <label for="updateDescripcion">Descripción</label>
                            <input type="text" id="updateDescripcion" name="descripcion" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="updateObservacion">Observación</label>
                            <input type="text" id="updateObservacion" name="observacion" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="updateFecha">Fecha de Consulta</label>
                            <input type="date" id="updateFecha" name="fecha" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" name="update" class="btn btn-primary">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para Eliminar -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Eliminar Cita</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="deleteForm">
                    <div class="modal-body">
                        <input type="hidden" id="deleteId" name="id" value="">
                        ¿Está seguro de que desea eliminar esta Cita?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" name="delete" class="btn btn-danger">Eliminar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
$(document).ready(function() {
    $('#myTable').DataTable(); // Inicializa el DataTable

    // Manejo del evento click para el botón de actualizar
    $(document).on('click', '.btn-update', function() {
        var idConsulta = $(this).data('id'); // Obtener el ID de la consulta
        var idCita = $(this).data('cita-id'); // Obtener el ID de la cita
        var descripcion = $(this).closest('tr').find('.descripcion').text(); // Obtener descripción
        var observacion = $(this).closest('tr').find('.observacion').text(); // Obtener observación
        var fecha = $(this).closest('tr').find('.fecha').text(); // Obtener fecha

        // Asignar valores a los campos del modal
        $('#updateId').val(idConsulta);
        $('#updateCitaId').val(idCita); // Asegúrate de que este ID también se asigna
        $('#updateDescripcion').val(descripcion);
        $('#updateObservacion').val(observacion);
        $('#updateFecha').val(fecha);

        // Mostrar el modal
        $('#updateModal').modal('show'); // Muestra el modal
    });

    // Manejo de eliminación
    $('.btn-delete').on('click', function() {
        $('#deleteId').val($(this).data('id')); // Asignar ID a la entrada oculta
    });
});

</script>

    <?php 
    $actualizarConsulta = new ConsultaController();
    // Manejo de actualizaciones
    if (isset($_POST['update'])) {
        $consulta = new Consulta();
        // Establecer los valores de la consulta
        $consulta->setFecha($_POST['fecha']);
        $consulta->setIdCita($_POST['idCita']);
        $consulta->setDescripcion($_POST['descripcion']);
        $consulta->setObservaciones($_POST['observacion']);
        // Obtener el ID de la consulta a actualizar
        $idConsulta = $_POST['IDConsulta'];
        // Intentar actualizar la consulta
        if ($actualizarConsulta->actualizarConsulta($idConsulta, $consulta->getIdCita(), $consulta->getFecha(), $consulta->getDescripcion(), $consulta->getObservaciones())) {
            echo "<script>
                    Swal.fire({
                        title: 'Consulta Actualizada!',
                        text: 'Los datos de la consulta han sido actualizados exitosamente.',
                        icon: 'success'
                    }).then(() => {
                        window.location.replace('Consulta'); // Cambia a la página de consultas
                    });
                  </script>";
            exit;
        } else {
            echo "<script>
                    Swal.fire({
                        title: 'Error!',
                        text: 'Error al actualizar los datos de la consulta.',
                        icon: 'error'
                    });
                  </script>";
        }
    } 
    // Manejo de eliminación
    elseif (isset($_POST['delete'])) {
        $eliminarconsulta = new ConsultaController();
        // Procesar eliminación de consulta
        $id = $_POST['id'];

        if ($eliminarconsulta->eliminarConsulta($id)) {
            echo "<script>
                    Swal.fire({
                        title: 'Consulta Eliminada!',
                        text: 'La consulta ha sido eliminada exitosamente.',
                        icon: 'success'
                    }).then(() => {
                        window.location.replace('Consulta'); // Cambia a la página de consultas
                    });
                  </script>";
            exit;
        } else {
            echo "<script>
                    Swal.fire({
                        title: 'Error!',
                        text: 'Error al eliminar los datos de la consulta.',
                        icon: 'error'
                    });
                  </script>";
        }
    }
    ?>
</div>



<div id="News" class="tabcontent">
    <div class="container mt-3">
        <div class="card">
            <div class="card-header">
                <h2>Consultas Pendientes</h2>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="myTable">
                    <thead>
                        <tr>
                            <th>Dueño</th>
                            <th>Mascota</th>
                            <th>Razon de cita</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Veterinario</th>
                            <!--<th>Actualizar</th>-->
                            <!--<th>Eliminar</th>-->
                            <th>Agregar Consulta</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listar as $info): ?>
                        <tr>
                            <td><?php echo $info['Dueno']; ?></td>
                            <td><?php echo $info['NombreMascota']; ?></td>
                            <td><?php echo $info['razonCita']; ?></td>
                            <td><?php echo $info['fecha']; ?></td>
                            <td><?php echo $info['hora']; ?></td>
                            <td><?php echo $info['Veterinario']; ?></td>
                            <!--<td>
                                <button class="btn btn-warning btn-update" 
                                        data-id="<?php echo $info['idCita']; ?>"
                                        data-nombre="<?php echo $info['Veterinario']; ?>"
                                        data-toggle="modal" data-target="#updateModal">
                                    Actualizar
                                </button>
                            </td>-->
                            <!--<td>
                                <button class="btn btn-danger btn-delete" 
                                        data-id="<?php echo $info['idCita']; ?>"
                                        data-toggle="modal" data-target="#deleteModal">
                                    Eliminar
                                </button>
                            </td>-->
                            <td>
                                <button class="btn btn-dark btn-agregar-consulta" 
                                        data-id="<?php echo $info['idCita']; ?>"
                                        data-nombre="<?php echo $info['NombreMascota']; ?>"
                                        data-toggle="modal" data-target="#agregarmascotamodal">
                                    Agregar Consulta
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<!-- Modal para Agregar Consulta -->
<div class="modal fade" id="agregarmascotamodal" tabindex="-1" role="dialog" aria-labelledby="agregarmascotamodalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarmascotamodalLabel">Agregar Consulta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="agregarConsultaForm">
                <div class="modal-body">
                    <input type="hidden" id="idDuenoMascota" name="idCita" value="">
                    <div class="form-group">
                        <label for="descripcion">Descripción:</label>
                        <input type="text" id="descripcion" name="descripcion" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="observacion">Observación:</label>
                        <input type="text" id="observacion" name="observacion" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="fechaConsulta">Fecha de Consulta:</label>
                        <input type="date" id="fechaConsulta" name="fecha" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" name="agregarConsulta" class="btn btn-primary">Agregar Consulta</button>
                </div>
            </form>
        </div>
    </div>
    
<script>
$(document).ready(function() {
    $('#myTable').DataTable();

    $(document).on('click', '.btn-update', function() {
        var idConsulta = $(this).data('id'); // Obtener el ID de la consulta
        var idCita = $(this).data('cita-id'); // Obtener el ID de la cita, si está disponible
        var descripcion = $(this).closest('tr').find('.descripcion').text(); // Obtener descripción
        var observacion = $(this).closest('tr').find('.observacion').text(); // Obtener observación
        var fecha = $(this).closest('tr').find('.fecha').text(); // Obtener fecha

        // Asignar valores a los campos del modal
        $('#updateId').val(idConsulta);
        $('#updateCitaId').val(idCita);
        $('#updateDescripcion').val(descripcion);
        $('#updateObservacion').val(observacion);
        $('#updateFecha').val(fecha);
    });

    // Manejo de eliminación
    $('.btn-delete').on('click', function() {
        $('#deleteId').val($(this).data('id'));
    });

    // Manejo de agregar consulta
    $('.btn-agregar-consulta').on('click', function() {
        var idCita = $(this).data('id'); // Obtener el ID de la cita
        $('#idDuenoMascota').val(idCita); // Asignar el ID de la cita al campo oculto del formulario de agregar consulta
    });
});

function openPage(pageName, elmnt, color) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].style.backgroundColor = "";
    }
    document.getElementById(pageName).style.display = "block";
    elmnt.style.backgroundColor = color;
}

document.getElementById("defaultOpen").click();
</script>


<?php 
$insertarconsulta = new ConsultaController();
// Procesar formulario para insertar Consulta
if (isset($_POST['agregarConsulta'])) {
    $consulta = new Consulta();
    $consulta->setDescripcion($_POST['descripcion']);
    $consulta->setObservaciones($_POST['observacion']);
    $consulta->setFecha($_POST['fecha']);
    $consulta->setIdCita($_POST['idCita']);

    if ($insertarconsulta->insertarConsulta($consulta)) {
        echo "<script>
                Swal.fire({
                    title: 'Mascota Agregada!',
                    text: 'La Consulta ha sido agregada exitosamente.',
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
                    text: 'Error al agregar Consulta.',
                    icon: 'error'
                });
              </script>";
    }
}?>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
