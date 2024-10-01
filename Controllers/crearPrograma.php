<?php

session_start();

include '../DB/DB.php';

$nombre = $_POST['nombre'];
$fecha_ini = $_POST['fecha_ini'];
$fecha_fin = $_POST['fecha_fin'];

// Preparar la consulta SQL para insertar datos
$sql = "INSERT INTO programs (nombre, fecha_ini, fecha_fin)
        VALUES ('$nombre', '$fecha_ini', '$fecha_fin')";

// Ejecutar la consulta
if ($conn->query($sql) === TRUE) {
    echo "Registro agregado exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>