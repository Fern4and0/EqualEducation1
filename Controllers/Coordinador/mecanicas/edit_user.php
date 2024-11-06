<?php
session_start(); // Inicia la sesión

// Verifica si hay una sesión activa
if (!isset($_SESSION['user_id'])) {
    header("Location: ../Resources/Views/Login.html"); // Redirige al login si no está autenticado
    exit();
}

include '../../../DB/db.php'; // Incluye la conexión a la base de datos

// Inicializar variables
$user_id = null;
$nombre = '';
$email = '';
$id_rol = 1; // Valor por defecto

// Si se proporciona un ID de usuario en la URL
if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']); // Obtiene el ID del usuario
    $sql = "SELECT * FROM users WHERE id = ?"; // Consulta para obtener los detalles del usuario

    // Preparar la declaración
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id); // Asigna el parámetro
    $stmt->execute(); // Ejecuta la consulta
    $result = $stmt->get_result(); // Obtiene el resultado

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc(); // Obtiene el usuario
        $nombre = $user['nombre']; // Corregido de 'name' a 'nombre'
        $email = $user['email'];
        $id_rol = $user['id_rol'];
    } else {
        echo "Usuario no encontrado.";
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Procesar el formulario de edición
    $user_id = intval($_POST['id']); // Asegúrate de obtener el ID del usuario desde el formulario
    $nombre = $_POST['nombre']; // Corregido de 'name' a 'nombre'
    $email = $_POST['email'];
    $id_rol = intval($_POST['id_rol']);

    $sql = "UPDATE users SET nombre = ?, email = ?, id_rol = ? WHERE id = ?"; // Corregido de 'name' a 'nombre'

    // Preparar la declaración
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $nombre, $email, $id_rol, $user_id); // Asigna los parámetros

    if ($stmt->execute()) {
        // Si se ejecuta correctamente, redirige al panel de usuarios
        header("Location: ../Usuarios.php?msg=Usuario actualizado con éxito");
    } else {
        // Si ocurre un error
        echo "Error al actualizar el usuario: {$conn->error}";
    }

    $stmt->close(); // Cierra la declaración
}

$conn->close(); // Cierra la conexión a la base de datos
?>
