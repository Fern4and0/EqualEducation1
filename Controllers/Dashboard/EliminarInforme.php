<?php
session_start(); // Inicia la sesión

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: ../Resources/Views/Login.html"); // Redirige al login si no está autenticado
    exit(); // Detiene la ejecución
}

include '../../DB/db.php'; // Incluye la conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    // Prepara la consulta SQL para eliminar el informe
    $stmt = $conn->prepare("DELETE FROM informes WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Redirige a la página de informes con un mensaje de éxito
        header("Location: Informes.php?message=Informe eliminado exitosamente");
    } else {
        // Redirige a la página de informes con un mensaje de error
        header("Location: Informes.php?message=Error al eliminar el informe");
    }

    $stmt->close();
}

$conn->close(); // Cierra la conexión
?>