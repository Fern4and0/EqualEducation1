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
<html lang="es">
<head>
    <meta charset="UTF-8"> <!-- Define la codificación de caracteres -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Configura la vista para dispositivos móviles -->
    <title>Donaciones Hechas</title> <!-- Título de la página -->
    <link rel="stylesheet" href="../../Resources/css/Dashboard.css"> <!-- Incluye el archivo CSS -->
    <script src="../../Resources/JS/Dashboard.js" defer></script> <!-- Incluye el script JS modificado -->
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
            <a href="#" id="solicitudes-btn"><i class="icon-solicitudes"></i> Solicitudes</a> <!-- Enlace para ver solicitudes -->
            <a href="../Login/Logout.php" class="logout-btn">Cerrar Sesión</a> <!-- Enlace para cerrar sesión -->
        </div>
    </div>

    <div class="main-content"> <!-- Contenido principal -->
        <div class="header"> <!-- Encabezado -->
            <h1>Donaciones Hechas</h1>
        </div>

        <div class="donation-table"> <!-- Tabla de donaciones -->
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Donante</th>
                        <th>Monto</th>
                        <th>Fecha de Donación</th>
                        <th>Programa Asociado</th>
                        <th>Método de Pago</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($donaciones) > 0): ?> <!-- Verifica si hay donaciones -->
                        <?php foreach ($donaciones as $donacion): ?> <!-- Recorre cada donación -->
                            <tr>
                                <td><?= $donacion['id']; ?></td> <!-- Muestra el ID de la donación -->
                                <td><?= htmlspecialchars($donacion['donante']); ?></td> <!-- Muestra el nombre del donante -->
                                <td><?= "$" . number_format($donacion['monto'], 2); ?></td> <!-- Muestra el monto de la donación -->
                                <td><?= date('d/m/Y', strtotime($donacion['fecha'])); ?></td> <!-- Muestra la fecha de la donación -->
                                <td><?= htmlspecialchars($donacion['programa']); ?></td> <!-- Muestra el nombre del programa asociado -->
                                <td><?= htmlspecialchars($donacion['metodo_pago']); ?></td> <!-- Muestra el método de pago -->
                                <td>
                                    <button class="edit-btn">Editar</button> <!-- Botón para editar la donación -->
                                    <button class="delete-btn">Eliminar</button> <!-- Botón para eliminar la donación -->
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?> <!-- Si no hay donaciones -->
                        <tr>
                            <td colspan="7">No hay donaciones registradas.</td> <!-- Muestra un mensaje indicando que no hay donaciones -->
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="maintenance-message">
            <h2>Estamos en mantenimiento</h2>
            <p>Por favor, vuelva más tarde.</p>
        </div>

</body>
</html>
