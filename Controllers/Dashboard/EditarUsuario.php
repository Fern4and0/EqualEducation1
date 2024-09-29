<?php
// Incluye el archivo de conexión a la base de datos
include '../../DB/db.php'; 

// Verifica si la solicitud se realizó mediante el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene el ID del usuario desde el formulario
    $id = $_POST['id'];
    // Obtiene el nombre del usuario desde el formulario
    $nombre = $_POST['nombre'];
    // Obtiene el email del usuario desde el formulario
    $email = $_POST['email'];
    // Obtiene el ID del rol del usuario desde el formulario
    $id_rol = $_POST['id_rol'];

    // Prepara la consulta SQL para actualizar los datos del usuario
    $sql = "UPDATE users SET nombre='$nombre', email='$email', id_rol='$id_rol' WHERE id='$id'";

    // Ejecuta la consulta y verifica si se realizó correctamente
    if ($conn->query($sql) === TRUE) {
        // Redirige al usuario al dashboard si la actualización fue exitosa
        header('Location: Usuarios.php');
    } else {
        // Muestra un mensaje de error si la actualización falló
        echo "Error actualizando usuario: " . $conn->error;
    }

    // Cierra la conexión a la base de datos
    $conn->close();
}
?>
