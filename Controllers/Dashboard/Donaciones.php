<?php
// Controllers/Donaciones.php

session_start(); // Inicia la sesión

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: ../Resources/Views/Login.html"); // Redirige al login si no está autenticado
    exit(); // Detiene la ejecución
}

include '../../DB/db.php'; // Incluye la conexión a la base de datos

// Consulta SQL para obtener las donaciones, el nombre del donante y el programa asociado
$sqlDonaciones = "
    SELECT d.id, u.nombre AS donante, d.monto, d.fecha, p.nombre AS programa, 'Transferencia' AS metodo_pago
    FROM donaciones d
    JOIN users u ON d.donante_id = u.id
    JOIN programs p ON d.programa_id = p.id
";
$resultDonaciones = $conn->query($sqlDonaciones); // Ejecuta la consulta SQL

// Verifica si hay resultados
$donaciones = []; // Inicializa un array vacío para almacenar las donaciones
if ($resultDonaciones->num_rows > 0) { // Si hay resultados
    while ($row = $resultDonaciones->fetch_assoc()) { // Recorre cada fila de resultados
        $donaciones[] = $row; // Añade cada fila al array de donaciones
    }
}

// Cierra la conexión a la base de datos
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
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
                

                <li class="mode" style="display: none;">
                    <div class="mode-toggle">
                        <span class="switch"></span>
                    </div>
                </li>
            </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>

            
            <!--<img src="images/profile.jpg" alt="">-->
        </div>
        <!-- -======== Donaciones pon tu api de paypal adriel ========= -->
        
    </section>

    <script src="script.js"></script>
</body>
</html>
