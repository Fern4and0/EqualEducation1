<?php

session_start();

include '../../DB/DB.php';

$user_id = $_POST["user_id"];
$nombre = $_POST["nombre"];
$fecha_ini = $_POST["fecha_ini"];
$fecha_fin = $_POST["fecha_fin"];
$descripcion = $_POST["descripcion"];

// Preparar la consulta SQL para insertar datos
$sql = "INSERT INTO programas (nombre, objetivo, descripcion, user_id, fecha_inicio, fecha_final)
        VALUES ('$nombre', 'prueba','$descripcion', '$user_id', '$fecha_ini', '$fecha_fin')";

// Ejecutar la consulta
if ($conn->query($sql) === TRUE) {
    header("Location: /EqualEducation/Resources/views/panelCoordi.php");
    die();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar conexión
$conn->close();

?>