<?php
// Incluye el archivo de conexión a la base de datos
include 'DB.php';

// Función para enviar un mensaje entre dos usuarios
function enviarMensaje($emisor_id, $receptor_id, $mensaje) {
    global $conn;
    $sql = "INSERT INTO mensajes (emisor_id, receptor_id, mensaje) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $emisor_id, $receptor_id, $mensaje);
    return $stmt->execute();
}

// Función para obtener todos los mensajes entre dos usuarios, ordenados por fecha de envío
function obtenerMensajes($usuario1_id, $usuario2_id) {
    global $conn;
    $sql = "SELECT * FROM mensajes 
            WHERE (emisor_id = ? AND receptor_id = ?) 
               OR (emisor_id = ? AND receptor_id = ?) 
            ORDER BY fecha_envio ASC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiii", $usuario1_id, $usuario2_id, $usuario2_id, $usuario1_id);
    $stmt->execute();
    return $stmt->get_result();
}

// Función para verificar si dos roles pueden comunicarse entre sí
function puedeComunicar($emisor_rol, $receptor_rol) {
    // Define los roles permitidos para la comunicación
    $permitidos = [
        'Administrador' => ['Coordinador'],
        'Coordinador' => ['Administrador', 'Beneficiario', 'Donador', 'Voluntario'],
        'Beneficiario' => ['Coordinador'],
        'Donador' => ['Coordinador'],
        'Voluntario' => ['Coordinador']
    ];
    return in_array($receptor_rol, $permitidos[$emisor_rol]);
}

// Función para obtener el rol de un usuario a partir de su ID
function obtenerRol($user_id) {
    global $conn;
    $sql = "SELECT rol FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    return $result['rol'];
}
?>
