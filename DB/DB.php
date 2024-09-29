<?php
// DB/db.php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ong"; // Nombre de la base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
