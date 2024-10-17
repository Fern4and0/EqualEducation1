<?php
session_start();
require_once '../../DB/DB.php'; // Incluye la conexión a la base de datos desde DB.php

if (!defined('BASE_URL')) {
    define('BASE_URL', 'http://yourdomain.com/'); // Replace with your actual base URL
}
$conn = new mysqli('localhost', 'root', '', 'ong');

// Verifica si el usuario está logueado como admin
if ($_SESSION['id_rol'] != 1) { // 1 = Administrador
    header('Location: ' . BASE_URL . 'Login/Login.php');
    exit;
}
// Enviar un mensaje
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $remitente_id = $_SESSION['user_id'];
    $destinatario_id = $_POST['destinatario_id'];
    $mensaje = $_POST['mensaje'];

    $query = "INSERT INTO mensajes (remitente_id, destinatario_id, mensaje) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('iis', $remitente_id, $destinatario_id, $mensaje);
    $stmt->execute();
    echo "Mensaje enviado!";
}

// Mostrar mensajes recibidos
$query = "SELECT m.mensaje, u.nombre AS remitente, m.fecha_envio 
          FROM mensajes m 
          JOIN users u ON m.remitente_id = u.id
          WHERE m.destinatario_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Mensajería - Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .chat-container {
            display: flex;
            flex-direction: column;
            max-width: 600px;
            margin: 0 auto;
        }
        .chat-box {
            border: 1px solid #ccc;
            padding: 10px;
            height: 300px;
            overflow-y: scroll;
            margin-bottom: 10px;
        }
        .chat-message {
            margin-bottom: 10px;
        }
        .chat-message strong {
            display: block;
        }
        .chat-form {
            display: flex;
            flex-direction: column;
        }
        .chat-form textarea {
            resize: none;
            height: 100px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="chat-container">
    <h1>Panel de Mensajería - Admin</h1>

    <div class="chat-box">
        <h2>Mensajes recibidos</h2>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <div class="chat-message">
                <strong>De: <?= $row['remitente'] ?></strong>
                <p><?= $row['mensaje'] ?></p>
                <small>Fecha: <?= $row['fecha_envio'] ?></small>
            </div>
            <hr>
        <?php } ?>
    </div>

    <form action="admin.php" method="POST" class="chat-form">
        <label for="destinatario">Enviar a:</label>
        <select name="destinatario_id" id="destinatario">
            <?php
            // Obtener coordinadores y donantes
            $query = "SELECT id, nombre FROM users WHERE id_rol IN (2, 3)";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='{$row['id']}'>{$row['nombre']}</option>";
            }
            ?>
        </select>
        <label for="mensaje">Mensaje:</label>
        <textarea name="mensaje" id="mensaje" required></textarea>
        <button type="submit">Enviar</button>
    </form>
</div>

</body>
</html>
