<?php
// Asegúrate de incluir el controlador adecuado
$listarveterinario = new VeterinarioController();
$listar_veterinarios = $listarveterinario->listarVeterinarios();

$veterinariocontroller = new VeterinarioController();
?>


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
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
label,p {
    color: #333; /* Color más oscuro para mejor visibilidad */
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

<button class="tablink" onclick="openPage('Home', this, 'lightseagreen')">Agregar Veterinario</button>
<button class="tablink" onclick="openPage('News', this, 'lightseagreen')" id="defaultOpen">Ver lista</button>

<div id="Home" class="tabcontent">
    <div class="container mt-2">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Llenar Datos del Cliente</h2>
                <form method="post" action="" class="row g-3" id="for">
                    <div class="col-md-6">
                        <label for="nombreDueno" class="form-label">Nombre:</label>
                        <input type="text" id="nombreDueno" name="nombreVeterinario" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="apellidoDueno" class="form-label">Apellido:</label>
                        <input type="text" id="apellidoDueno" name="apellidoVeterinario" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="especialidad">Especialidad</label>
                        <input type="text" class="form-control" id="especialidad" name="especialidad" required>
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
        <h2>Veterinarios Registrados</h2>
      </div>
      <div class="card-body">
        <table class="table table-striped" id="myTable">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>Especialidad</th>
              <th>Teléfono</th>
              <th>Email</th>
              <th>Actualizar</th>
              <th>Eliminar</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($listar_veterinarios as $veterinario): ?>
              <tr>
                <td><?php echo $veterinario['nombre']; ?></td>
                <td><?php echo $veterinario['apellido']; ?></td>
                <td><?php echo $veterinario['especialidad']; ?></td>
                <td><?php echo $veterinario['telefono']; ?></td>
                <td><?php echo $veterinario['email']; ?></td>
                <td>
                  <button class="btn btn-warning btn-update" 
                          data-id="<?php echo $veterinario['idVeterinario']; ?>"
                          data-nombre="<?php echo $veterinario['nombre']; ?>"
                          data-apellido="<?php echo $veterinario['apellido']; ?>"
                          data-especialidad="<?php echo $veterinario['especialidad']; ?>"
                          data-telefono="<?php echo $veterinario['telefono']; ?>"
                          data-email="<?php echo $veterinario['email']; ?>"
                          data-toggle="modal" data-target="#updateModal">
                    Actualizar
                  </button>
                </td>
                <td>
                  <button class="btn btn-danger btn-delete" 
                          data-id="<?php echo $veterinario['idVeterinario']; ?>"
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

  <!-- Modal de Actualización -->
  <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="updateForm" method="post">
          <div class="modal-header">
            <h5 class="modal-title" id="updateModalLabel">Actualizar Veterinario</h5>
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
              <label for="updateEspecialidad" class="text-black">Especialidad</label>
              <input type="text" class="form-control" id="updateEspecialidad" name="especialidad" required>
            </div>
            <div class="form-group">
              <label for="updateTelefono" class="text-black">Teléfono</label>
              <input type="tel" class="form-control" id="updateTelefono" name="telefono">
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
        <form method="post">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteModalLabel">Confirmar Eliminación</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">Eliminar</span>
            </button>
          </div>
          <div class="modal-body">
            <p>¿Estás seguro de que deseas eliminar este veterinario?</p>
            <input type="hidden" id="deleteId" name="id">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" name="delete" class="btn btn-danger">Eliminar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#myTable').DataTable();
});

function openPage(pageName, btn, color) {
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
  btn.style.backgroundColor = color;
}

document.getElementById("defaultOpen").click();

// Llenar los campos del formulario de actualización
$(document).on('click', '.btn-update', function() {
    $('#updateId').val($(this).data('id'));
    $('#updateNombre').val($(this).data('nombre'));
    $('#updateApellido').val($(this).data('apellido'));
    $('#updateEspecialidad').val($(this).data('especialidad'));
    $('#updateTelefono').val($(this).data('telefono'));
    $('#updateEmail').val($(this).data('email'));
});

// Manejar la eliminación
$(document).on('click', '.btn-delete', function() {
    $('#deleteId').val($(this).data('id'));
});
</script>

<?php 

if (isset($_POST['ok'])) {
  // Procesar el formulario de registro
  $veterinario = new Veterinario();
  $veterinario->setNombre($_POST['nombreVeterinario']);
  $veterinario->setApellido($_POST['apellidoVeterinario']);
  $veterinario->setEspecialidad($_POST['especialidad']);
  $veterinario->setTelefono($_POST['telefono']);
  $veterinario->setEmail($_POST['email']);

  if ($veterinariocontroller->insertarVeterinario($veterinario)) {
      echo "<script>
              Swal.fire({
                  title: 'Registrado!',
                  text: 'El veterinario ha sido registrado exitosamente.',
                  icon: 'success'
              }).then(() => {
                  window.location.replace('Veterinarios');
              });
            </script>";
      exit;
  } else {
      echo "<script>
              Swal.fire({
                  title: 'Error!',
                  text: 'Error al insertar los datos del veterinario.',
                  icon: 'error'
              });
            </script>";
  }
} elseif (isset($_POST['update'])) {
  // Procesar el formulario de actualización
  $veterinario = new Veterinario();
  $veterinario->setNombre($_POST['nombre']);
  $veterinario->setApellido($_POST['apellido']);
  $veterinario->setEspecialidad($_POST['especialidad']);
  $veterinario->setTelefono($_POST['telefono']);
  $veterinario->setEmail($_POST['email']);
  $id = $_POST['id'];

  if ($veterinariocontroller->actualizarVeterinario($id, $veterinario)) {
      echo "<script>
              Swal.fire({
                  title: 'Actualizado!',
                  text: 'Los datos del veterinario han sido actualizados exitosamente.',
                  icon: 'success'
              }).then(() => {
                  window.location.replace('Veterinarios');
              });
            </script>";
      exit;
  } else {
      echo "<script>
              Swal.fire({
                  title: 'Error!',
                  text: 'Error al actualizar los datos del veterinario.',
                  icon: 'error'
              });
            </script>";
  }
} elseif (isset($_POST['delete'])) {
  // Procesar el formulario de eliminación
  $id = $_POST['id'];

  if ($veterinariocontroller->eliminarVeterinario($id)) {
      echo "<script>
              Swal.fire({
                  title: 'Eliminado!',
                  text: 'El veterinario ha sido eliminado exitosamente.',
                  icon: 'success'
              }).then(() => {
                  window.location.replace('Veterinarios');
              });
            </script>";
      exit;
  } else {
      echo "<script>
              Swal.fire({
                  title: 'Error!',
                  text: 'Error al eliminar los datos del veterinario.',
                  icon: 'error'
              });
            </script>";
  }
}?>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
