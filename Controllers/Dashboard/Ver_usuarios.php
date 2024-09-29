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
    <link rel="stylesheet" href="../../Resources/css/Style.css">
    <title>Usuarios Registrados</title>
</head>
<body>
    <h2>Lista de Usuarios</h2>
    <table>
        <thead>
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
                        <a href="editar_usuario.php?id=<?= $user['id']; ?>">Editar</a>
                        <a href="eliminar_usuario.php?id=<?= $user['id']; ?>">Eliminar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>

<?php
$conn->close(); // Cierra la conexión
?>
