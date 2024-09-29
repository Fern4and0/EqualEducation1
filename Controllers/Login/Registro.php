<?php
// Controllers/Registro.php

// Incluimos la conexión a la base de datos
include '../../DB/DB.php';
include '../DB/DB.php';

// Verificamos si el método de la solicitud es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoge los datos del formulario
    $nombre = $_POST['nombre']; // Recoge el nombre del formulario
    $email = $_POST['email']; // Recoge el email del formulario
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hasheamos la contraseña usando BCRYPT

    // Asignar id_rol por defecto
    $id_rol = 2; // Por ejemplo, rol de usuario común

    // Inserta los datos en la base de datos
    $sql = "INSERT INTO users (nombre, email, password, id_rol) VALUES ('$nombre', '$email', '$password', '$id_rol')";

    // Ejecuta la consulta y verifica si fue exitosa
    if ($conn->query($sql) === TRUE) {
        echo "Registro exitoso!"; // Muestra un mensaje de éxito
        // Redirigir a otra página si es necesario
        // header('Location: index.php');
    } else {
        // Muestra un mensaje de error si la consulta falló
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Cierra la conexión a la base de datos
    $conn->close();
}
?>
