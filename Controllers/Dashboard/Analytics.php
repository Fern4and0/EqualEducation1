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

// Consulta para obtener la cantidad de beneficiarios registrados
$sqlBeneficiarios = "SELECT COUNT(*) AS total_beneficiarios FROM beneficiarios";
$resultBeneficiarios = $conn->query($sqlBeneficiarios); // Ejecuta la consulta
$totalBeneficiarios = $resultBeneficiarios->fetch_assoc()['total_beneficiarios']; // Obtiene el resultado de la consulta

// Cerrar la conexión a la base de datos
$conn->close(); // Cierra la conexión a la base de datos
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"> <!-- Define la codificación de caracteres -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Configura la vista para dispositivos móviles -->
    <title>Panel de Administración</title> <!-- Título de la página -->
    <link rel="stylesheet" href="../../Resources/css/Dashboard.css"> <!-- Incluye el archivo CSS -->
    <script src="../../Resources/JS/Dashboard.js" defer></script> <!-- Incluye el script JS modificado -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Incluye Chart.js -->
</head>
<body>
    <div class="sidebar" id="sidebar"> <!-- Barra lateral -->
        <div class="toggle-btn" onclick="toggleSidebar()">&#9776;</div> <!-- Botón para mostrar/ocultar la barra lateral -->
        <div class="menu"> <!-- Menú de navegación -->
            <a href="Dashboard.php">Inicio</a> <!-- Enlace a la página de inicio -->
            <a href="usuarios.php">Usuarios</a> <!-- Enlace a la página de usuarios -->
            <a href="Informes.php">Informes</a> <!-- Enlace a la página de informes -->
            <a href="Beneficiarios.php">Beneficiarios</a> <!-- Enlace a la página de beneficiarios -->
            <a href="Donaciones.php">Donaciones</a> <!-- Enlace a la página de donaciones -->
            <a href="Analytics.php">Analytics</a> <!-- Enlace a la página de donaciones -->
            <a href="../Login/Logout.php" class="logout-btn">Cerrar Sesión</a> <!-- Enlace para cerrar sesión -->
        </div>
    </div>

    <div class="main-content"> <!-- Contenido principal -->
        <div class="header"> <!-- Encabezado -->
            <h1>Analytics</h1> <!-- Título del panel -->
        </div>

        <div class="content-grid"> <!-- Contenedor de tarjetas -->

            <!-- Tarjeta de Usuarios Registrados -->
            <div class="card">
                <h2>Usuarios Registrados</h2> <!-- Título de la tarjeta -->
                <p><strong><?= $totalUsuarios; ?></strong> General</p> <!-- Muestra el total de usuarios registrados -->
            </div>

            <!-- Tarjeta de Donaciones Hechas -->
            <div class="card">
                <h2>Donaciones Hechas</h2> <!-- Título de la tarjeta -->
                <p><strong>$<?= number_format($totalDonaciones, 2); ?></strong> General</p> <!-- Muestra el total de donaciones -->
            </div>

            <!-- Tarjeta de Beneficiarios Registrados -->
            <div class="card">
                <h2>Beneficiarios Registrados</h2> <!-- Título de la tarjeta -->
                <p><strong><?= $totalBeneficiarios; ?></strong> General</p> <!-- Muestra el total de beneficiarios registrados -->
            </div>

            <!-- Gráfica de Usuarios Registrados -->
            <div class="card">
                <h2>Gráfica de Usuarios Registrados</h2>
                <canvas id="usuariosChart" width="400" height="200"></canvas>
            </div>

            <!-- Gráfica de Donaciones -->
            <div class="card">
                <h2>Gráfica de Donaciones Hechas</h2>
                <canvas id="donacionesChart" width="400" height="200"></canvas>
            </div>

            <!-- Gráfica de Beneficiarios Registrados -->
            <div class="card">
                <h2>Gráfica de Beneficiarios Registrados</h2>
                <canvas id="beneficiariosChart" width="400" height="200"></canvas>
            </div>
        </div>

    </div>

    <script>
        
    </script>
</body>
</html>
