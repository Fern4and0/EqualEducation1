<?php
// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "ong");

// Verifica la conexión
if ($conn->connect_error) {
    die("Error de conexión: {$conn->connect_error}");
}

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['accion'])) {
        $accion = $_POST['accion'];
        $solicitud_id = $_POST['solicitud_id'];

        if ($accion == 'aceptar') {
            // Actualizar el rol del usuario a 'beneficiario' (id_rol = 3)
            $stmt = $conn->prepare("UPDATE solicitudes SET id_rol = 3 WHERE id = ?");
            $stmt->bind_param("i", $solicitud_id);
            if ($stmt->execute()) {
                // Redirigir al usuario a Beneficiarios.php tras aceptar la solicitud
                header("Location: ../../../Administrador/Tabla/Beneficiarios.php");
                exit();
            } else {
                echo "Error: {$stmt->error}";
            }
            $stmt->close();
        } elseif ($accion == 'rechazar') {
            // Eliminar la solicitud de la base de datos usando una declaración preparada
            $stmt = $conn->prepare("DELETE FROM solicitudes WHERE id = ?");
            $stmt->bind_param("i", $solicitud_id);
            if ($stmt->execute()) {
                echo "Solicitud rechazada.";
            } else {
                echo "Error: {$stmt->error}";
            }
            $stmt->close();
        }
    } else {
        // Datos a insertar
        $nombre = $_POST['nombre'] ?? "Ejemplo Nombre";
        $descripcion = $_POST['descripcion'] ?? "";

        // Verificar si la descripcion no está vacía
        if (isset($_POST['descripcion']) && empty($descripcion)) {
            die("La descripción no puede estar vacía.");
        }

        // Datos adicionales a insertar
        $fecha_nacimiento = $_POST['fecha_nacimiento'] ?? "";
        $direccion = $_POST['direccion'] ?? "";
        $nivel_educativo = $_POST['nivel_educativo'] ?? "";
        $situacion_economica = $_POST['situacion_economica'] ?? "";
        $fecha_ingreso = date("Y-m-d");

        // Verificar si los campos adicionales no están vacíos
        if (empty($fecha_nacimiento) || empty($direccion) || empty($nivel_educativo) || empty($situacion_economica)) {
            die("Todos los campos son obligatorios.");
        }

        // Consulta SQL para insertar datos en la tabla 'solicitudes' usando una declaración preparada
        $stmt = $conn->prepare("INSERT INTO solicitudes (nombre, descripcion, fecha_nacimiento, direccion, nivel_educativo, situacion_economica, fecha_ingreso) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $nombre, $descripcion, $fecha_nacimiento, $direccion, $nivel_educativo, $situacion_economica, $fecha_ingreso);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            // Redirigir al usuario a inicio.php tras una inserción exitosa
            header("Location: ../../../inicio.php");
            exit();
        } else {
            echo "Error: {$stmt->error}";
        }
        $stmt->close();
    }
}

// Consulta SQL para obtener datos de la tabla 'solicitudes'
$sql = "SELECT * FROM solicitudes";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Solicitudes Recibidas</title>
    <style>
        /* Estilo para la ventana modal */
        .modal-content {
            max-width: 80%;
            max-height: 80%;
            overflow-y: auto;
            margin: auto;
            padding: 20px;
        }
        /* Estilo para la tabla */
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .table th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<div class='modal-content'>
    <h2>Solicitudes Recibidas</h2>
    <?php
    if ($result->num_rows > 0) {
        echo "<table class='table'>";
        echo "<thead><tr><th>ID</th><th>Nombre</th><th>Fecha de Nacimiento</th><th>Dirección</th><th>Nivel Educativo</th><th>Situación Económica</th><th>Fecha de Ingreso</th><th>Acciones</th></tr></thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['nombre']}</td>
                    <td>{$row['fecha_nacimiento']}</td>
                    <td>{$row['direccion']}</td>
                    <td>{$row['nivel_educativo']}</td>
                    <td>{$row['situacion_economica']}</td>
                    <td>{$row['fecha_ingreso']}</td>
                    <td>
                        <form method='POST' style='display:inline;'>
                            <input type='hidden' name='solicitud_id' value='{$row['id']}'>
                            <button type='submit' name='accion' value='aceptar'>Aceptar</button>
                        </form>
                        <form method='POST' style='display:inline;'>
                            <input type='hidden' name='solicitud_id' value='{$row['id']}'>
                            <button type='submit' name='accion' value='rechazar'>Rechazar</button>
                        </form>
                    </td>
                  </tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "No hay solicitudes.";
    }
    ?>
</div>

</body>
</html>

<?php
// Cierra la conexión
$conn->close();
?>
