<?php
// Controllers/Principal.php

session_start(); // Inicia la sesión

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: ../Resources/Views/Login.html"); // Redirige al login si no está autenticado
    exit(); // Detiene la ejecución
}

include '../../DB/db.php'; // Incluye la conexión a la base de datos

// Consulta para obtener el total de usuarios registrados
$sqlUsuarios = "SELECT COUNT(*) AS total_usuarios FROM users";
$resultUsuarios = $conn->query($sqlUsuarios); // Ejecuta la consulta
$totalUsuarios = $resultUsuarios->fetch_assoc()['total_usuarios']; // Obtiene el resultado de la consulta

// Consulta para obtener las donaciones totales
$sqlDonaciones = "SELECT COALESCE(SUM(monto), 0) AS total_donaciones FROM donaciones";
$resultDonaciones = $conn->query($sqlDonaciones); // Ejecuta la consulta
$totalDonaciones = $resultDonaciones->fetch_assoc()['total_donaciones']; // Obtiene el resultado de la consulta

// Consulta para obtener la cantidad de programas registrados
$sqlProgramas = "SELECT COUNT(*) AS total_programas FROM programs";
$resultProgramas = $conn->query($sqlProgramas); // Ejecuta la consulta
$totalProgramas = $resultProgramas->fetch_assoc()['total_programas']; // Obtiene el resultado de la consulta

// Cerrar la conexión a la base de datos
$conn->close(); // Cierra la conexión a la base de datos
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"> <!-- Define la codificación de caracteres -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Configura la vista para dispositivos móviles -->
    <title>Panel de Administración</title> <!-- Título de la página -->
    <link rel="stylesheet" href="../../Resources/css/Style.css"> <!-- Incluye el archivo CSS -->
    <script src="../../Resources/JS/appdash.js" defer></script> <!-- Incluye el script JS modificado -->
</head>
<body>
    <div class="sidebar" id="sidebar"> <!-- Barra lateral -->
        <div class="toggle-btn" onclick="toggleSidebar()">&#9776;</div> <!-- Botón para mostrar/ocultar la barra lateral -->
        <div class="menu"> <!-- Menú de navegación -->
            <a href="Dashboard.php">Inicio</a> <!-- Enlace a la página de inicio -->
            <a href="usuarios.php">Usuarios</a> <!-- Enlace a la página de usuarios -->
            <a href="Programas.php">Programas</a> <!-- Enlace a la página de programas -->
            <a href="donaciones.php">Donaciones</a> <!-- Enlace a la página de donaciones -->
            <a href="../Login/Logout.php" class="logout-btn">Cerrar Sesión</a> <!-- Enlace para cerrar sesión -->
        </div>
    </div>

    <div class="main-content"> <!-- Contenido principal -->
        <div class="header"> <!-- Encabezado -->
            <h1>Panel de Administración</h1> <!-- Título del panel -->
        </div>

        <div class="content-grid"> <!-- Contenedor de tarjetas -->
            <!-- Tarjeta de Usuarios Registrados -->
            <div class="card">
                <h2>Usuarios Registrados</h2> <!-- Título de la tarjeta -->
                <p><strong><?= $totalUsuarios; ?></strong> General</p> <!-- Muestra el total de usuarios registrados -->
                <!-- Puedes hacer consultas adicionales para obtener los usuarios del último mes/año -->
                <p><strong>1000</strong> Último mes</p> <!-- Muestra un valor fijo para usuarios del último mes -->
                <p><strong>10,000</strong> Último año</p> <!-- Muestra un valor fijo para usuarios del último año -->
            </div>

            <!-- Tarjeta de Donaciones Hechas -->
            <div class="card">
                <h2>Donaciones Hechas</h2> <!-- Título de la tarjeta -->
                <p><strong>$<?= number_format($totalDonaciones, 2); ?></strong> General</p> <!-- Muestra el total de donaciones -->
                <!-- Puedes hacer consultas adicionales para obtener las donaciones del último mes/año -->
                <p><strong>$0.00</strong> Último mes</p> <!-- Muestra un valor fijo para donaciones del último mes -->
                <p><strong>$0.00</strong> Último año</p> <!-- Muestra un valor fijo para donaciones del último año -->
            </div>

            <!-- Tarjeta de Programas Registrados -->
            <div class="card">
                <h2>Programas Registrados</h2> <!-- Título de la tarjeta -->
                <p><strong><?= $totalProgramas; ?></strong> General</p> <!-- Muestra el total de programas registrados -->
            </div>
        </div>
    </div>
</body>
</html>
