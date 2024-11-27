<?php
// Conexión a la base de datos
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'ong';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die(sprintf("Error de conexión: %s", $conn->connect_error));
}

// Procesar acciones
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? null;
    $id_solicitud = isset($_POST['id_solicitud']) ? intval($_POST['id_solicitud']) : null;
    $tipo_solicitud = $_POST['tipo_solicitud'] ?? null;

    if ($accion === 'aceptar') {
        // Aceptar solicitud
        $nombre = "Usuario Registrado"; // Cambiar a datos específicos si es necesario
        $email = "correo@predeterminado.com";
        $password = password_hash('contraseña_predeterminada', PASSWORD_BCRYPT);

        // Obtener rol según el tipo de solicitud
        $id_rol = match ($tipo_solicitud) {
            'beneficiario' => 3,
            'voluntario' => 4,
            'coordinador' => 2,
            default => 0
        };

        // Insertar en users
        if ($id_rol > 0) {
            $query = "INSERT INTO users (nombre, email, password, id_rol) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sssi", $nombre, $email, $password, $id_rol);
            $stmt->execute();
        }

        // Eliminar la solicitud procesada
        $query_delete = "DELETE FROM $tipo_solicitud WHERE id = ?";
        $stmt_delete = $conn->prepare($query_delete);
        $stmt_delete->bind_param("i", $id_solicitud);
        $stmt_delete->execute();

        echo "Solicitud aceptada.";
    } elseif ($accion === 'rechazar') {
        // Rechazar solicitud (solo eliminar)
        $query_delete = "DELETE FROM $tipo_solicitud WHERE id = ?";
        $stmt_delete = $conn->prepare($query_delete);
        $stmt_delete->bind_param("i", $id_solicitud);
        $stmt_delete->execute();

        echo "Solicitud rechazada.";
    }
}

// Obtener todas las solicitudes
$solicitudes = [];
$tablas = ['beneficiarios', 'voluntarios', 'coordinadores'];

foreach ($tablas as $tabla) {
    $query = "SELECT * FROM $tabla";
    $result = $conn->query($query);
    while ($row = $result->fetch_assoc()) {
        $row['tipo'] = $tabla;
        $solicitudes[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitudes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Solicitudes Recibidas</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tipo</th>
                <th>Detalles</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($solicitudes as $solicitud): ?>
                <tr>
                    <td><?= $solicitud['id'] ?></td>
                    <td><?= ucfirst($solicitud['tipo']) ?></td>
                    <td>
                        <pre><?= json_encode($solicitud, JSON_PRETTY_PRINT) ?></pre>
                    </td>
                    <td>
                        <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#aceptarModal" data-id="<?= $solicitud['id'] ?>" data-tipo="<?= $solicitud['tipo'] ?>">Aceptar</button>
                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rechazarModal" data-id="<?= $solicitud['id'] ?>" data-tipo="<?= $solicitud['tipo'] ?>">Rechazar</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal Aceptar -->
<div class="modal fade" id="aceptarModal" tabindex="-1" aria-labelledby="aceptarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="aceptarModalLabel">Aceptar Solicitud</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <p>¿Estás seguro de que deseas aceptar esta solicitud?</p>
                    <input type="hidden" name="accion" value="aceptar">
                    <input type="hidden" name="id_solicitud" id="aceptarId">
                    <input type="hidden" name="tipo_solicitud" id="aceptarTipo">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Aceptar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Rechazar -->
<div class="modal fade" id="rechazarModal" tabindex="-1" aria-labelledby="rechazarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="rechazarModalLabel">Rechazar Solicitud</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <p>¿Estás seguro de que deseas rechazar esta solicitud?</p>
                    <input type="hidden" name="accion" value="rechazar">
                    <input type="hidden" name="id_solicitud" id="rechazarId">
                    <input type="hidden" name="tipo_solicitud" id="rechazarTipo">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Rechazar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Pasar datos al modal de aceptar
    var aceptarModal = document.getElementById('aceptarModal');
    aceptarModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var tipo = button.getAttribute('data-tipo');
        document.getElementById('aceptarId').value = id;
        document.getElementById('aceptarTipo').value = tipo;
    });

    // Pasar datos al modal de rechazar
    var rechazarModal = document.getElementById('rechazarModal');
    rechazarModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var tipo = button.getAttribute('data-tipo');
        document.getElementById('rechazarId').value = id;
        document.getElementById('rechazarTipo').value = tipo;
    });
</script>
</body>
</html>
