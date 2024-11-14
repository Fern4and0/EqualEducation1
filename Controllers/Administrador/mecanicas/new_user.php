<?php
session_start(); // Inicia la sesión

// Verifica si hay una sesión activa
if (!isset($_SESSION['user_id'])) {
    header("Location: ../Resources/Views/Login.html"); // Redirige al login si no está autenticado
    exit();
}

include '../../../DB/db.php'; // Incluye la conexión a la base de datos

// Inicializar variables
$nombre = '';
$email = '';
$id_rol = 1; // Valor por defecto

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Procesar el formulario de creación
    $nombre = $_POST['nombre']; // Corregido de 'name' a 'nombre'
    $email = $_POST['email'];
    $id_rol = intval($_POST['id_rol']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Encriptar la contraseña

    $sql = "INSERT INTO users (nombre, email, id_rol, password) VALUES (?, ?, ?, ?)"; // Corregido de 'name' a 'nombre'

    // Preparar la declaración
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssis", $nombre, $email, $id_rol, $password); // Asigna los parámetros

    if ($stmt->execute()) {
        // Si se ejecuta correctamente, redirige al panel de usuarios
        // Redirige a la página correspondiente según el rol del usuario
        switch ($id_rol) {
            case 1:
                header("Location: ../Tabla/Administradores.php");
                break;
            case 2:
                header("Location: ../Tabla/Coordinador.php");
                break;
            case 3:
                header("Location: ../Tabla/Beneficiarios.php");
                break;
            case 4:
                header("Location: ../Tabla/Voluntarios.php");
                break;
            case 5:
                header("Location: ../Tabla/Donadores.php");
                break;
            default:
                header("Location: ../Usuarios.php");
                break;
        }
    } else {
        // Si ocurre un error
        echo "Error al crear el usuario: {$conn->error}";
    }

    $stmt->close(); // Cierra la declaración
}

$conn->close(); // Cierra la conexión a la base de datos
?>