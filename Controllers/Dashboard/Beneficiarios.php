<?php
session_start(); // Inicia la sesión

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: ../Resources/Views/Login.html"); // Redirige al login si no está autenticado
    exit(); // Detiene la ejecución
}

include '../../DB/db.php'; // Incluye la conexión a la base de datos

// Inicializa la variable $beneficiarios como un array vacío
$beneficiarios = [];

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

// Consulta para obtener los beneficiarios registrados
$sql = "SELECT * FROM beneficiarios";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Almacena los beneficiarios en el array
    while($row = $result->fetch_assoc()) {
        $beneficiarios[] = $row;
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
    <title>Beneficiarios Registrados</title> <!-- Título de la página -->
    <link rel="stylesheet" href="../../Resources/css/Dashboard.css"> <!-- Incluye el archivo CSS -->
    <script src="../../Resources/JS/Dashboard.js" defer></script> <!-- Incluye el script JS -->
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

                <button type="submit" name="editar_beneficiario">Guardar Cambios</button>
            </form>
        </div>
    </div>

    <script>
        // Función para abrir el modal de edición y llenar los campos con los datos del beneficiario
        function openEditModal(id, nombre, fechaNacimiento, direccion, nivelEdu, situacionEco) {
            // Asigna los valores a los campos del modal
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_nombre').value = nombre;
            document.getElementById('edit_fecha_nacimiento').value = fechaNacimiento;
            document.getElementById('edit_direccion').value = direccion;
            document.getElementById('edit_nivel_edu').value = nivelEdu;
            document.getElementById('edit_situacion_eco').value = situacionEco;

            // Muestra el modal
            document.getElementById('editModal').style.display = 'block';
        }

        // Función para cerrar el modal de edición
        function closeEditModal() {
            // Oculta el modal
            document.getElementById('editModal').style.display = 'none';
        }
    </script>
</body>
</html>
