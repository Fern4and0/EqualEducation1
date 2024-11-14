<?php

session_start();

include '../DB/DB.php';

try {
    // Crear una conexión PDO
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
        // Obtener el id del usuario a eliminar
        $id = intval($_POST['id']);

        // Preparar y ejecutar la consulta SQL para eliminar el registro
        $stmt = $pdo->prepare("DELETE FROM actividades WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            echo "Usuario eliminado correctamente.";
        } else {
            echo "Error al eliminar el usuario.";
        }
    } else {
        echo "ID de usuario no especificado.";
    }
} catch (PDOException $e) {
    echo "Error en la conexión o en la consulta: " . $e->getMessage();
}

// Cerrar conexión
$conn->close();

?>