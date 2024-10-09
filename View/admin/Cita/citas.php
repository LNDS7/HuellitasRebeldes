<?php
// Crear instancias de los controladores necesarios
$listarmascota = new MascotaController();
$detallemascota = new MascotaController();
$clientecontroller = new ClientesController();
$mascotacontroller = new MascotaController();
$citacontroller = new CitaController();

// Verificar si se ha recibido un parámetro 'url' en $_GET y obtener su valor de manera segura
$info = isset($_GET["url"]) ? explode("/", $_GET["url"]) : [];
$ID = isset($info[1]) ? $info[1] : null;

// Obtener listado de mascotas y detalles de una mascota específica
$listar = $listarmascota->listarcliente();
$detalle = $detallemascota->detalles($ID);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Mascotas</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>
    <div class="container mt-3">
        <div class="card">
            <div class="card-header">
                <h2>Mascotas Registradas</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="myTable">
                        <thead>
                            <tr>
                                <th>Nombre de la mascota</th>
                                <th>Fecha de Nacimiento</th>
                                <th>Dificultades</th>
                                <th>Informacion Extra</th>
                                <th>Raza</th>
                                <th>Tipo de Animal</th>
                                <th>Nombre del Dueño</th>
                                <th>Actualizar</th>
                                <th>Agendar Cita</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($detalle as $info): ?>
                            <tr>
                                <td><?php echo $info['nombreMascota']; ?></td>
                                <td><?php echo $info['fechaNacimiento']; ?></td>
                                <td><?php echo $info['dificultades']; ?></td>
                                <td><?php echo $info['otraInformacion']; ?></td>
                                <td><?php echo $info['razaAnimal']; ?></td>
                                <td><?php echo $info['tipoAnimal']; ?></td>
                                <td><?php echo $info['nombreDueno'] ?></td>
                                <td>
                                    <button class="btn btn-primary btn-update"
                                        data-id="<?php echo $info['idMascota']; ?>"
                                        data-nombre="<?php echo $info['nombreMascota']; ?>"
                                        data-fecha="<?php echo $info['fechaNacimiento']; ?>"
                                        data-apellido="<?php echo $info['dificultades']; ?>"
                                        data-direccion="<?php echo $info['otraInformacion']; ?>"
                                        data-telefono="<?php echo $info['razaAnimal']; ?>"
                                        data-tipo="<?php echo $info['tipoAnimal']; ?>"
                                        data-toggle="modal" data-target="#updateModal">
                                        Actualizar
                                    </button>
                                </td>
                                <td>
                                    <button class="btn btn-dark btn-agregar-cita"
                                        data-id="<?php echo $info['idMascota']; ?>"
                                        data-toggle="modal" data-target="#agregarcita">
                                        Agendar Cita a <?php echo $info['nombreDueno']; ?>
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

    <!-- Modal de Actualización -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="updateForm" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Actualizar Mascota</h5>


                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="updateId" name="id">
                        <div class="form-group">
                            <label for="updateNombre" class="text-black">Nombre de la Mascota</label>
                            <input type="text" class="form-control" id="updateNombre" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="updatefecha" class="text-black">Fecha de Nacimiento</label>
                            <input type="text" class="form-control" id="updatefecha" name="fecha" required>
                        </div>
                        <div class="form-group">
                            <label for="updatedificultades" class="text-black">Dificultades</label>
                            <input type="text" class="form-control" id="updateDificultades" name="dificultades" required>
                        </div>
                        <div class="form-group">
                            <label for="updateinformacion" class="text-black">Otra Información</label>
                            <input type="text" class="form-control" id="updateInformacion" name="otraInformacion" required>
                        </div>
                        <div class="form-group">
                            <label for="updaterazaanimal" class="text-black">Raza Animal</label>
                            <input type="text" class="form-control" id="updateRazaAnimal" name="razaAnimal" required>
                        </div>
                        <div class="form-group">
                            <label for="updatetipo" class="text-black">Tipo de Animal</label>
                            <input type="text" class="form-control" id="updateTipoAnimal" name="tipoAnimal" required>
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

    <!-- Modal de Agregar Cita -->
    <div class="modal fade" id="agregarcita" tabindex="-1" aria-labelledby="agregarcitaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="agendarCitaForm" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="agregarcitaLabel">Agendar Cita</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="agendarCitaId" name="id">
                        <div class="form-group">
                            <label for="agregarfecha" class="text-black">Fecha</label>
                            <input type="date" class="form-control" id="agregarfecha" name="fechacita" required>
                        </div>
                        <div class="form-group">
                            <label for="agregarhora" class="text-black">Hora</label>
                            <input type="time" class="form-control" id="agregarhora" name="horacita" required>
                        </div>
                        <div class="form-group">
                            <label for="agregarrazon" class="text-black">Razón de la Cita</label>
                            <input type="text" class="form-control" id="agregarrazon" name="razoncita" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" name="agendarcita" class="btn btn-primary">Agendar Cita</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal de Eliminación -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="deleteForm" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Eliminar Mascota</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="text-black">¿Estás seguro de que deseas eliminar esta Mascota?</p>
                        <input type="hidden" id="deleteId" name="id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" name="delete" class="btn btn-danger">Eliminar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function () {
            // Configuración de DataTables
            $('#myTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"
                }
            });

            // Llenar datos del modal de actualización al hacer clic en el botón Actualizar
            $('.btn-update').on('click', function () {
                var id = $(this).data('id');
                var nombre = $(this).data('nombre');
                var fecha = $(this).data('fecha');
                var dificultades = $(this).data('apellido'); // Cambié 'apellido' por 'dificultades' según el nombre del campo
                var otraInformacion = $(this).data('direccion'); // Cambié 'direccion' por 'otraInformacion' según el nombre del campo
                var razaAnimal = $(this).data('telefono'); // Cambié 'telefono' por 'razaAnimal' según el nombre del campo
                var tipoAnimal = $(this).data('tipo');

                // Llenar los campos del formulario en el modal con los datos correspondientes
                $('#updateId').val(id);
                $('#updateNombre').val(nombre);
                $('#updatefecha').val(fecha);
                $('#updateDificultades').val(dificultades);
                $('#updateInformacion').val(otraInformacion);
                $('#updateRazaAnimal').val(razaAnimal);
                $('#updateTipoAnimal').val(tipoAnimal);

                // Abrir el modal
                $('#updateModal').modal('show');
            });

            // Capturar el idMascota cuando se abre el modal de agendar cita
            $('.btn-agregar-cita').click(function () {
                var idMascota = $(this).data('id'); // Obtener el idMascota del botón
                $('#agendarCitaId').val(idMascota); // Establecer el idMascota en el campo oculto
            });
        });
    </script>

    <?php
    
// Procesar formulario para agregar mascota
if (isset($_POST["ok"])) {
    $mascota = new Mascota();
    $mascota->setNombre($_POST['nombreMascotaModal']);
    $mascota->setFechaNacimiento($_POST["fechaNacimientoModal"]);
    $mascota->setDificultades($_POST['dificultadesModal']);
    $mascota->setRazaAnimal($_POST['razaModal']);
    $mascota->setTipoAnimal($_POST['tipoAnimalModal']);
    $mascota->setOtraInformacion($_POST['otraInformacionModal']);
    $mascota->setIdDueno($_POST['idDueno']);

    if ($mascotacontroller->insertarMascota($mascota)) {
        echo "<script>
                Swal.fire({
                    title: 'Registrada!',
                    text: 'La mascota ha sido registrada exitosamente.',
                    icon: 'success'
                }).then(() => {
                    window.location.replace('Citas');
                });
              </script>";
        exit;
    } else {
        echo "<script>
                Swal.fire({
                    title: 'Error!',
                    text: 'Error al insertar los datos de la mascota.',
                    icon: 'error'
                });
              </script>";
    }
}

// Procesar formulario para actualizar mascota
if (isset($_POST["update"])) {
    if (!isset($_POST['nombre'], $_POST['fecha'], $_POST['dificultades'], $_POST['otraInformacion'], $_POST['razaAnimal'], $_POST['tipoAnimal'], $_POST['id'])) {
        echo "<script>
                Swal.fire({
                    title: 'Error!',
                    text: 'Faltan datos requeridos para actualizar la mascota.',
                    icon: 'error'
                });
              </script>";
        exit;
    }

    $actualizarMascota = new Mascota();
    $actualizarMascota->setNombre($_POST['nombre']);
    $actualizarMascota->setFechaNacimiento($_POST['fecha']);
    $actualizarMascota->setDificultades($_POST['dificultades']);
    $actualizarMascota->setOtraInformacion($_POST['otraInformacion']);
    $actualizarMascota->setRazaAnimal($_POST['razaAnimal']);
    $actualizarMascota->setTipoAnimal($_POST['tipoAnimal']);
    $id = $_POST['id'];

    if ($mascotacontroller->actualizarMascota($id, $actualizarMascota)) {
        echo "<script>
                Swal.fire({
                    title: 'Actualizada!',
                    text: 'La mascota ha sido actualizada exitosamente.',
                    icon: 'success'
                }).then(() => {
                    window.location.replace('Citas');
                });
              </script>";
        exit;
    } else {
        echo "<script>
                Swal.fire({
                    title: 'Error!',
                    text: 'Error al actualizar la mascota.',
                    icon: 'error'
                });
              </script>";
    }
}

// Procesar formulario para eliminar mascota
if (isset($_POST['delete'])) {
    try {
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

        if ($id === false || $id <= 0) {
            throw new Exception('ID de mascota no válido.');
        }

        if ($mascotacontroller->eliminarmascota($id)) {
            echo "<script>
                    Swal.fire({
                        title: 'Eliminada!',
                        text: 'La mascota ha sido eliminada exitosamente.',
                        icon: 'success'
                    }).then(() => {
                        window.location.replace('Mascotas');
                    });
                  </script>";
            exit;
        } else {
            throw new Exception('Error al eliminar la mascota.');
        }
    } catch (Exception $e) {
        echo "<script>
                Swal.fire({
                    title: 'Error!',
                    text: '" . $e->getMessage() . "',
                    icon: 'error'
                });
              </script>";
    }
}

// Procesar formulario para agendar cita
if (isset($_POST['agendarcita'])) {
    try {
        if (!isset($_POST['fechacita'], $_POST['horacita'], $_POST['razoncita'], $_POST['id'])) {
            throw new Exception('Faltan datos requeridos para agendar la cita.');
        }

        $agendarcita = new Cita();
        $agendarcita->setFecha($_POST['fechacita']);
        $agendarcita->setHora($_POST['horacita']);
        $agendarcita->setRazonCita($_POST['razoncita']);
        $agendarcita->setIdMascota($_POST['id']);

        if ($citacontroller->insertarCita($agendarcita)) {
            echo "<script>
                    Swal.fire({
                        title: 'Cita Agendada!',
                        text: 'La cita ha sido agendada exitosamente.',
                        icon: 'success'
                    }).then(() => {
                        window.location.replace('Citas');
                    });
                  </script>";
            exit;
        } else {
            throw new Exception('Error al agregar la cita.');
        }
    } catch (Exception $e) {
        echo "<script>
                Swal.fire({
                    title: 'Error!',
                    text: '" . $e->getMessage() . "',
                    icon: 'error'
                });
              </script>";
    }
} ?>
</body>

<?php
// Instanciar el controlador de citas
$citaController = new CitaController();

// Si se recibe una petición AJAX para obtener las citas
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Llamar al método que devuelve las citas
    $cale = $citaController->listarCitasParaCalendario();

    // Asegurarse de que $cale es un array antes de usarlo
    if (is_array($cale) && !empty($cale)) {
        // Comenzar a generar la respuesta HTML
        echo "<html lang='es'>";
        echo "<head>";
        echo "<meta charset='UTF-8'>";
        echo "<title>Calendario de Citas</title>";
        echo "<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet'>";
        echo "<style>
                /* Personalización del calendario */
                #calendar {
                    max-width: 900px;
                    margin: 40px auto;
                    padding: 20px;
                    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
                    border-radius: 10px;
                    background-color: #f9f9f9;
                }
                .fc-event {
                    background-color: #3498db;
                    border: none;
                    color: black;
                    font-weight: bold;
                    padding: 5px;
                    border-radius: 5px;
                }
                .fc-button {
                    background-color: #2ecc71;
                    border-color: #27ae60;
                    color: black;
                    font-size: 14px;
                    border-radius: 5px;
                }
                .fc-button:hover {
                    background-color: #27ae60;
                }
                .fc-toolbar-title {
                    font-size: 20px;
                    font-weight: bold;
                    color: #2c3e50;
                }
                .fc-daygrid-day, .fc-timegrid-slot {
                    font-size: 13px;
                }
                .fc-day-today {
                    background-color: #f5f5f5 !important;
                    border: 1px solid #ddd;
                }
              </style>";
        echo "<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>";
        echo "</head>";
        echo "<body>";

        echo "<div id='calendar'></div>";

        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    var calendarEl = document.getElementById('calendar');

                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        initialView: 'timeGridWeek',
                        slotDuration: '00:90:00',
                        headerToolbar: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'timeGridDay,timeGridWeek,dayGridMonth'
                        },
                        allDaySlot: false,
                        locale: 'es',
                        nowIndicator: true,
                        eventTimeFormat: {
                            hour: '2-digit',
                            minute: '2-digit',
                            hour12: true
                        },
                        themeSystem: 'bootstrap',
                        slotMinTime: '07:00:00',
                        slotMaxTime: '18:00:00',
                        height: 'auto',
                        events: [";

        // Imprimir eventos en el formato esperado por FullCalendar
        foreach ($cale as $cita) {
            echo "{
                id: " . json_encode($cita['idCita']) . ",
                start: " . json_encode($cita['start']) . ",
                end: " . json_encode($cita['end']) . ",
                title: " . json_encode($cita['title']) . "
            },";
        }

        echo "]
                    });

                    calendar.render();
                });
              </script>";

        echo "</body>";
        echo "</html>";
    } else {
        // Manejar el caso en que no se obtuvo un array de citas
        echo "No se encontraron citas.";
    }

    exit; // Termina el script después de enviar la respuesta
}
?>

</html>
                


