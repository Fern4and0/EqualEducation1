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
        // Si se ejecuta correctamente, redirige a la página anterior
        $redirect_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '../Usuarios.php';
        header("Location: $redirect_url");
    } else {
        // Redirige a la página correspondiente según el rol del usuario
        switch ($_SESSION['id_rol']) {
            case 1:
                header("Location: ../Tabla/Administradores.php");
                break;
            case 2:
                header("Location: ../Tabla/Coordinador.php");
                break;
            case 3:
                header("Location: ../Tabla/Beneficiarios.php");
                break;
            case 4:
                header("Location: ../Tabla/Donadores.php");
                break;
            case 5:
                header("Location: ../Tabla/Voluntarios.php");
                break;
            default:
                header("Location: ../Usuarios.php");
                break;
        }
    }

    $stmt->close(); // Cierra la declaración
} else {
    // Si ocurre un error
    echo "Error al eliminar el usuario: {$conn->error}";
}

$conn->close(); // Cierra la conexión a la base de datos
?>