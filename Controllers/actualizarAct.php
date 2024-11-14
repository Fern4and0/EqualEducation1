<?php

session_start();

include '../DB/DB.php';

try {
    // Crear una conexión PDO
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['nombre'], $_POST['fecha'], $_POST['descripcion'])) {
        // Obtener los datos del formulario
        $id = intval($_POST['id']);
        $nombre = $_POST['nombre'];
        $fecha = $_POST['fecha'];
        $descripcion = $_POST['descripcion'];

        // Preparar y ejecutar la consulta SQL para actualizar el registro
        $stmt = $pdo->prepare("UPDATE actividades SET nombre = :nombre, descripcion = :descripcion WHERE id = :id");
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "Usuario actualizado correctamente.";
        } else {
            echo "Error al actualizar el usuario.";
        }
    } else {
        echo "Datos incompletos.";
    }
} catch (PDOException $e) {
    echo "Error en la conexión o en la consulta: " . $e->getMessage();
}

// Cerrar conexión
$conn->close();

?>