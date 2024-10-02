<?php
$listarcliente = new ClientesController();
$listar = $listarcliente->listarCliente();

$veterinario = new CitaController();
$nombre_veterinario = $veterinario->listarNombreVeterinario();

// Instanciar mascota controller para llenar formulario mascota
$mascotacontroller = new MascotaController();

$clientecontroller = new ClientesController();

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<style>
* {box-sizing: border-box}

/* Set height of body and the document to 100% */
body, html {
  height: 100%;
  margin: 0;
  font-family: Arial;
}

/* Style tab links */
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

label,p {
    color: #333; /* Color más oscuro para mejor visibilidad */
}

/* Style the tab content (and add height:100% for full page content) */
.tabcontent {
  color: white;
  display: none;
  padding: 100px 20px;
  height: 100%;
  text-align: center; /* Center align content */
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

<button class="tablink" onclick="openPage('Home', this, 'lightseagreen')">Agregar Clientes</button>
<button class="tablink" onclick="openPage('News', this, 'lightseagreen')" id="defaultOpen">Ver lista</button>

<div id="Home" class="tabcontent">
    <div class="container mt-2">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Llenar Datos del Cliente</h2>
                <form method="post" action="" class="row g-3" id="for">
                    <div class="col-md-6">
                        <label for="nombreDueno" class="form-label">Nombre:</label>
                        <input type="text" id="nombreDueno" name="nombreDueno" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="apellidoDueno" class="form-label">Apellido:</label>
                        <input type="text" id="apellidoDueno" name="apellidoDueno" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="direccion" class="form-label">Dirección:</label>
                        <input type="text" id="direccion" name="direccion" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="telefono" class="form-label">Teléfono:</label>
                        <input type="text" id="telefono" name="telefono" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                    <div class="col-12">
                        <button type="submit" name="ok" class="btn btn-primary">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="News" class="tabcontent">
    <div class="container mt-3">
        <div class="card">
            <div class="card-header">
                <h2>Clientes Registrados</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="myTable">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Dirección</th>
                                <th>Teléfono</th>
                                <th>Email</th>
                                <th>Actualizar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listar as $info): ?>
                                <tr>
                                    <td><?php echo $info['nombre']; ?></td>
                                    <td><?php echo $info['apellido']; ?></td>
                                    <td><?php echo $info['direccion']; ?></td>
                                    <td><?php echo $info['telefono']; ?></td>
                                    <td><?php echo $info['email']; ?></td>
                                    <td>
                                        <button class="btn btn-warning btn-update" 
                                                data-id="<?php echo $info['idDueno']; ?>"
                                                data-nombre="<?php echo $info['nombre']; ?>"
                                                data-apellido="<?php echo $info['apellido']; ?>"
                                                data-direccion="<?php echo $info['direccion']; ?>"
                                                data-telefono="<?php echo $info['telefono']; ?>"
                                                data-email="<?php echo $info['email']; ?>"
                                                data-toggle="modal" data-target="#updateModal">
                                            Actualizar
                                        </button>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger btn-delete" 
                                                data-id="<?php echo $info['idDueno']; ?>"
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
    </div>

    <!-- Modal de Actualización -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="updateForm" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Actualizar Cliente</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">Actualizar</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="updateId" name="id">
                        <div class="form-group">
                            <label for="updateNombre" class="text-black">Nombre</label>
                            <input type="text" class="form-control" id="updateNombre" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="updateApellido" class="text-black">Apellido</label>
                            <input type="text" class="form-control" id="updateApellido" name="apellido" required>
                        </div>
                        <div class="form-group">
                            <label for="updateDireccion" class="text-black">Dirección</label>
                            <input type="text" class="form-control" id="updateDireccion" name="direccion" required>
                        </div>
                        <div class="form-group">
                            <label for="updateTelefono" class="text-black">Teléfono</label>
                            <input type="tel" class="form-control" id="updateTelefono" name="telefono" pattern="[0-9]{8}" required>
                        </div>
                        <div class="form-group">
                            <label for="updateEmail" class="text-black">Email</label>
                            <input type="email" class="form-control" id="updateEmail" name="email" required>
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

    <!-- Modal de Eliminación -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="deleteForm" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Eliminar Cliente</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">Eliminar</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="deleteId" name="id">
                        <p>¿Estás seguro de que deseas eliminar este cliente?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" name="delete" class="btn btn-danger">Eliminar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<script>
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

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();

$(document).ready(function() {
    $('#myTable').DataTable({
        responsive: true
    });

    // Rellenar el modal de actualización con los datos del cliente
    $('.btn-update').on('click', function() {
        $('#updateId').val($(this).data('id'));
        $('#updateNombre').val($(this).data('nombre'));
        $('#updateApellido').val($(this).data('apellido'));
        $('#updateDireccion').val($(this).data('direccion'));
        $('#updateTelefono').val($(this).data('telefono'));
        $('#updateEmail').val($(this).data('email'));
    });

    // Rellenar el modal de eliminación
    $('.btn-delete').on('click', function() {
        $('#deleteId').val($(this).data('id'));
    });
});
</script>



<?php
if (isset($_POST['ok2'])) {
    $mascota = new Mascota();
    $mascota->setNombre($_POST['nombreMascota']);
    $mascota->setFechaNacimiento($_POST['fechaNacimiento']);
    $mascota->setDificultades($_POST['dificultades']);
    $mascota->setOtraInformacion($_POST['otraInformacion']);
    $mascota->setRazaAnimal($_POST['razaAnimal']);
    $mascota->setTipoAnimal($_POST['tipoAnimal']);
    $mascota->setIdDueno($_POST['idDueno']);

    if ($mascotacontroller->insertarMascota($mascota)) {
        echo "<script>
                Swal.fire({
                    title: 'Registrada!',
                    text: 'La mascota ha sido registrada exitosamente.',
                    icon: 'success'
                }).then(() => {
                    window.location.replace('Clientes');
                });
              </script>";
        exit;
    } else {
        echo "<script>
                Swal.fire({
                    title: 'Error!',
                    text: 'Error al agregar mascota al cliente.',
                    icon: 'error'
                });
              </script>";
    }
}


if (isset($_POST['ok'])) {
    // Procesar el formulario de registro
    $cliente = new Dueno();
    $cliente->setNombre($_POST['nombreDueno']);
    $cliente->setApellido($_POST['apellidoDueno']);
    $cliente->setDireccion($_POST['direccion']);
    $cliente->setTelefono($_POST['telefono']);
    $cliente->setEmail($_POST['email']);

    if ($clientecontroller->insertarclientes($cliente)) {
        echo "<script>
                Swal.fire({
                    title: 'Registrado!',
                    text: 'El cliente ha sido registrado exitosamente.',
                    icon: 'success'
                }).then(() => {
                    window.location.replace('Clientes');
                });
              </script>";
        exit;
    } else {
        echo "<script>
                Swal.fire({
                    title: 'Error!',
                    text: 'Error al insertar los datos del cliente.',
                    icon: 'error'
                });
              </script>";
    }
} elseif (isset($_POST['update'])) {
    // Procesar el formulario de actualización
    $cliente = new Dueno();
    $cliente->setNombre($_POST['nombre']);
    $cliente->setApellido($_POST['apellido']);
    $cliente->setDireccion($_POST['direccion']);
    $cliente->setTelefono($_POST['telefono']);
    $cliente->setEmail($_POST['email']);
    $id = $_POST['id'];

    if ($clientecontroller->actualizarCliente($id, $cliente)) {
        echo "<script>
                Swal.fire({
                    title: 'Actualizado!',
                    text: 'Los datos del cliente han sido actualizados exitosamente.',
                    icon: 'success'
                }).then(() => {
                    window.location.replace('Clientes');
                });
              </script>";
        exit;
    } else {
        echo "<script>
                Swal.fire({
                    title: 'Error!',
                    text: 'Error al actualizar los datos del cliente.',
                    icon: 'error'
                });
              </script>";
    }
} elseif (isset($_POST['delete'])) {
    // Procesar el formulario de eliminación
    $id = $_POST['id'];

    if ($clientecontroller->eliminarCliente($id)) {
        echo "<script>
                Swal.fire({
                    title: 'Eliminado!',
                    text: 'El cliente ha sido eliminado exitosamente.',
                    icon: 'success'
                }).then(() => {
                    window.location.replace('Clientes');
                });
              </script>";
        exit;
    } else {
        echo "<script>
                Swal.fire({
                    title: 'Error!',
                    text: 'Error al eliminar los datos del cliente.',
                    icon: 'error'
                });
              </script>";
    }
} ?>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
