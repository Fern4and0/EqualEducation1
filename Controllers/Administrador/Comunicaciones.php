<?php
// Incluye el archivo de mensajes para acceder a las funciones de comunicación
include '../../DB/mensajes.php';

// IDs de prueba (en un proyecto real, estos IDs vendrían de la sesión o de los datos de la solicitud)
$emisor_id = 1;  // ID del Administrador actual
$receptor_id = 2;  // ID del Coordinador con el que se quiere comunicar
$mensaje = "Hola, este es un mensaje de prueba del Administrador al Coordinador."; // Mensaje de ejemplo

// Obtener los roles de los usuarios
$emisor_rol = obtenerRol($emisor_id);
$receptor_rol = obtenerRol($receptor_id);

// Verificar si el emisor puede comunicarse con el receptor
if (puedeComunicar($emisor_rol, $receptor_rol)) {
    // Enviar el mensaje si los roles tienen permiso para comunicarse
    if (enviarMensaje($emisor_id, $receptor_id, $mensaje)) {
        echo "Mensaje enviado exitosamente.";
    } else {
        echo "Error al enviar el mensaje.";
    }
} else {
    echo "No tienes permiso para comunicarte con este usuario.";
}

// Obtener y mostrar el historial de mensajes entre el Administrador y el Coordinador
$mensajes = obtenerMensajes($emisor_id, $receptor_id);

echo "<h2>Historial de Mensajes</h2>";
while ($fila = $mensajes->fetch_assoc()) {
    $emisor = $fila['emisor_id'] == $emisor_id ? "Tú" : "Coordinador";
    echo "<p><strong>$emisor:</strong> " . $fila['mensaje'] . "</p>";
}
?>
