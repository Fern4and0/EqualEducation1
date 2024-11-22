<?php
// Iniciar sesión (asegurar que no se inicie varias veces)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Incluir la conexión a la base de datos
include '../DB/DB.php';  // Asegúrate de que el archivo DB.php tenga la variable $conn correctamente configurada

// Verificar que la conexión a la base de datos sea exitosa
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si el usuario está registrado y tiene sesión activa
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];  // Obtener el user_id de la sesión actual

    // Obtener los datos del formulario
    $experiencia = $_POST['experiencia'];
    $habilidades = $_POST['habilidades'];
    $motivacion = $_POST['motivacion'];

    // 1. Actualizar el rol del usuario a 2 (Coordinador)
    $rol_id = 2;  // Asignar el valor del rol a una variable
    $stmt_update_rol = $conn->prepare("UPDATE users SET id_rol = ? WHERE id = ?");
    $stmt_update_rol->bind_param("ii", $rol_id, $user_id);

    if (!$stmt_update_rol->execute()) {
        echo "Error al actualizar el rol del usuario: " . $stmt_update_rol->error;
        exit;
    }

    // 2. Insertar los datos del coordinador en la tabla `coordinadores`
    $stmt_coordinadores = $conn->prepare("INSERT INTO coordinadores (user_id, experiencia, habilidades, motivacion) VALUES (?, ?, ?, ?)");
    $stmt_coordinadores->bind_param("isss", $user_id, $experiencia, $habilidades, $motivacion);

    if ($stmt_coordinadores->execute()) {
        echo "Datos del coordinador guardados correctamente.";
    } else {
        echo "Error al guardar los datos del coordinador: " . $stmt_coordinadores->error;
    }

    // Cerrar las consultas
    $stmt_update_rol->close();
    $stmt_coordinadores->close();
} else {
    echo "No hay sesión activa. El usuario no está registrado.";
}

// Cerrar la conexión
$conn->close();
?>