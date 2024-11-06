<?php
session_start(); // Inicia la sesión

// Verifica si hay una sesión activa
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../Resources/Views/Login.html"); // Redirige al login si no está autenticado
    exit();
}

include '../../../DB/db.php'; // Incluye la conexión a la base de datos

if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']); // Obtiene el ID del usuario a eliminar
    $sql = "DELETE FROM users WHERE id = ?"; // Consulta para eliminar el usuario

    // Preparar la declaración
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id); // Asigna el parámetro

    if ($stmt->execute()) {
        // Si se ejecuta correctamente, redirige al panel de usuarios
        header("Location: ../Usuarios.php?msg=Usuario actualizado con éxito");
    } else {
        // Si ocurre un error
        echo "Error al eliminar el usuario: {$conn->error}";
    }

    $stmt->close(); // Cierra la declaración
}

$conn->close(); // Cierra la conexión a la base de datos
?>
