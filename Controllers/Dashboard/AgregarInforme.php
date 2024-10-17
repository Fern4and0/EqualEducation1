<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../Resources/Views/Login.html");
    exit();
}

include '../../DB/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $programa = $_POST['programa'];
    $tipo = $_POST['tipo'];
    $fecha = $_POST['fecha'];
    $contenido = $_POST['contenido'];

    // Insertar el nuevo informe en la base de datos
    $sql = "INSERT INTO informes (programa, tipo, fecha, contenido) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssss', $programa, $tipo, $fecha, $contenido);

    if ($stmt->execute()) {
        header("Location: Informes.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
