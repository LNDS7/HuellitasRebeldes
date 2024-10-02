<?php
session_start();
session_destroy();

// Redirigir a la página de inicio
header("location: index.php");
exit(); // Asegúrate de usar exit después de header para evitar que se ejecute más código
?>
