<?php
session_start();
include '../DB/db.php'; // Conexión a la base de datos

$sql = "SELECT * FROM users"; // Obtiene todos los usuarios
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"> <!-- Iconos -->
    <title>Usuarios Registrados</title>

    <style>
        body {
            background-color: #f8f9fa;
        }
        .table-container {
            margin: 50px auto;
            padding: 20px;
            width: 95%;
            max-width: 1200px;
            background-color: #ffffff;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .table thead th {
            background-color: #343a40; /* Color del header */
            color: #fff;
            position: sticky;
            top: 0;
            z-index: 1;
        }
        .table tbody tr:hover {
            background-color: #f1f1f1;
        }
        .btn-action {
            margin-right: 10px;
        }
        .table th, .table td {
            vertical-align: middle;
            text-align: center;
        }
        .icon-btn {
            font-size: 1.2rem;
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #343a40;
        }
    </style>
</head>
<body>

    <div class="container table-container">
        <h2>Lista de Usuarios</h2>
        <table class="table table-hover table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while($user = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $user['id']; ?></td>
                        <td><?= $user['nombre']; ?></td>
                        <td><?= $user['email']; ?></td>
                        <td><?= $user['id_rol']; ?></td>
                        <td>
                            <a href="editar_usuario.php?id=<?= $user['id']; ?>" class="btn btn-warning btn-sm btn-action">
                                <i class="fas fa-edit icon-btn"></i> Editar
                            </a>
                            <a href="eliminar_usuario.php?id=<?= $user['id']; ?>" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash-alt icon-btn"></i> Eliminar
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close(); // Cierra la conexión
?>
