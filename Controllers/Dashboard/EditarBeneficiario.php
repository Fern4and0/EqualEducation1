<?php
session_start();
include '../../DB/db.php';

// Check if a beneficiary ID was passed
if (isset($_GET['id'])) {
    $beneficiario_id = $_GET['id'];

    // Retrieve the beneficiary's data from the database
    $stmt = $conn->prepare("SELECT * FROM beneficiarios WHERE id = ?");
    $stmt->bind_param("i", $beneficiario_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $beneficiario = $result->fetch_assoc(); // Fetch the beneficiary's data
    } else {
        echo "<div class='alert alert-danger'>Beneficiario no encontrado.</div>";
        exit();
    }

    $stmt->close();
} else {
    echo "<div class='alert alert-danger'>ID de beneficiario no proporcionado.</div>";
    exit();
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = isset($_POST['nombre']) ? $conn->real_escape_string($_POST['nombre']) : '';
    $fecha_nacimiento = isset($_POST['fecha_nacimiento']) ? $conn->real_escape_string($_POST['fecha_nacimiento']) : '';
    $direccion = isset($_POST['direccion']) ? $conn->real_escape_string($_POST['direccion']) : '';
    $nivel_edu = isset($_POST['nivel_edu']) ? $conn->real_escape_string($_POST['nivel_edu']) : '';
    $situacion_eco = isset($_POST['situacion_eco']) ? $conn->real_escape_string($_POST['situacion_eco']) : '';
    $programa_asig = isset($_POST['programa_asig']) ? $conn->real_escape_string($_POST['programa_asig']) : '';

    // Update the beneficiary's data in the database
    $stmt = $conn->prepare("UPDATE beneficiarios SET nombre=?, fecha_nacimiento=?, direccion=?, nivel_edu=?, situacion_eco=?, programa_asig=? WHERE id=?");
    $stmt->bind_param("ssssssi", $nombre, $fecha_nacimiento, $direccion, $nivel_edu, $situacion_eco, $programa_asig, $beneficiario_id);
    
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

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Resources/css/Dashboard.css"> <!-- Incluye el archivo CSS -->
    <script src="../../Resources/JS/Dashboard.js" defer></script> <!-- Incluye el script JS modificado -->
    <title>Editar Beneficiario</title>
</head>
<body>
    <h1>Editar Beneficiario</h1>

    <form method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="<?= htmlspecialchars($beneficiario['nombre']) ?>" required><br>

        <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
        <input type="date" name="fecha_nacimiento" value="<?= $beneficiario['fecha_nacimiento'] ?>" required><br>

        <label for="direccion">Dirección:</label>
        <input type="text" name="direccion" value="<?= htmlspecialchars($beneficiario['direccion']) ?>" required><br>

        <label for="nivel_edu">Nivel Educativo:</label>
        <input type="text" name="nivel_edu" value="<?= htmlspecialchars($beneficiario['nivel_edu']) ?>" required><br>

        <label for="situacion_eco">Situación Económica:</label>
        <input type="text" name="situacion_eco" value="<?= htmlspecialchars($beneficiario['situacion_eco']) ?>" required><br>

        <label for="programa_asig">Programa Asignado:</label>
        <input type="text" name="programa_asig" value="<?= htmlspecialchars($beneficiario['programa_asig']) ?>" required><br>

        <button type="submit">Guardar Cambios</button>
    </form>
</body>
</html>
