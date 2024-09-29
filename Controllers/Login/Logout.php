<?php
// Controllers/logout.php

session_start(); // Inicia la sesión, o reanuda la sesión existente

// Destruye la sesión
session_unset(); // Elimina todas las variables de sesión almacenadas
session_destroy(); // Destruye la sesión actual

// Redirige al usuario a la página de inicio de sesión
header("Location: ../../Resources/Views/Login.html"); // Envía una cabecera HTTP para redirigir al usuario a la página de inicio de sesión
exit(); // Termina la ejecución del script para asegurarse de que no se ejecuta ningún código adicional
?>
