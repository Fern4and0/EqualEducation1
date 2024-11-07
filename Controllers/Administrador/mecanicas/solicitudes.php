<?php
// solicitudes.php

// Incluir el archivo de conexión a la base de datos
include '../../DB/db.php'; // Incluye la conexión a la base de datos

// Verificar si la solicitud es de tipo POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $id_users = $_POST['id_users'];
    $nombre = $_POST['nombre'];
    $motivacion = $_POST['motivacion'];

    // Verificar el tipo de solicitud
    if (isset($_POST['ingresos_mensuales'])) {
        // Solicitud de Beneficiario
        $ingresos_mensuales = $_POST['ingresos_mensuales'];
        $query = "INSERT INTO beneficiarios (id_users, nombre, ingresos_mensuales, motivacion) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("isds", $id_users, $nombre, $ingresos_mensuales, $motivacion);
    } elseif (isset($_POST['experiencia_laboral'])) {
        // Solicitud de Coordinador
        $experiencia_laboral = $_POST['experiencia_laboral'];
        $query = "INSERT INTO coordinadores (id_users, nombre, experiencia_laboral, motivacion) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("isss", $id_users, $nombre, $experiencia_laboral, $motivacion);
    } elseif (isset($_POST['ocupacion'])) {
        // Solicitud de Voluntario
        $ocupacion = $_POST['ocupacion'];
        $query = "INSERT INTO voluntarios (id_users, nombre, ocupacion, motivacion) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("isss", $id_users, $nombre, $ocupacion, $motivacion);
    }

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Solicitud enviada exitosamente.";
    } else {
        echo "Error al enviar la solicitud: " . $stmt->error;
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conn->close();
}
?>