<?php
session_start();
require_once '../../DB/DB.php'; // Incluye la conexión a la base de datos desde DB.php

if (!defined('BASE_URL')) {
    define('BASE_URL', 'http://yourdomain.com/'); // Replace with your actual base URL
}
$conn = new mysqli('localhost', 'root', '', 'ong');

// Verifica si el usuario está logueado como coordinador
if ($_SESSION['id_rol'] != 2) { // 2 = Coordinador
    header('Location: ' . BASE_URL . 'login.php');
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
    <title>Panel de Mensajería - Coordinador</title>
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
        .messages {
            border: 1px solid #ccc;
            padding: 10px;
            height: 300px;
            overflow-y: scroll;
            margin-bottom: 10px;
        }
        .message {
            margin-bottom: 10px;
        }
        .message strong {
            display: block;
        }
        .send-message {
            display: flex;
            flex-direction: column;
        }
        .send-message textarea {
            resize: none;
            height: 100px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="chat-container">
    <h1>Panel de Mensajería - Coordinador</h1>

    <div class="messages">
        <h2>Mensajes recibidos</h2>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <div class="message">
                <strong>De: <?= $row['remitente'] ?></strong>
                <p><?= $row['mensaje'] ?></p>
                <small>Fecha: <?= $row['fecha_envio'] ?></small>
            </div>
        <?php } ?>
    </div>

    <form class="send-message" action="Coordinador.php" method="POST">
        <label for="destinatario">Enviar a:</label>
        <select name="destinatario_id" id="destinatario">
            <?php
            // Obtener administradores
            $query = "SELECT id, nombre FROM users WHERE id_rol = 1"; // 1 = Administrador
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
