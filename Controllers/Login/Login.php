<?php
session_start(); // Iniciamos la sesión

include '../../DB/DB.php'; // Incluimos la conexión a la base de datos

$error = ''; // Inicializamos la variable de error

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Verificamos si la solicitud es de tipo POST
    $email = $_POST['email']; // Obtenemos el email del formulario
    $password = $_POST['password']; // Obtenemos el password del formulario

    // Preparación de la consulta para evitar inyecciones SQL
    $sql = "SELECT id, email, password, nombre, id_rol FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) { // Verificamos si la consulta devolvió algún resultado
        $user = $result->fetch_assoc(); // Obtenemos los datos del usuario

        // Verificamos si el password coincide
        if (password_verify($password, $user['password'])) { // Comparamos el password ingresado con el almacenado
            // Guardamos la información del usuario en la sesión
            $_SESSION['user_id'] = $user['id']; // Guardamos el ID del usuario en la sesión
            $_SESSION['user_name'] = $user['nombre']; // Guardamos el nombre del usuario en la sesión
            $_SESSION['user_email'] = $user['email']; // Guardamos el email del usuario en la sesión
            $_SESSION['user_rol'] = $user['id_rol']; // Guardamos el rol del usuario en la sesión

            // Redirigimos según el rol del usuario
            switch ($user['id_rol']) {
                case 1: // Administrador
                    header("Location: ../Administrador/Administrador-Dashboard.php");
                    break;
                case 2: // Coordinador
                    header("Location: ../Coordinador/Cordi-Dashboard.php");
                    break;
                case 3: // Beneficiario
                    header("Location: ../Beneficiario/Beneficiario-Dashboard.php");
                    break;
                case 4: // Voluntario
                    header("Location: ../Voluntario/Voluntario-Dashboard.php");
                    break;
                case 5: // Donador
                    header("Location: ../Donador/Donador-Dashboard.php");
                    break;
                default:
                    // Rol desconocido, redirigimos a Inicio
                    header("Location: ../../Inicio.php");
            }
            exit(); // Terminamos la ejecución del script
        } else {
            $error = "Tus Credenciales son incorrectas, intenta de nuevo por favor."; // Mensaje de error si el password no coincide
        }
    } else {
        $error = "Tus Credenciales son incorrectas, intenta de nuevo por favor."; // Mensaje de error si el usuario no existe
    }

    $stmt->close(); // Cerramos el statement
    $conn->close(); // Cerramos la conexión a la base de datos
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../../Resources/css/styles_login.css">
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var errorElement = document.getElementById("error-message");
            if (errorElement) {
                setTimeout(function() {
                    errorElement.style.display = 'none';
                }, 3000); // 5000 milisegundos = 5 segundos
            }
        });
    </script>
</head>
<body>
    <div class="container">
        <h2>Iniciar Sesión</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required placeholder="Ingresa tu correo">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required placeholder="Ingresa tu contraseña">
            </div>
            <button type="submit">Login</button>
        </form>
        <?php
        if (!empty($error)) {
            echo '<p id="error-message" style="color:red;">' . $error . '</p>';
        }
        ?>
    </div>
</body>
</html>
