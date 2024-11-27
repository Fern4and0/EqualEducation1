<?php
session_start(); // Inicia la sesión

// Verifica si hay una sesión activa (es decir, si el usuario ha iniciado sesión)
if (!isset($_SESSION['user_id'])) {
    header("Location: ../Resources/Views/Login.html"); // Redirige al login si no está autenticado
    exit(); // Detiene la ejecución del script
}

include '../../../DB/db.php'; // Incluye la conexión a la base de datos

// Obtener lista de usuarios
$sql = "SELECT * FROM users"; // Se define la consulta SQL para obtener todos los usuarios
$result = $conn->query($sql); // Ejecuta la consulta y guarda el resultado

if ($result->num_rows > 0) {
    $users = $result->fetch_all(MYSQLI_ASSOC); // Si hay filas, se almacenan los datos en un arreglo asociativo
} else {
    $users = []; // Si no hay resultados, se inicializa un arreglo vacío
}

$conn->close();  // Cierra la conexión a la base de datos

// Función para obtener el nombre del rol a partir del id_rol
function getRoleName($id_rol) {
    switch ($id_rol) {
        case 1:
            return 'Administrador';
        case 2:
            return 'Coordinador';
        case 3:
            return 'Beneficiario';
        case 4:
            return 'Voluntario';
        case 5:
            return 'Donador';
        default:
            return 'Desconocido';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coordinador Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
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
        .btn-suspend {
            background-color: #ffc107;
            color: #fff;
        }
        .btn-activate {
            background-color: #28a745;
            color: #fff;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#" style="padding: 10;">
            <img src="../../Resources/Images/logo.png" width="50" height="50" class="d-inline-block align-top" alt="Equal Education Logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav"></div>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"></li>
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'Administrador-Dashboard.php' ? 'active' : ''; ?>" href="../Administrador-Dashboard.php"><i class="fas fa-home"></i> Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'Donaciones.php' ? 'active' : ''; ?>" href="../Donaciones.php"><i class="fas fa-donate"></i> Registro de Donaciones y Gastos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'Monitoreo.php' ? 'active' : ''; ?>" href="../Monitoreo.php"><i class="fas fa-chart-line"></i> Monitoreo de Indicadores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'Informes.php' ? 'active' : ''; ?>" href="../Informes.php"><i class="fas fa-file-alt"></i> Generación de Informes</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownUsuarios" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-users-cog"></i> Gestión de Usuarios
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownUsuarios">
                        <a class="dropdown-item" href="Administradores.php">Administradores</a>
                        <a class="dropdown-item" href="Coordinador.php">Coordinadores</a>
                        <a class="dropdown-item" href="Beneficiarios.php">Beneficiarios</a>
                        <a class="dropdown-item" href="Donadores.php">Donadores</a>
                        <a class="dropdown-item" href="Voluntarios.php">Voluntarios</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="../../Login/Logout.php">Cerrar Sesión</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container"> 
        <div class="row">
            <div class="col-md-12">
                <h2>Coordinadores Registrados</h2>

                <!-- Tabla para Coordinadores -->
                <div class="card">
                    <div class="card-header">
                        Coordinadores
                    </div>
                    <div class="card-body">
                        <!-- Barra de búsqueda -->
                        <div class="form-group">
                            <input type="text" id="searchInputCoordinadores" class="form-control" placeholder="Buscar usuarios...">
                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Rol</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="userTableCoordinadores"></tbody></tbody>
                                <?php foreach ($users as $user): ?>
                                    <?php if ($user['id_rol'] == 2): ?>
                                        <tr>
                                            <td><?php echo $user['id']; ?></td>
                                            <td><?php echo !empty($user['nombre']) ? htmlspecialchars($user['nombre'], ENT_QUOTES, 'UTF-8') : 'N/A'; ?></td>
                                            <td><?php echo htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td><?php echo getRoleName($user['id_rol']); ?></td>
                                            <td><?php echo htmlspecialchars($user['estatus_cuenta'], ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td>
                                                <button class="btn btn-primary btn-sm edit-btn" 
                                                    data-id="<?php echo htmlspecialchars($user['id'], ENT_QUOTES, 'UTF-8'); ?>" 
                                                    data-name="<?php echo htmlspecialchars($user['nombre'], ENT_QUOTES, 'UTF-8'); ?>" 
                                                    data-email="<?php echo htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8'); ?>" 
                                                    data-role="<?php echo htmlspecialchars($user['id_rol'], ENT_QUOTES, 'UTF-8'); ?>">Editar</button>
                                                <button class="btn btn-danger btn-sm delete-btn" 
                                                    data-id="<?php echo htmlspecialchars($user['id'], ENT_QUOTES, 'UTF-8'); ?>">Eliminar</button>
                                                <button class="btn btn-sm suspend-btn <?php echo $user['estatus_cuenta'] == 'Activo' ? 'btn-suspend' : 'btn-activate'; ?>" 
                                                    data-id="<?php echo htmlspecialchars($user['id'], ENT_QUOTES, 'UTF-8'); ?>" 
                                                    data-status="<?php echo htmlspecialchars($user['estatus_cuenta'], ENT_QUOTES, 'UTF-8'); ?>">
                                                    <?php echo $user['estatus_cuenta'] == 'Activo' ? 'Suspender' : 'Activar'; ?>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <script>
                    // Script para filtrar usuarios en la tabla de Coordinadores
                    document.getElementById('searchInputCoordinadores').addEventListener('keyup', function() {
                        var input = this.value.toLowerCase();
                        var rows = document.querySelectorAll('#userTableCoordinadores tr');
                        rows.forEach(function(row) {
                            var name = row.cells[1].textContent.toLowerCase();
                            var email = row.cells[2].textContent.toLowerCase();
                            row.style.display = (name.includes(input) || email.includes(input)) ? '' : 'none';
                        });
                    });
                </script>
            </div>
        </div>
    </div>

    <!-- Modal para editar usuario -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Editar Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm" action="../mecanicas/edit_user.php" method="POST">
                        <input type="hidden" id="edit-id" name="id">
                        <div class="form-group">
                            <label for="edit-name">Nombre</label>
                            <input type="text" class="form-control" id="edit-name" name="nombre">
                        </div>
                        <div class="form-group">
                            <label for="edit-email">Email</label>
                            <input type="email" class="form-control" id="edit-email" name="email">
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para confirmar eliminación de usuario -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmar Eliminación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar este usuario?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Eliminar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Script para pasar los datos al modal de edición
        $('.edit-btn').on('click', function() {
            var id = $(this).data('id');
            var name = $(this).data('name');
            var email = $(this).data('email');
            var role = $(this).data('role');

            $('#edit-id').val(id);
            $('#edit-name').val(name);
            $('#edit-email').val(email);
            $('#edit-role').val(role);

            $('#editModal').modal('show'); // Muestra el modal
        });

        // Script para confirmar eliminación
        $('.delete-btn').on('click', function() {
            var id = $(this).data('id');
            $('#confirmDeleteBtn').data('id', id);
            $('#deleteModal').modal('show'); // Muestra el modal de confirmación
        });

        // Script para eliminar usuario
        $('#confirmDeleteBtn').on('click', function() {
            var id = $(this).data('id');
            window.location.href = '../mecanicas/delete_user.php?id=' + id;
        });

        // Script para suspender/activar usuario
        $('.suspend-btn').on('click', function() {
            var id = $(this).data('id');
            var status = $(this).data('status');
            var action = status === 'Activo' ? 'suspender' : 'activar';

            $.ajax({
                url: '../mecanicas/solicitudes.php',
                type: 'POST',
                data: { id_usuario: id, [action]: true },
                success: function(response) {
                    location.reload(); // Recarga la página para reflejar los cambios
                }
            });
        });
    </script>
</body>
</html>
