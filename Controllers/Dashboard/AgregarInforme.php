<?php
// Controllers/AgregarInforme.php

session_start();

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: ../Resources/Views/Login.html");
    exit();
}

include '../../DB/db.php'; // Incluye la conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $programa_id = $_POST['programa_id'];
    $tipo = $_POST['tipo'];
    $contenido = $_POST['contenido'];
    $fecha = $_POST['fecha'];

    // Inserta el nuevo informe en la base de datos
    $sql = "INSERT INTO informes (programa_id, tipo, contenido, fecha) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isss", $programa_id, $tipo, $contenido, $fecha);

    if ($stmt->execute()) {
        header("Location: Informes.php"); // Redirige de nuevo a la página de informes
    } else {
        echo "Error al agregar el informe: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
