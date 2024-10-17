<?php
// Controllers/dashboard.php

session_start(); // Inicia la sesión

// Verifica si hay una sesión activa (es decir, si el usuario ha iniciado sesión)
if (!isset($_SESSION['user_id'])) {
    header("Location: ../Resources/Views/Login.html"); // Redirige al login si no está autenticado
    exit(); // Detiene la ejecución del script
}

include '../../DB/db.php'; // Incluye la conexión a la base de datos

// Obtener lista de usuarios
$sql = "SELECT * FROM users"; // Se define la consulta SQL para obtener todos los usuarios
$result = $conn->query($sql); // Ejecuta la consulta y guarda el resultado

if ($result->num_rows > 0) {
    $users = $result->fetch_all(MYSQLI_ASSOC); // Si hay filas, se almacenan los datos en un arreglo asociativo
} else {
    $users = []; // Si no hay resultados, se inicializa un arreglo vacío
}

$conn->close();  // Cierra la conexión a la base de datos
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

          
        </div>

        <div class="main-content">
            <div class="header">
            <h1><i class="uil uil-users-alt"></i> Usuarios Registrados</h1>
            </div>

            <div class="user-table">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Correo Electrónico</th>
                            <th>Rol</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?> <!-- Itera sobre el arreglo de usuarios y crea una fila por cada usuario -->
                            <tr data-id="<?= $user['id'] ?>"> <!-- Añade un data-id para seleccionar el usuario -->
                                <td><?= $user['id'] ?></td>     <!-- Muestra el ID del usuario -->
                                <td class="nombre"><?= $user['nombre'] ?></td> <!-- Clase nombre para acceder desde JS -->
                                <td class="email"><?= $user['email'] ?></td>  <!-- Clase email para acceder desde JS -->
                                <td class="rol"><?= $user['id_rol'] ?></td> <!-- Clase rol para acceder desde JS -->
                                <td>
                                    <button class="edit-btn" onclick="editarUsuario(<?= $user['id'] ?>)">Editar</button>     <!-- Botón para editar -->
                                    <button class="delete-btn" onclick="eliminarUsuario(<?= $user['id'] ?>)">Eliminar</button> <!-- Botón para eliminar -->
                                </td>
                            </tr>
                        <?php endforeach; ?> <!-- Termina el bucle -->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal para editar usuario -->
        <div id="modalEditarUsuario" class="modal" style="display:none;"> <!-- Inicialmente oculto -->
            <div class="modal-content">
                <span class="close" onclick="cerrarModal()">&times;</span> <!-- Botón para cerrar el modal -->
                <h2>Editar Usuario</h2>
                <form id="editUserForm" action="EditarUsuario.php" method="POST"> <!-- Formulario para editar usuario -->
                    <input type="hidden" id="edit_id" name="id"> <!-- Campo oculto para el ID del usuario -->
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="edit_nombre" name="nombre" required> <!-- Campo para el nombre -->
                    <label for="email">Email:</label>
                    <input type="email" id="edit_email" name="email" required> <!-- Campo para el email -->
                    <label for="rol">Rol:</label>
                    <input type="number" id="edit_rol" name="id_rol" required> <!-- Campo para el rol -->
                    <button type="submit">Guardar Cambios</button> <!-- Botón para guardar los cambios -->
                </form>
            </div>
        </div>
    </section>

</body>
</html>
