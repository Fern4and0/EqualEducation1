<?php
session_start(); // Inicia la sesión

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: ../Resources/Views/Login.html"); // Redirige al login si no está autenticado
    exit(); // Detiene la ejecución
}

include '../../DB/db.php'; // Incluye la conexión a la base de datos

// Inicializa las variables $beneficiarios y $solicitudes como arrays vacíos
$beneficiarios = [];
$solicitudes = [];

// Consulta para obtener los beneficiarios registrados
$sql = "SELECT * FROM beneficiarios";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Almacena los beneficiarios en el array
    while($row = $result->fetch_assoc()) {
        $beneficiarios[] = $row;
    }
}

// Consulta para obtener las solicitudes de beneficios
$sqlSolicitudes = "SELECT * FROM solicitudes";
$resultSolicitudes = $conn->query($sqlSolicitudes);

if ($resultSolicitudes->num_rows > 0) {
    // Almacena las solicitudes en el array
    while($row = $resultSolicitudes->fetch_assoc()) {
        $solicitudes[] = $row;
    }
}

// Verifica si la solicitud es de tipo POST para agregar un beneficiario manualmente
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nombre'])) {
    // Verifica si las claves existen en el array $_POST antes de acceder a ellas
    $nombre = isset($_POST['nombre']) ? $conn->real_escape_string($_POST['nombre']) : '';
    $fecha_nacimiento = isset($_POST['fecha_nacimiento']) ? $conn->real_escape_string($_POST['fecha_nacimiento']) : '';
    $direccion = isset($_POST['direccion']) ? $conn->real_escape_string($_POST['direccion']) : '';
    $nivel_edu = isset($_POST['nivel_edu']) ? $conn->real_escape_string($_POST['nivel_edu']) : '';
    $situacion_eco = isset($_POST['situacion_eco']) ? $conn->real_escape_string($_POST['situacion_eco']) : '';
    $fecha_de_ingr = isset($_POST['fecha_de_ingr']) ? $conn->real_escape_string($_POST['fecha_de_ingr']) : '';

    // Valida que todos los campos requeridos no estén vacíos
    if (!empty($nombre) && !empty($fecha_nacimiento) && !empty($direccion) && !empty($nivel_edu) && !empty($situacion_eco) && !empty($fecha_de_ingr)) {
        // Prepara la consulta SQL para insertar los datos en la tabla de beneficiarios usando sentencias preparadas
        $stmt = $conn->prepare("INSERT INTO beneficiarios (nombre, fecha_nacimiento, direccion, nivel_edu, situacion_eco, fecha_de_ingr)
                VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $nombre, $fecha_nacimiento, $direccion, $nivel_edu, $situacion_eco, $fecha_de_ingr);

        // Ejecuta la consulta y verifica si se insertó correctamente
        if ($stmt->execute()) {
            echo "<script>
                    alert('Beneficiario registrado exitosamente');
                    window.location.href = 'Beneficiarios.php';
                  </script>";
            exit();
        } else {
            echo "<div class='alert alert-danger'>Error: No se pudo registrar el beneficiario. {$stmt->error}</div>";
        }

        // Cierra la sentencia preparada
        $stmt->close();
    } else {
        echo "<script>alert('Por favor, complete todos los campos.');</script>";
    }
}

// Lógica para aceptar solicitudes
if (isset($_POST['aceptar_solicitud'])) {
    $solicitud_id = $_POST['solicitud_id'];

    // Obtener la solicitud que se quiere aceptar
    $sql = "SELECT * FROM solicitudes WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $solicitud_id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $solicitud = $resultado->fetch_assoc();

        // Insertar los datos de la solicitud en la tabla de beneficiarios
        $stmtInsert = $conn->prepare("INSERT INTO beneficiarios (nombre, fecha_nacimiento, direccion, nivel_edu, situacion_eco, fecha_de_ingr)
                                      VALUES (?, ?, ?, ?, ?, ?)");
        $fecha_ingreso_actual = date('Y-m-d H:i:s'); // Fecha de ingreso actual
        $stmtInsert->bind_param("ssssss", 
            $solicitud['nombre'], 
            $solicitud['fecha_nacimiento'], 
            $solicitud['direccion'], 
            $solicitud['nivel_edu'], 
            $solicitud['situacion_eco'], 
            $fecha_ingreso_actual // Fecha de ingreso actual
        );
        if ($stmtInsert->execute()) {
            // Eliminar la solicitud aceptada de la tabla de solicitudes
            $stmtDelete = $conn->prepare("DELETE FROM solicitudes WHERE id = ?");
            $stmtDelete->bind_param("i", $solicitud_id);
            $stmtDelete->execute();

            // Mostrar alerta y redirigir
            echo "<script>
                    alert('Solicitud aceptada y beneficiario registrado exitosamente');
                    window.location.href = 'Beneficiarios.php';
                  </script>";
            exit();
        } else {
            echo "<div class='alert alert-danger'>Error al aceptar la solicitud: {$stmtInsert->error}</div>";
        }

        $stmtInsert->close();
        $stmtDelete->close();
    }

    $stmt->close();
}

// Lógica para rechazar solicitudes
if (isset($_POST['rechazar_solicitud'])) {
    $solicitud_id = $_POST['solicitud_id'];

    // Eliminar la solicitud de la tabla
    $stmt = $conn->prepare("DELETE FROM solicitudes WHERE id = ?");
    $stmt->bind_param("i", $solicitud_id);

    if ($stmt->execute()) {
        echo "<script>
                alert('Solicitud rechazada correctamente');
                window.location.href = 'Beneficiarios.php';
              </script>";
    } else {
        echo "<div class='alert alert-danger'>Error al rechazar la solicitud</div>";
    }

    $stmt->close();
}

// Verifica si se solicitó actualizar un beneficiario
if (isset($_POST['editar_beneficiario'])) {
    $id = $_POST['edit_id'];
    $nombre = $_POST['edit_nombre'];
    $fecha_nacimiento = $_POST['edit_fecha_nacimiento'];
    $direccion = $_POST['edit_direccion'];
    $nivel_edu = $_POST['edit_nivel_edu'];
    $situacion_eco = $_POST['edit_situacion_eco'];

    // Consulta para actualizar el beneficiario
    $stmt = $conn->prepare("UPDATE beneficiarios SET nombre = ?, fecha_nacimiento = ?, direccion = ?, nivel_edu = ?, situacion_eco = ? WHERE id = ?");
    $stmt->bind_param("sssssi", $nombre, $fecha_nacimiento, $direccion, $nivel_edu, $situacion_eco, $id);

    if ($stmt->execute()) {
        echo "<script>
                alert('Beneficiario actualizado exitosamente');
                window.location.href = 'Beneficiarios.php';
              </script>";
    } else {
        echo "<div class='alert alert-danger'>Error al actualizar el beneficiario: {$stmt->error}</div>";
    }

    $stmt->close();
}

// Lógica para eliminar beneficiarios
if (isset($_POST['eliminar_beneficiario'])) {
    $beneficiario_id = $_POST['beneficiario_id'];
    
    // Eliminar el beneficiario de la base de datos
    $stmt = $conn->prepare("DELETE FROM beneficiarios WHERE id = ?");
    $stmt->bind_param("i", $beneficiario_id);
    
    if ($stmt->execute()) {
        echo "<script>
                alert('Beneficiario eliminado correctamente');
                window.location.href = 'Beneficiarios.php';
              </script>";
    } else {
        echo "<div class='alert alert-danger'>Error al eliminar el beneficiario</div>";
    }
    $stmt->close();
}

// Cierra la conexión a la base de datos
$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"> <!-- Define la codificación de caracteres -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Configura la vista para dispositivos móviles -->
    <title>Beneficiarios Registrados - Equal Education</title> <!-- Título de la página -->
    
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="../../Resources/css/beneficiarios.css"> <!-- Incluye el archivo CSS -->
    <script src="../../Resources/js/Dashboard.js" defer></script> <!-- Incluye el script JS modificado -->
    <script src="../../Resources/js/dash.js" defer></script> <!-- Incluye el script JS modificado -->

    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
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
                <li><a href="../Login/Logout.php" class="logout-btn">
                    <i class="uil uil-signout"></i>
                    <span class="link-name">Cerrar Sesión</span>
                </a></li>
                <li class="mode">
                    <a href="#">
                        <i class="uil uil-moon"></i>
                        <span class="link-name">Modo Oscuro</span>
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
            <i class="uil uil-bars sidebar-toggle" onclick="toggleSidebar()"></i>
            <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Buscar aquí...">
            </div>
        </div>

        <div class="main-content">
            <div class="header">
                <h1>Beneficiarios Registrados</h1> <!-- Título de la sección -->
            </div>

            <div class="beneficiarios-table"> <!-- Tabla de beneficiarios -->
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Fecha de Nacimiento</th>
                            <th>Dirección</th>
                            <th>Nivel Educativo</th>
                            <th>Situación Económica</th>
                            <th>Acciones</th>
                            <th>
                                <button type="button" class="solicitudes-btn" onclick="openSolicitudesModal()">Solicitudes</button>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($beneficiarios as $beneficiario) : ?>
                        <tr>
                            <td><?= $beneficiario['id']; ?></td>
                            <td><?= htmlspecialchars($beneficiario['nombre'], ENT_QUOTES); ?></td>
                            <td><?= $beneficiario['fecha_nacimiento']; ?></td>
                            <td><?= htmlspecialchars($beneficiario['direccion'], ENT_QUOTES); ?></td>
                            <td><?= htmlspecialchars($beneficiario['nivel_edu'], ENT_QUOTES); ?></td>
                            <td><?= htmlspecialchars($beneficiario['situacion_eco'], ENT_QUOTES); ?></td>
                            <td>
                                <button type="button" class="edit-btn"
                                    onclick="openEditModal(
                                        <?= $beneficiario['id']; ?>, 
                                        '<?= htmlspecialchars($beneficiario['nombre'], ENT_QUOTES); ?>', 
                                        '<?= $beneficiario['fecha_nacimiento']; ?>', 
                                        '<?= htmlspecialchars($beneficiario['direccion'], ENT_QUOTES); ?>', 
                                        '<?= htmlspecialchars($beneficiario['nivel_edu'], ENT_QUOTES); ?>', 
                                        '<?= htmlspecialchars($beneficiario['situacion_eco'], ENT_QUOTES); ?>')">
                                    Editar
                                </button>
                                <form method="post" style="display:inline;">
                                    <input type="hidden" name="beneficiario_id" value="<?= $beneficiario['id']; ?>">
                                    <button type="submit" name="eliminar_beneficiario" class="delete-btn">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Modal de Solicitudes -->
            <div id="solicitudes-modal" class="modal">
                <div class="modal-content">
                    <span class="close-btn" onclick="closeSolicitudesModal()">&times;</span>
                    <h2>Solicitudes de Beneficios</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Fecha de Nacimiento</th>
                                <th>Dirección</th>
                                <th>Nivel Educativo</th>
                                <th>Situación Económica</th>
                                <th>Fecha de Solicitud</th>
                                <th>Acciones</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($solicitudes) > 0): ?>
                                <?php foreach ($solicitudes as $solicitud): ?>
                                    <tr>
                                        <td><?= $solicitud['id']; ?></td>
                                        <td><?= htmlspecialchars($solicitud['nombre']); ?></td>
                                        <td><?= date('d/m/Y', strtotime($solicitud['fecha_nacimiento'])); ?></td>
                                        <td><?= htmlspecialchars($solicitud['direccion']); ?></td>
                                        <td><?= htmlspecialchars($solicitud['nivel_edu']); ?></td>
                                        <td><?= htmlspecialchars($solicitud['situacion_eco']); ?></td>
                                        <td><?= isset($solicitud['fecha_solicitud']) ? date('d/m/Y', strtotime($solicitud['fecha_solicitud'])) : 'N/A'; ?></td>
                                        <td>
                                            <form method="post" style="display:inline;">
                                                <input type="hidden" name="solicitud_id" value="<?= $solicitud['id']; ?>">
                                                <button type="submit" name="aceptar_solicitud" class="accept-btn">Aceptar</button>
                                            </form>
                                            <form method="post" style="display:inline;">
                                                <input type="hidden" name="solicitud_id" value="<?= $solicitud['id']; ?>">
                                                <button type="submit" name="rechazar_solicitud" class="reject-btn">Rechazar</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8">No hay solicitudes de beneficios.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Modal para editar beneficiario -->
            <div id="editModal" class="modal">
                <div class="modal-content">
                    <span class="close-btn" onclick="closeEditModal()">&times;</span>
                    <h2>Editar Beneficiario</h2>
                    <form method="post">
                        <input type="hidden" name="edit_id" id="edit_id">
                        <label for="edit_nombre">Nombre:</label>
                        <input type="text" name="edit_nombre" id="edit_nombre" required><br>

                        <label for="edit_fecha_nacimiento">Fecha de Nacimiento:</label>
                        <input type="date" name="edit_fecha_nacimiento" id="edit_fecha_nacimiento" required><br>

                        <label for="edit_direccion">Dirección:</label>
                        <input type="text" name="edit_direccion" id="edit_direccion" required><br>

                        <label for="edit_nivel_edu">Nivel Educativo:</label>
                        <input type="text" name="edit_nivel_edu" id="edit_nivel_edu" required><br>

                        <label for="edit_situacion_eco">Situación Económica:</label>
                        <input type="text" name="edit_situacion_eco" id="edit_situacion_eco" required><br>

                        <button type="submit" name="guardar_cambios" class="save-btn">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
