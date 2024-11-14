<?php

session_start();

include '../../DB/DB.php';

$actividad_id = $_POST["id"];
$programa_id = $_POST["programa_id"];
$nombre = $_POST["nombre"];
$fecha = $_POST["fecha"];
$descripcion = $_POST["descripcion"];

// Preparar la consulta SQL para insertar datos
$sql = "UPDATE actividades SET nombre = '$nombre', fecha = '$fecha', 
        descripcion = '$descripcion' WHERE programa_id = '$programa_id' AND id = '$actividad_id'";

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