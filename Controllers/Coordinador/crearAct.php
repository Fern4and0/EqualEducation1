<?php

session_start();

include '../../DB/DB.php';

$programa_id = $_POST["programa_id"];
$nombre = $_POST["nombre"];
$fecha = $_POST["fecha"];
$descripcion = $_POST["descripcion"];

// Preparar la consulta SQL para insertar datos
$sql = "INSERT INTO actividades (programa_id, nombre, objetivo, descripcion, fecha)
        VALUES ('$programa_id', '$nombre', 'prueba','$descripcion', '$fecha')";

// Ejecutar la consulta
if ($conn->query($sql) === TRUE) {
    header("Location: /EqualEducation/Resources/views/actividades.php");
    die();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar conexión
$conn->close();

?>