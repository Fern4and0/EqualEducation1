<?php
include '../../DB/db.php';

// Obtén los valores para los parámetros
$razon = $_POST['razon']; // Asegúrate de que este valor venga de un formulario o algún input
$localidad = $_POST['localidad'];
$ocupacion = $_POST['ocupacion'];
$preferencias_educativas = $_POST['preferencias_educativas'];
$user_id = $_SESSION['user_id']; // O el valor que tengas de sesión

// Actualiza los datos en la base de datos
$query = "UPDATE beneficiarios SET razon = ?, localidad = ?, ocupacion = ?, preferencias_educativas = ? WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssssi", $razon, $localidad, $ocupacion, $preferencias_educativas, $user_id);
$stmt->execute();

// Verifica si la actualización fue exitosa
if ($stmt->affected_rows > 0) {
    echo "Datos actualizados correctamente.";
} else {
    echo "No se realizaron cambios.";
}

// Cierra la conexión
$conn->close();
?>