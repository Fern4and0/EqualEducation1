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
        <div class="logo-name" style="display: flex; align-items: center;"></div>
            <img src="../../Resources/images/logo.png" alt="Equal Education Logo" class="logo-image" style="width: 35px; height: 40px; margin-right: 50px;">
            <span class="logo_name" style="font-size: 18px;">Equal Education</span>
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
            <div class="profile">
            <i class="uil uil-user-circle profile-icon"></i>
            <ul class="profile-options">
            <li><a href="profile.php">Ver Perfil</a></li>
            <li><a href="settings.php">Configuración</a></li>
            <li><a href="../Login/Logout.php">Cerrar Sesión</a></li>
            </ul>
            </div>
        </div>

        <style>
            .profile-icon {
            font-size: 40px;
            cursor: pointer;
            }
        </style>

        <style>
            .profile {
            position: relative;
            display: inline-block;
            }

            .profile-img {
            width: 90px;
            height: 80px;
            border-radius: 50%;
            cursor: pointer;
            }

            .profile-options {
            display: none;
            position: absolute;
            top: 50px;
            right: 0;
            background-color: white;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            list-style: none;
            padding: 0;
            margin: 0;
            border-radius: 5px;
            overflow: hidden;
            }

            .profile-options li {
            border-bottom: 1px solid #ddd;
            }

            .profile-options li:last-child {
            border-bottom: none;
            }

            .profile-options li a {
            display: block;
            padding: 10px 20px;
            text-decoration: none;
            color: black;
            transition: background-color 0.3s;
            }

            .profile-options li a:hover {
            background-color: #f1f1f1;
            }

            .profile:hover .profile-options {
            display: block;
            }
        </style>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-chart-line"></i>
                    <span class="text">Análisis y Estadísticas</span>
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

            <!-- Chat UI -->
            <div id="chat-ui" style="display: none;">
                <div class="chat-header">
                    <span>Chat</span>
                    <button id="close-chat">X</button>
                </div>
                <div class="chat-body">
                    <button id="chat-coordinator">Chat con Coordinador</button>
                    <button id="chat-donor">Chat con Donante</button>
                </div>
            </div>
            <style>
                #chat-ui {
                    position: fixed;
                    bottom: 0;
                    right: 0;
                    width: 300px;
                    background-color: white;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    border-radius: 10px 10px 0 0;
                    overflow: hidden;
                    z-index: 1000;
                }
                .chat-header {
                    background-color: #f1f1f1;
                    padding: 10px;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                }
                .chat-body {
                    padding: 10px;
                }
                .chat-body button {
                    width: 100%;
                    padding: 10px;
                    margin-bottom: 10px;
                    border: none;
                    background-color: #007bff;
                    color: white;
                    cursor: pointer;
                    border-radius: 5px;
                }
                .chat-body button:hover {
                    background-color: #0056b3;
                }
            </style>
        </div>
    </section>

    <script>
        document.getElementById('chat-icon').addEventListener('click', function() {
            document.getElementById('chat-ui').style.display = 'block';
        });

        document.getElementById('close-chat').addEventListener('click', function() {
            document.getElementById('chat-ui').style.display = 'none';
        });

        document.getElementById('chat-coordinator').addEventListener('click', function() {
            window.location.href = 'ChatCoordinador.php';
        });

        document.getElementById('chat-donor').addEventListener('click', function() {
            window.location.href = 'ChatDonador.php';
        });
    </script>
</body>
</html>
