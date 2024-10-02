<?php

//mostrar clientes
$clientecontroller = new ClientesController();
$clientes = $clientecontroller->TotalClientes();
//mostrar veterinarios
$veterinariocontroller = new VeterinarioController();
$veterinarios = $veterinariocontroller->TotalVeterinario();

$mascotacontroller = new MascotaController();
$mascotas = $mascotacontroller->TotalMascota();

$citacontroller = new CitaController();
$citas = $citacontroller->totalCitas();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Huellitas Rebeldes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--grafico-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <link rel="stylesheet" href="estilo/letra.css">
    <link rel="stylesheet" href="estilo/tema.css">
    <style>
        .content {
            position: relative;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            padding: 20px;
            margin: 20px;
            border-radius: 10px;
            text-align: center;
            background-color: #f8f9fa;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .content:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }

        .content:hover .progress-bar {
            width: 100%;
        }

        .text {
            font-size: 1.5em;
            margin-bottom: 10px;
        }

        .number {
            font-size: 2em;
            font-weight: bold;
        }

        .progress-containercitas,
        .progress-containermascotas,
        .progress-containerclientes,
        .progress-containerveterinarios {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 5px;
        }

        .progress-containerveterinarios {
            background-color: orange;
        }

        .progress-containerclientes {
            background-color: lightseagreen;
        }

        .progress-containermascotas {
            background-color: purple;
        }

        .progress-containercitas {
            background-color: lime;
        }

        .progress-bar {
            height: 100%;
            width: 0;
            background-color: #007bff;
            transition: width 0.5s ease-in-out;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <?php foreach ($clientes as $cliente): ?>
                <div class="col-md-3">
                    <div class="content">
                        <center>
                            <svg xmlns="http://www.w3.org/2000/svg" width="40px" height="40px" fill="currentColor"
                                class="bi bi-people" viewBox="0 0 16 16">
                                <path
                                    d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4" />
                            </svg>
                        </center>
                        <div class="text">CLIENTES</div>
                        <div class="number"><?php echo $cliente['total']; ?></div>
                        <div class="progress-containerclientes">
                            <div class="progress-bar"></div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <?php foreach ($veterinarios as $veterinario): ?>
                <div class="col-md-3">
                    <div class="content">
                        <center>
                            <svg xmlns="http://www.w3.org/2000/svg" width="40px" height="40px" fill="currentColor"
                                class="bi bi-person-heart" viewBox="0 0 16 16">
                                <path
                                    d="M9 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h10s1 0 1-1-1-4-6-4-6 3-6 4m13.5-8.09c1.387-1.425 4.855 1.07 0 4.277-4.854-3.207-1.387-5.702 0-4.276Z" />
                            </svg>
                        </center>
                        <div class="text">VETERINARIOS</div>
                        <div class="number"><?php echo $veterinario['total']; ?></div>
                        <div class="progress-containerveterinarios">
                            <div class="progress-bar"></div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <?php foreach ($mascotas as $mascota): ?>
                <div class="col-md-3">
                    <div class="content">
                        <center>
                            <svg xmlns="http://www.w3.org/2000/svg" width="40px" height="40px" fill="currentColor" class="bi bi-gitlab" viewBox="0 0 16 16">
                                <path d="m15.734 6.1-.022-.058L13.534.358a.57.57 0 0 0-.563-.356.6.6 0 0 0-.328.122.6.6 0 0 0-.193.294l-1.47 4.499H5.025l-1.47-4.5A.572.572 0 0 0 2.47.358L.289 6.04l-.022.057A4.044 4.044 0 0 0 1.61 10.77l.007.006.02.014 3.318 2.485 1.64 1.242 1 .755a.67.67 0 0 0 .814 0l1-.755 1.64-1.242 3.338-2.5.009-.007a4.05 4.05 0 0 0 1.34-4.668Z" />
                            </svg>
                        </center>
                        <div class="text">MASCOTAS</div>
                        <div class="number"><?php echo $mascota['total']; ?></div>
                        <div class="progress-containermascotas">
                            <div class="progress-bar"></div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <?php foreach ($citas as $cita): ?>
                <div class="col-md-3">
                    <div class="content">
                        <center>
                            <svg xmlns="http://www.w3.org/2000/svg" width="40px" height="40px" fill="currentColor" class="bi bi-postcard-heart" viewBox="0 0 16 16">
                                <path d="M8 4.5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0zm3.5.878c1.482-1.42 4.795 1.392 0 4.622-4.795-3.23-1.482-6.043 0-4.622M2.5 5a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1z" />
                                <path fill-rule="evenodd" d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1z" />
                            </svg>
                        </center>
                        <div class="text">CITAS</div>
                        <div class="number"><?php echo $cita['total']; ?></div>
                        <div class="progress-containercitas">
                            <div class="progress-bar"></div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <hr>
    <center>
        <canvas id="myChart" style="width:100%;max-width:900px"></canvas>

        <script>
            // Define the names of the categories and their corresponding values
            const categories = ["mascotas", "citas", "Clientes", "Veterinarios"];

            // Fetch the total values from PHP
            const categoryTotals = <?php echo json_encode(array_column($mascotas, 'total')); ?>;
            const productTotals = <?php echo json_encode(array_column($citas, 'total')); ?>;
            const clientTotals = <?php echo json_encode(array_column($clientes, 'total')); ?>;
            const vetTotals = <?php echo json_encode(array_column($veterinarios, 'total')); ?>;

            // Summarize the data
            const values = [
                categoryTotals.reduce((a, b) => a + b, 0),
                productTotals.reduce((a, b) => a + b, 0),
                clientTotals.reduce((a, b) => a + b, 0),
                vetTotals.reduce((a, b) => a + b, 0)
            ];

            // Define the colors for the bars
            const barColors = ["purple", "green", "blue", "yellow"];

            // Create the chart
            new Chart("myChart", {
                type: "bar",
                data: {
                    labels: categories,
                    datasets: [{
                        backgroundColor: barColors,
                        data: values
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: "Resumen de Datos"
                    }
                }
            });
        </script>
    </center>
    <hr>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>