<?php
session_start(); // Inicia la sesión

include '../../DB/db.php'; // Conexión a la base de datos

// Verifica si la solicitud es de tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtén los datos del formulario
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $fecha_nacimiento = $conn->real_escape_string($_POST['fecha_nacimiento']);
    $direccion = $conn->real_escape_string($_POST['direccion']);
    $nivel_edu = $conn->real_escape_string($_POST['nivel_edu']);
    $situacion_eco = $conn->real_escape_string($_POST['situacion_eco']);
    $fecha_de_ingr = $conn->real_escape_string($_POST['fecha_de_ingr']);

    // Prepara la consulta SQL para insertar la solicitud en la tabla de solicitudes
    $stmt = $conn->prepare("INSERT INTO solicitudes (nombre, fecha_nacimiento, direccion, nivel_edu, situacion_eco, fecha_de_ingr, estado)
            VALUES (?, ?, ?, ?, ?, ?, 'pendiente')");
    $stmt->bind_param("ssssss", $nombre, $fecha_nacimiento, $direccion, $nivel_edu, $situacion_eco, $fecha_de_ingr);

    // Ejecuta la consulta y verifica si se insertó correctamente
    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Solicitud enviada exitosamente.</div>";
        // Redirige al usuario a otra página si es necesario
    } else {
        echo "<div class='alert alert-danger'>Error: No se pudo enviar la solicitud. " . $stmt->error . "</div>";
    }

    $stmt->close();
    $conn->close();
}
?>
