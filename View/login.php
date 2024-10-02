<?php 
$usuario_controller = new Usuario_controller();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url(https://wallpapercave.com/wp/wp3123618.jpg);
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            backface-visibility: initial;
            background-attachment: fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            max-width: 500px;
            background-color: rgba(255, 255, 255, 0.7);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-container {
            display: none;
        }

        .active {
            display: block;
        }

        h2 {
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
        <!-- Formulario de Inicio de Sesión -->
        <div id="loginForm" class="form-container active">
            <center>
                <li class="nav-item text-center mb-3">
                    <img src="logo/logo.jpg" alt="Avatar" class="avatar" width="100px" height="80px">
                </li>
            </center>
            <h2 class="text-center">Iniciar Sesión</h2>
            <form method="POST">
                <div class="mb-3">
                    <label for="loginusuario" class="form-label">Usuario</label>
                    <input type="text" class="form-control" id="loginusuario" name="loginusuario" required>
                </div>
                <div class="mb-3">
                    <label for="clave" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="clave" name="clave" required>
                </div>
                <button type="submit" class="btn btn-primary w-100" name="enviar">Iniciar Sesión</button>
                <p class="mt-3 text-center">
                    ¿No tienes cuenta? <a href="#" onclick="toggleForms()">Crear una cuenta</a>
                </p>
            </form>
        </div>

        <!-- Formulario de Registro -->
        <div id="registerForm" class="form-container">
            <h2 class="text-center">Crear Cuenta</h2>
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
                <button type="submit" class="btn btn-success w-100" name="ok">Registrar</button>
                <p class="mt-3 text-center">
                    ¿Ya tienes cuenta? <a href="#" onclick="toggleForms()">Iniciar Sesión</a>
                </p>
            </form>
        </div>
    </div>

    <script>
        function toggleForms() {
            var loginForm = document.getElementById('loginForm');
            var registerForm = document.getElementById('registerForm');
            loginForm.classList.toggle('active');
            registerForm.classList.toggle('active');
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php 
    if (isset($_POST["enviar"])) {
        if (empty($_POST["loginusuario"]) || empty($_POST["clave"])) {
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Por favor, complete ambos campos.'
                    });
                </script>";
        } else {
            $loginusuario = htmlspecialchars($_POST["loginusuario"]);
            $clave = htmlspecialchars($_POST["clave"]);
            $ob = $usuario_controller->login(new Usuario($loginusuario, null, null, $clave));

            if (!empty($ob)) {
                foreach ($ob as $usuario) {
                    $_SESSION["nivel"] = ($usuario->getRol() == 1) ? "admin" : (($usuario->getRol() == 2) ? "ayudante" : "user");
                    $_SESSION["usuario"] = $usuario;
                    $_SESSION["loginusuario"] = $loginusuario; // Guarda el nombre de usuario en la sesión
                    echo "<script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Bienvenido',
                                text: 'Has iniciado sesión exitosamente.'
                            }).then(() => {
                                window.location.replace('index.php');
                            });
                          </script>";
                    exit;
                }
            } else {
                echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Usuario o contraseña incorrectos.'
                        });
                    </script>";
            }
        }
    }
    
    if (isset($_POST["ok"])) {
        $user = new Usuario();
        $user->setLoginusuario($_POST["loginusuario"]);
        $user->setNomUsuario($_POST["nom_usuario"]);
        $user->setEmail($_POST["email"]);
        $user->setClave($_POST["clave"]);
        $user->setRol(3); // Cambia esto según tu lógica para determinar el rol

        if ($usuario_controller->agregar($user)) {
            echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: 'Usuario registrado exitosamente.'
                    }).then(() => {
                        window.location.replace('index.php');
                    });
                </script>";
            exit;
        }
    }
    ?>
</body>

</html>
