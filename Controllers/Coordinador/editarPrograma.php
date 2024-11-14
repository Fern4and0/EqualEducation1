<?php

session_start();

include '../../DB/DB.php';

$programaid = $_POST["id"];
$user_id = $_POST["user_id"];
$nombre = $_POST["nombre"];
$fecha_ini = $_POST["fecha_ini"];
$fecha_fin = $_POST["fecha_fin"];
$descripcion = $_POST["descripcion"];

// Preparar la consulta SQL para insertar datos
$sql = "UPDATE programas SET nombre = '$nombre', fecha_inicio = '$fecha_fin', fecha_final = '$fecha_fin',
        descripcion = '$descripcion' WHERE user_id = '$user_id' AND id = '$programaid'";

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