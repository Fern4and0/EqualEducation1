<?php
// Controllers/Programas.php

session_start(); // Inicia la sesión

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: ../Resources/Views/Login.html"); // Redirige al login si no está autenticado
    exit(); // Detiene la ejecución
}

include '../../DB/db.php'; // Incluye la conexión a la base de datos

// Consulta para obtener los programas registrados
$sqlProgramas = "
    SELECT p.id, p.nombre, p.objetivo, p.fecha_ini, p.fecha_fin, u.nombre AS coordinador
    FROM programs p
    JOIN users u ON p.coordinador_id = u.id
";
$resultProgramas = $conn->query($sqlProgramas); // Ejecuta la consulta

// Verifica si hay resultados
$programas = [];
if ($resultProgramas->num_rows > 0) {
    while ($row = $resultProgramas->fetch_assoc()) { // Recorre los resultados
        $programas[] = $row; // Almacena cada fila en el array $programas
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
    <title>Programas Registrados</title> <!-- Título de la página -->
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
        <div class="header">
            <h1>Programas Registrados</h1> <!-- Título de la sección -->
        </div>

        <div class="program-table"> <!-- Tabla de programas -->
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre del Programa</th>
                        <th>Objetivo</th>
                        <th>Coordinador</th>
                        <th>Fecha de Inicio</th>
                        <th>Fecha de Fin</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($programas) > 0): ?> <!-- Verifica si hay programas -->
                        <?php foreach ($programas as $programa): ?> <!-- Recorre cada programa -->
                            <tr>
                                <td><?= $programa['id']; ?></td> <!-- Muestra el ID del programa -->
                                <td><?= htmlspecialchars($programa['nombre']); ?></td> <!-- Muestra el nombre del programa -->
                                <td><?= htmlspecialchars($programa['objetivo']); ?></td> <!-- Muestra el objetivo del programa -->
                                <td><?= htmlspecialchars($programa['coordinador']); ?></td> <!-- Muestra el nombre del coordinador -->
                                <td><?= date('d/m/Y', strtotime($programa['fecha_ini'])); ?></td> <!-- Muestra la fecha de inicio -->
                                <td><?= date('d/m/Y', strtotime($programa['fecha_fin'])); ?></td> <!-- Muestra la fecha de fin -->
                                <td>
                                    <button class="edit-btn">Editar</button> <!-- Botón para editar -->
                                    <button class="delete-btn">Eliminar</button> <!-- Botón para eliminar -->
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7">No hay programas registrados.</td> <!-- Mensaje si no hay programas -->
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
