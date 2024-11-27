<?php
// Conexión a la base de datos (ajusta los datos de conexión)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ong";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: {$conn->connect_error}");
}

// Función para suspender una cuenta
function suspenderCuenta($id_usuario) {
    global $conn;
    $sql = "UPDATE users SET estatus_cuenta='Suspendido' WHERE id=?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error preparing statement: {$conn->error}");
    }
    $stmt->bind_param("i", $id_usuario);
    if (!$stmt->execute()) {
        die("Error executing statement: {$stmt->error}");
    }
    $stmt->close();
}
// Función para activar una cuenta
function activarCuenta($id_usuario) {
    global $conn;
    $sql = "UPDATE users SET estatus_cuenta='Activo' WHERE id=?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param("i", $id_usuario);
    if (!$stmt->execute()) {
        die("Error executing statement: " . $stmt->error);
    }
    $stmt->close();
}

// Función para obtener todos los usuarios
function obtenerUsuarios() {
    global $conn;
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);
    return $result;
}

// Obtener los usuarios
$usuarios = obtenerUsuarios();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Usuarios</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f8f9fa;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:nth-child(odd) {
            background-color: #fff;
        }
        tr:hover {
            background-color: #e9ecef;
        }
        button {
            padding: 8px 12px;
            margin: 2px;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease, opacity 0.3s ease;
        }
        button[name="suspender"] {
            background-color: #dc3545;
            color: white;
        }
        button[name="activar"] {
            background-color: #28a745;
            color: white;
        }
        button:hover {
            opacity: 0.9;
        }
        form {
            display: inline;
        }
        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .title {
            text-align: center;
            font-size: 24px;
            color: #007bff;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['suspender'])) {
            suspenderCuenta($_POST['id_usuario']);
        } elseif (isset($_POST['activar'])) {
            activarCuenta($_POST['id_usuario']);
        }
        // Refresh the page to reflect changes
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
    ?>

    <div class="container">
        <div class="title">Listado de Usuarios</div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $usuarios->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['estatus_cuenta']); ?></td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="id_usuario" value="<?php echo htmlspecialchars($row['id']); ?>">
                                <button type="submit" name="suspender">Suspender</button>
                                <button type="submit" name="activar">Activar</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
