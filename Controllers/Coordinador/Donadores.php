<?php
// Controllers/Coordinador/Donadores.php

session_start(); // Inicia la sesión

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../Resources/Views/Login.html"); // Redirige al login si no está autenticado
    exit(); // Detiene la ejecución
}

include '../../DB/db.php'; // Incluye la conexión a la base de datos

// Verifica si la conexión a la base de datos se ha establecido correctamente
if ($conn->connect_error) {
    die("Connection failed: {$conn->connect_error}");
}

// Consulta para obtener la cantidad de donadores registrados
$sqlDonadores = "SELECT COUNT(*) AS total_donadores FROM donaciones";
$resultDonadores = $conn->query($sqlDonadores); // Ejecuta la consulta
$totalDonadores = $resultDonadores->fetch_assoc()['total_donadores']; // Obtiene el resultado de la consulta

// Consulta para obtener la lista de donadores
$sqlListaDonadores = "SELECT id, first_name, last_name, email FROM donaciones"; // Ajusta los nombres de columna según tu base de datos
$resultListaDonadores = $conn->query($sqlListaDonadores); // Ejecuta la consulta

// Cerrar la conexión a la base de datos
$conn->close(); // Cierra la conexión a la base de datos
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donadores</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            margin-bottom: 20px;
        }
        .card {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<?php include('layout/header.php') ?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Donadores Registrados</h5>
                        <p class="card-text">Total de donadores registrados: <span class="number"><?= $totalDonadores; ?></span></p>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = $resultListaDonadores->fetch_assoc()): ?>
                                    <tr>
                                        <td><?= $row['id']; ?></td>
                                        <td><?= $row['nombre']; ?></td>
                                        <td><?= $row['apellido']; ?></td>
                                        <td><?= $row['correo']; ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
