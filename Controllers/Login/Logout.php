<?php
session_start(); // Iniciamos la sesión

// Destruimos todas las variables de sesión
$_SESSION = [];

// Destruir la sesión
session_destroy();

// Redirigir a la página de inicio
header("Location: /EqualEducation/inicio.php");
exit(); // Terminamos la ejecución del script
?>
