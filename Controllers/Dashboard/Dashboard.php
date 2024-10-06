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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="../../Resources/css/nuevo.css"> <!-- Incluye el archivo CSS -->
    <script src="../../Resources/js/Dashboard.js" defer></script> <!-- Incluye el script JS modificado -->
    <script src="../../Resources/js/dash.js" defer></script> <!-- Incluye el script JS modificado -->
    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>Admin Dashboard Panel</title>
</head>
<body>
    <nav>
        <div class="logo-name">
            <span class="logo_name">Equal Education</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                    <li><a href="Dashboard.php">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">Inicio</span>
                    </a></li>
                    <li><a href="usuarios.php">
                        <i class="uil uil-users-alt"></i>
                        <span class="link-name">Usuarios</span>
                    </a></li>
                    <li><a href="Informes.php">
                        <i class="uil uil-file-alt"></i>
                        <span class="link-name">Informes</span>
                    </a></li>
                    <li><a href="Beneficiarios.php">
                        <i class="uil uil-user"></i>
                        <span class="link-name">Beneficiarios</span>
                    </a></li>
                    <li><a href="Donaciones.php">
                        <i class="uil uil-gift"></i>
                        <span class="link-name">Donaciones</span>
                    </a></li>
                </ul>
            
            <ul class="logout-mode">
                <li><a href="../Login/Logout.php">
                    <i class="uil uil-signout"></i>
                    <span class="link-name">Cerrar Sesión</span>
                </a></li>

                <li class="mode">
                    <a href="#">
                        <i class="uil uil-moon"></i>
                        <span class="link-name">Dark Mode</span>
                    </a>
                    <div class="mode-toggle">
                        <span class="switch"></span>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>

            <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Search here...">
            </div>
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Dashboard</span>
                </div>

                <div class="boxes">
                    <div class="box box1">
                        <i class="uil uil-users-alt"></i>
                        <span class="text">Usuarios Registrados</span>
                        <span class="number"><?= $totalUsuarios; ?></span> <!-- Mostrar el total de usuarios -->
                    </div>
                    <div class="box box2">
                        <i class="uil uil-gift"></i>
                        <span class="text">Donaciones Hechas</span>
                        <span class="number">$<?= number_format($totalDonaciones, 2); ?></span> <!-- Mostrar el total de donaciones -->
                    </div>
                    <div class="box box3">
                        <i class="uil uil-user"></i>
                        <span class="text">Beneficiarios Registrados</span>
                        <span class="number"><?= $totalBeneficiarios; ?></span> <!-- Mostrar el total de beneficiarios -->
                    </div>
                </div>
            </div>

            
        </div>
    </section>

    <script src="script.js"></script>
</body>
</html>
