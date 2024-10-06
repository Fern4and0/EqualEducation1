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

        <div class="main-content">
              <h1><i class="uil uil-file-alt"></i> Informes</h1>

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
    </section>

    <script src="script.js"></script>
</body>
</html>

<?php
$conn->close(); // Cierra la conexión
?>
