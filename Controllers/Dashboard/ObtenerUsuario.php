<?php
// Incluimos el archivo de conexión a la base de datos
include '../../DB/db.php'; 

// Obtenemos el ID del usuario desde los parámetros de la URL
$id = $_GET['id'];

// Creamos la consulta SQL para obtener los datos del usuario con el ID especificado
$sql = "SELECT * FROM users WHERE id='$id'";

// Ejecutamos la consulta y almacenamos el resultado
$result = $conn->query($sql);

// Verificamos si la consulta devolvió algún resultado
if ($result->num_rows > 0) {
    // Si hay resultados, obtenemos los datos del usuario en un array asociativo
    $user = $result->fetch_assoc();
    // Convertimos los datos del usuario a formato JSON y los mostramos
    echo json_encode($user);
} else {
    // Si no hay resultados, mostramos un mensaje de error en formato JSON
    echo json_encode(["error" => "Usuario no encontrado"]);
}

// Cerramos la conexión a la base de datos
$conn->close();
?>
