<?php
// Controllers/Informes.php

session_start(); // Inicia la sesión

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: ../Resources/Views/Login.html"); // Redirige al login si no está autenticado
    exit(); // Detiene la ejecución
}

include '../../DB/db.php'; // Incluye la conexión a la base de datos

// Filtrar los informes por tipo si se ha seleccionado un tipo
$tipo = isset($_POST['tipo_filtro']) ? $_POST['tipo_filtro'] : '';
$sql = "SELECT * FROM informes";
if ($tipo) {
    $sql .= " WHERE tipo = '$tipo'";
}
$result = $conn->query($sql); // Ejecuta la consulta

// Cierra la conexión a la base de datos al final
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"> <!-- Define la codificación de caracteres -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Configura la vista para dispositivos móviles -->
    <title>Informes</title> <!-- Título de la página -->
    <link rel="stylesheet" href="../../Resources/css/Dashboard.css"> <!-- Incluye el archivo CSS -->
    <script src="../../Resources/JS/Dasboard.js" defer></script> <!-- Incluye el script JS modificado -->
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../../Resources/css/Informes.css"> <!-- Incluye el archivo CSS -->
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
            <a href="../Login/Logout.php" class="logout-btn">Cerrar Sesión</a> <!-- Enlace para cerrar sesión -->
        </div>
    </div>

    <div class="main-content"> <!-- Contenido principal -->
        <div class="header">
            <h1>Informes</h1> <!-- Título de la sección -->
        </div>

        <div class="add-report-section">
            <h2>Agregar Informe</h2>
            <form action="AgregarInforme.php" method="POST">
                <label for="programa_id">Programa ID:</label>
                <input type="number" id="programa_id" name="programa_id" required>

                <label for="tipo">Tipo:</label>
                <select id="tipo" name="tipo" required>
                    <option value="anual">Anual</option>
                    <option value="mensual">Mensual</option>
                    <option value="semanal">Semanal</option>
                </select>

                <label for="contenido">Contenido:</label>
                <input type="text" id="contenido" name="contenido" maxlength="255" required>

                <label for="fecha">Fecha:</label>
                <input type="datetime-local" id="fecha" name="fecha" required>

                <button type="submit">Agregar Informe</button>
            </form>
        </div>

        <div class="reports-section">
            <h2>Lista de Informes</h2>
            <form method="POST" action="Informes.php">
                <label for="tipo_filtro">Filtrar por tipo:</label>
                <select id="tipo_filtro" name="tipo_filtro">
                    <option value="">Todos</option>
                    <option value="anual" <?php if ($tipo == 'anual') echo 'selected'; ?>>Anual</option>
                    <option value="mensual" <?php if ($tipo == 'mensual') echo 'selected'; ?>>Mensual</option>
                    <option value="semanal" <?php if ($tipo == 'semanal') echo 'selected'; ?>>Semanal</option>
                </select>
                <button type="submit">Filtrar</button>
            </form>
            <?php if ($result->num_rows > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Programa</th>
                            <th>Tipo</th>
                            <th>Contenido</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['programa_id']; ?></td>
                            <td><?php echo $row['tipo']; ?></td>
                            <td><?php echo $row['contenido']; ?></td>
                            <td><?php echo $row['fecha']; ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No se encontraron informes.</p>
            <?php endif; ?>
        </div>

    </div>
</body>
</html>

<?php
$conn->close(); // Cierra la conexión
?>
