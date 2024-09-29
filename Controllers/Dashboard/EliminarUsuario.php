<?php
// Incluye el archivo de conexión a la base de datos
include '../../DB/db.php'; 

// Obtiene el ID del usuario a eliminar desde la URL
$id = $_GET['id'];

// Crea la consulta SQL para eliminar el usuario con el ID especificado
$sql = "DELETE FROM users WHERE id='$id'";

// Ejecuta la consulta y verifica si fue exitosa
if ($conn->query($sql) === TRUE) {
    // Si la eliminación fue exitosa, redirige al usuario al dashboard
    header('Location: Usuarios.php');
} else {
    // Si hubo un error al eliminar el usuario, muestra un mensaje de error
    echo "Error eliminando usuario: " . $conn->error;
}

// Cierra la conexión a la base de datos
$conn->close();
?>
