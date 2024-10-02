<?php
$usuario_controller = new Usuario_controller();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Estilos CSS personalizados -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-container {
            max-width: 500px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-container h2 {
            margin-bottom: 20px;
            color: #343a40;
        }
        .btn-custom {
            background-color: #28a745;
            color: #ffffff;
        }
        .btn-custom:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="form-container">
            <h2 class="text-center">Registro de Usuario</h2>
            <form method="POST">
                <div class="mb-3">
                    <label for="loginusuario" class="form-label">Nombre de Usuario (Login)</label>
                    <input type="text" class="form-control" id="loginusuario" name="loginusuario" required>
                </div>
                <div class="mb-3">
                    <label for="nom_usuario" class="form-label">Nombre Completo</label>
                    <input type="text" class="form-control" id="nom_usuario" name="nom_usuario" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="clave" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="clave" name="clave" required>
                </div>
                <div class="mb-3">
                    <label for="administrador" class="form-label">Tipo de Usuario</label>
                    <select class="form-select" id="administrador" name="administrador" required>
                        <option value="1">Administrador</option>
                        <option value="0">Cliente</option>
                        <option value="2">Ayudante</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-custom w-100" name="ok">Registrar</button>
            </form>
        </div>
    </div>
        <?php 
        // Procesar formulario para registrar usuario
if (isset($_POST["ok"])) {
    $user = new Usuario();
    $user->setLoginusuario($_POST["loginusuario"]);
    $user->setNomUsuario($_POST["nom_usuario"]);
    $user->setEmail($_POST["email"]);
    $user->setClave($_POST["clave"]);
    
    // Asignar el rol basado en el formulario
    $user->setRol((int)$_POST["administrador"]); // Convertir a entero

    if ($usuario_controller->agregar($user)) {
        echo "<script>
                Swal.fire({
                    title: 'Registro Exitoso!',
                    text: 'El usuario ha sido registrado exitosamente.',
                    icon: 'success'
                }).then(() => {
                    window.location.replace('Registro');
                });
              </script>";
        exit;
    } else {
        echo "<script>
                Swal.fire({
                    title: 'Error!',
                    text: 'Error al registrar el usuario.',
                    icon: 'error'
                });
              </script>";
    }
}?>
    <!-- Bootstrap 5 JS (opcional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
