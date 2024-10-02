<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Error 404</title>
    <style>
        body {
            background-color: black;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            color: white;
        }
        .btn-volver {
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn-volver:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Página no encontrada (404)</h1>
    <p>Lo sentimos, la página que buscas no existe.</p>
    <a href="javascript:history.back()" class="btn-volver">Volver</a>
</body>
</html>
