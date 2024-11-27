<?php
    session_start(); // Inicia la sesión

    // Verifica si el usuario ha iniciado sesión
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../../Resources/Views/Login.html"); // Redirige al login si no está autenticado
        exit(); // Detiene la ejecución
    }

include '../../DB/db.php'; 

// Consulta para obtener los programas activos
$query = "SELECT id, nombre, descripcion, fecha_ini, fecha_fin, foto, ubicacion, tipo FROM programas WHERE estatus = 'Activo'";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programas</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php include 'navbar.php'; ?>       
<!-- Contenido de Programas -->
    <div class="container mt-5">
        <h1 class="text-center">Programas Disponibles</h1>
        <div class="row">
            <?php
            if ($result->num_rows > 0) {
                while ($programa = $result->fetch_assoc()) {
                    echo '
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            ' . (!empty($programa['foto']) ? '<img src="/uploads/' . $programa['foto'] . '" class="card-img-top" alt="Foto del programa">' : '') . '
                            <div class="card-body">
                                <h5 class="card-title">' . htmlspecialchars($programa['nombre']) . '</h5>
                                <p class="card-text">' . htmlspecialchars($programa['descripcion']) . '</p>
                                <p><strong>Ubicación:</strong> ' . htmlspecialchars($programa['ubicacion']) . '</p>
                                <p><strong>Tipo:</strong> ' . htmlspecialchars($programa['tipo']) . '</p>
                                <p><strong>Fechas:</strong> ' . htmlspecialchars($programa['fecha_ini']) . ' - ' . htmlspecialchars($programa['fecha_fin']) . '</p>
                            </div>
                        </div>
                    </div>
                    ';
                }
            } else {
                echo '<p class="text-center">No hay programas disponibles en este momento.</p>';
            }

            // Cerrar la conexión aquí, después de la consulta
            ?> 
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>