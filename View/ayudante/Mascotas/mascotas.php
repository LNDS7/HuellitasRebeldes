<?php
// Instanciar controladores
$listarcliente = new ClientesController();
$veterinario = new CitaController();
$mascotacontroller = new MascotaController();
$clientecontroller = new ClientesController();

// Obtener lista de clientes y nombres de veterinarios
$listar = $listarcliente->listarCliente();
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
  width: 100%;
}

.tablink:hover {
  background-color: #777;
}

label,p {
    color: #333; /* Color más oscuro para mejor visibilidad */
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

<button class="tablink" onclick="openPage('News', this, 'lightseagreen')" id="defaultOpen">Ver lista</button>

<!--<div id="Home" class="tabcontent">
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
</div>-->

<div id="News" class="tabcontent">
    <div class="container mt-3">
        <div class="card">
            <div class="card-header">
                <h2>Clientes Registrados</h2>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="myTable">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Dirección</th>
                            <th>Teléfono</th>
                            <th>Email</th>
                            <th>Actualizar</th>
                            <!--<th>Eliminar</th>-->
                            <th>Agregar Mascota</th>
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
                            <!--<td>
                                <button class="btn btn-danger btn-delete" 
                                        data-id="<?php echo $info['idDueno']; ?>"
                                        data-toggle="modal" data-target="#deleteModal">
                                    Eliminar
                                </button>
                            </td>-->
                            <td>
                                <button class="btn btn-dark btn-agregar-mascota" 
                                        data-id="<?php echo $info['idDueno']; ?>"
                                        data-nombre="<?php echo $info['nombre']; ?>"
                                        data-toggle="modal" data-target="#agregarmascotamodal">
                                    Agregar Mascota para <?php echo $info['nombre']; ?>
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

<!-- Modal para Actualizar -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Actualizar Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="updateForm">
                <div class="modal-body">
                    <input type="hidden" id="updateId" name="id" value="">
                    <div class="form-group">
                        <label for="updateNombre">Nombre:</label>
                        <input type="text" id="updateNombre" name="nombre" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="updateApellido">Apellido:</label>
                        <input type="text" id="updateApellido" name="apellido" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="updateDireccion">Dirección:</label>
                        <input type="text" id="updateDireccion" name="direccion" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="updateTelefono">Teléfono:</label>
                        <input type="text" id="updateTelefono" name="telefono" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="updateEmail">Email:</label>
                        <input type="email" id="updateEmail" name="email" class="form-control" required>
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
                <h5 class="modal-title" id="deleteModalLabel">Eliminar Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="deleteForm">
                <div class="modal-body">
                    <input type="hidden" id="deleteId" name="id" value="">
                    ¿Está seguro de que desea eliminar este cliente?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" name="delete" class="btn btn-danger">Eliminar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para Agregar Mascota -->
<div class="modal fade" id="agregarmascotamodal" tabindex="-1" role="dialog" aria-labelledby="agregarmascotamodalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarmascotamodalLabel">Agregar Mascota</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="agregarMascotaForm">
                <div class="modal-body">
                    <input type="hidden" id="idDuenoMascota" name="idDueno" value="">
                    <div class="form-group">
                        <label for="nombreMascota">Nombre de la Mascota:</label>
                        <input type="text" id="nombreMascota" name="nombreMascota" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="fechaNacimiento">Fecha de Nacimiento:</label>
                        <input type="date" id="fechaNacimiento" name="fechaNacimiento" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="dificultades">Dificultades:</label>
                        <input type="text" id="dificultades" name="dificultades" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="otraInformacion">Otra Información:</label>
                        <input type="text" id="otraInformacion" name="otraInformacion" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="razaAnimal">Raza:</label>
                        <input type="text" id="razaAnimal" name="razaAnimal" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="tipoAnimal">Tipo de Animal:</label>
                        <input type="text" id="tipoAnimal" name="tipoAnimal" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" name="ok2" class="btn btn-primary">Agregar Mascota</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#myTable').DataTable();

    // Manejo de actualización
    $('.btn-update').on('click', function() {
        $('#updateId').val($(this).data('id'));
        $('#updateNombre').val($(this).data('nombre'));
        $('#updateApellido').val($(this).data('apellido'));
        $('#updateDireccion').val($(this).data('direccion'));
        $('#updateTelefono').val($(this).data('telefono'));
        $('#updateEmail').val($(this).data('email'));
    });

    // Manejo de eliminación
    $('.btn-delete').on('click', function() {
        $('#deleteId').val($(this).data('id'));
    });

    // Manejo de agregar mascota
    $('.btn-agregar-mascota').on('click', function() {
        $('#idDuenoMascota').val($(this).data('id'));
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
// Procesar formulario para agregar mascota
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
                    title: 'Mascota Agregada!',
                    text: 'La mascota ha sido agregada exitosamente.',
                    icon: 'success'
                }).then(() => {
                    window.location.replace('Mascotas');
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

// Procesar formulario para insertar cliente
if (isset($_POST['ok'])) {
    $cliente = new Dueno();
    $cliente->setNombre($_POST['nombreDueno']);
    $cliente->setApellido($_POST['apellidoDueno']);
    $cliente->setDireccion($_POST['direccion']);
    $cliente->setTelefono($_POST['telefono']);
    $cliente->setEmail($_POST['email']);

    if ($clientecontroller->insertarclientes($cliente)) {
        echo "<script>
                Swal.fire({
                    title: 'Cliente Agregado!',
                    text: 'El cliente ha sido agregado exitosamente.',
                    icon: 'success'
                }).then(() => {
                    window.location.replace('Mascotas');
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
    // Procesar actualización de cliente
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
                    title: 'Cliente Actualizado!',
                    text: 'Los datos del cliente han sido actualizados exitosamente.',
                    icon: 'success'
                }).then(() => {
                    window.location.replace('Mascotas');
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
    // Procesar eliminación de cliente
    $id = $_POST['id'];

    if ($clientecontroller->eliminarCliente($id)) {
        echo "<script>
                Swal.fire({
                    title: 'Cliente Eliminado!',
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
}?>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
