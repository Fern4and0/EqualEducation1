<?php
session_start(); // Inicia la sesión

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: ../Resources/Views/Login.html"); // Redirige al login si no está autenticado
    exit(); // Detiene la ejecución
}

include '../../DB/db.php'; // Incluye la conexión a la base de datos

// Verifica si se ha enviado el formulario de edición
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $programa = $_POST['programa'];
    $tipo = $_POST['tipo'];
    $fecha = $_POST['fecha'];
    $contenido = $_POST['contenido'];

    // Prepara la consulta SQL para actualizar el informe
    $sql = "UPDATE informes SET programa=?, tipo=?, fecha=?, contenido=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $programa, $tipo, $fecha, $contenido, $id);

    // Ejecuta la consulta y verifica si se actualizó correctamente
    if ($stmt->execute()) {
        header("Location: Informes.php"); // Redirige a la página de informes
        exit();
    } else {
        echo "Error al actualizar el informe: " . $conn->error;
    }

    $stmt->close();
}

$conn->close(); // Cierra la conexión a la base de datos
?>