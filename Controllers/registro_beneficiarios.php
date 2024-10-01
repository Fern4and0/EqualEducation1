<?php

session_start();

include '../DB/DB.php';

$nombre = $_POST['nombre'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$direccion = $_POST['direccion'];
$nivel_edu = $_POST['nivel_edu'];
$situacion_eco = $_POST['situacion_eco'];
$programa_asig = $_POST['programa_asig'];

// Preparar la consulta SQL para insertar datos
$sql = "INSERT INTO beneficiarios (nombre, fecha_nacimiento, direccion, nivel_edu, situacion_eco, programa_asig)
        VALUES ('$nombre', '$fecha_nacimiento', '$direccion', '$nivel_edu', '$situacion_eco', '$programa_asig')";

// Ejecutar la consulta
if ($conn->query($sql) === TRUE) {
    echo "Registro agregado exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar conexión
$conn->close();

?>