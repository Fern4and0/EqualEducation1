<?php

session_start();

include '../../DB/DB.php';

$actividad_id = $_POST["id"];
$programa_id = $_POST["programa_id"];

// Preparar la consulta SQL para insertar datos
$sql = "DELETE FROM actividades WHERE id = $actividad_id AND programa_id = $programa_id";

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