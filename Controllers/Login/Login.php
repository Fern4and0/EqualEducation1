<?php
// Controllers/login.php

session_start(); // Iniciamos la sesión

include '../../DB/DB.php'; // Incluimos la conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Verificamos si la solicitud es de tipo POST
    $email = $_POST['email']; // Obtenemos el email del formulario
    $password = $_POST['password']; // Obtenemos el password del formulario

    // Consulta para verificar si el usuario existe
    $sql = "SELECT * FROM users WHERE email='$email'"; // Preparamos la consulta SQL
    $result = $conn->query($sql); // Ejecutamos la consulta

    if ($result->num_rows > 0) { // Verificamos si la consulta devolvió algún resultado
        $user = $result->fetch_assoc(); // Obtenemos los datos del usuario

        // Verificamos si el password coincide
        if (password_verify($password, $user['password'])) { // Comparamos el password ingresado con el almacenado
            // Guardamos la información del usuario en la sesión
            $_SESSION['user_id'] = $user['id']; // Guardamos el ID del usuario en la sesión
            $_SESSION['user_name'] = $user['nombre']; // Guardamos el nombre del usuario en la sesión
            $_SESSION['user_email'] = $user['email']; // Guardamos el email del usuario en la sesión
            $_SESSION['user_rol'] = $user['id_rol']; // Guardamos el rol del usuario en la sesión

            // Redirigir al dashboard
            header("Location: ../Dashboard/Dashboard.php"); // Redirigimos al usuario al dashboard
            exit(); // Terminamos la ejecución del script
        } else {
            $error = "Contraseña incorrecta."; // Mensaje de error si el password no coincide
        }
    } else {
        $error = "Usuario no encontrado."; // Mensaje de error si el usuario no existe
    }

    $conn->close(); // Cerramos la conexión a la base de datos
}
?>