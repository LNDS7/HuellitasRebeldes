<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veterinaria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/blogger-sans" rel="stylesheet">
    <link rel="stylesheet" href="estilo/letra.css">
    <style>
        body {
            background-color: white;
        }
        .nav-link {
            font-size: 20px;
            padding: 15px;
        }
        .nav-link:hover {
            background-color: yellow;
            color: white;
        }
        .nav-link.active {
            font-weight: bold;
            background-color: white;
            color: black;
        }
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 60px;
            left: 0;
            z-index: 100;
            overflow-y: auto;
            background-color: white;
            width: 250px;
            padding: 20px;
        }
        .main-content {
            margin-left: 250px;
            padding-bottom: 60px;
        }
        h1.h2 {
            color: black;
        }
        .content {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: black;
            color: white;
            text-align: center;
            height: 60px;
            line-height: 60px;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1050;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
            text-align: center;
            border-radius: 8px;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
        .logout-btn {
            background-color: #f44336;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }
        .logout-btn:hover {
            opacity: 0.8;
        }
    </style>
</head>

<body>
    <main class="main-content">
        <div class="container-fluid">
            <header>
                <?php require_once("View/ayudante/menuayudante.php"); ?>
            </header>
            <main>
                <?php
                $contenido = new Contenido();
                require_once($contenido->mostrar_archivo());
                ?>
            </main>
        </div>
    </main>

    <!-- Modal de confirmación -->
    <div id="confirmModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <p>¿Estás seguro que deseas cerrar sesión?</p>
            <button class="logout-btn" onclick="logout()">Cerrar Sesión</button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function openModal() {
            document.getElementById('confirmModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('confirmModal').style.display = 'none';
        }

        function logout() {
            closeModal();
            Swal.fire({
                title: '¿Estás seguro que deseas cerrar sesión?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Cerrar Sesión'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Sesión cerrada',
                        text: 'Tu sesión ha sido cerrada exitosamente.',
                        icon: 'success',
                        timer: 2000,
                        timerProgressBar: true,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = 'cerrar.php'; // Cambia a la página de inicio de sesión
                    });
                }
            });
        }
    </script>
</body>
</html>
