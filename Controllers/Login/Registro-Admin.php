<?php
// Controllers/Registro-Admin.php

// Incluimos la conexión a la base de datos
include '../../DB/DB.php';

// Iniciamos la sesión
session_start();

// Verificamos si el método de la solicitud es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoge los datos del formulario
    $nombre = $_POST['nombre']; // Recoge el nombre del formulario
    $email = $_POST['email']; // Recoge el email del formulario
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hasheamos la contraseña usando BCRYPT

    // Asignar id_rol para el administrador
    $id_rol = 1; // Por ejemplo, rol de administrador

    // Inserta los datos en la base de datos
    $sql = "INSERT INTO users (nombre, email, password, id_rol) VALUES ('$nombre', '$email', '$password', '$id_rol')";

    // Ejecuta la consulta y verifica si fue exitosa
    if ($conn->query($sql) === TRUE) {
        // Iniciar sesión automáticamente
        $_SESSION['user_id'] = $conn->insert_id; // Guarda el ID del usuario en la sesión
        $_SESSION['user_name'] = $nombre; // Guarda el nombre del usuario en la sesión
        $_SESSION['user_email'] = $email; // Guarda el email del usuario en la sesión
        $_SESSION['user_role'] = $id_rol; // Guarda el rol del usuario en la sesión

        // Redirigir al dashboard
        header('Location: ../../Controllers/Administrador/Administrador-Dashboard.php');
        exit();
    } else {
        // Muestra un mensaje de error si la consulta falló
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Cierra la conexión a la base de datos
    $conn->close();
}
?>
