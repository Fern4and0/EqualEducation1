<?php
session_start(); // Inicia la sesión

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: ../Resources/Views/Login.html"); // Redirige al login si no está autenticado
    exit(); // Detiene la ejecución
}

include '../../DB/db.php'; // Incluye la conexión a la base de datos

// Filtrar los informes por tipo si se ha seleccionado un tipo
$tipo = isset($_POST['tipo_filtro']) ? $_POST['tipo_filtro'] : '';
$sql = "SELECT * FROM informes";
if ($tipo) {
    $sql .= " WHERE tipo = '$tipo'";
}
$result = $conn->query($sql); // Ejecuta la consulta

// Cierra la conexión a la base de datos al final
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="../../Resources/css/nuevo.css"> <!-- Incluye el archivo CSS -->
    <link rel="stylesheet" href="../../Resources/css/Informes.css">
    <link rel="stylesheet" href="../../Resources/css/Informes2.css">

    <script src="../../Resources/js/Dashboard.js" defer></script> <!-- Incluye el script JS modificado -->
    <script src="../../Resources/js/dash.js" defer></script> <!-- Incluye el script JS modificado -->
     
    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>Admin Dashboard Panel</title>
</head>
<body>
    <nav>
        <div class="logo-name">
            <span class="logo_name">Equal Education</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="Dashboard.php">
                    <i class="uil uil-estate"></i>
                    <span class="link-name">Inicio</span>
                </a></li>
                <li><a href="usuarios.php">
                    <i class="uil uil-users-alt"></i>
                    <span class="link-name">Usuarios</span>
                </a></li>
                <li><a href="Informes.php">
                    <i class="uil uil-file-alt"></i>
                    <span class="link-name">Informes</span>
                </a></li>
                <li><a href="Beneficiarios.php">
                    <i class="uil uil-user"></i>
                    <span class="link-name">Beneficiarios</span>
                </a></li>
                <li><a href="Donaciones.php">
                    <i class="uil uil-gift"></i>
                    <span class="link-name">Donaciones</span>
                </a></li>
            </ul>
            
            <ul class="logout-mode">
                <li class="mode" style="display: none;">
                    <div class="mode-toggle">
                        <span class="switch"></span>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
        </div>

        <div class="container">
            <h1><i class="uil uil-file-alt"></i> Informes</h1>
            <div class="d-flex justify-content-between mb-3">
                <button class="btn btn-filter" data-bs-toggle="modal" data-bs-target="#filtrarInformeModal">Filtrar</button>
                <button class="btn btn-create" data-bs-toggle="modal" data-bs-target="#crearInformeModal">Crear Informe</button>
            </div>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Programa</th>
                        <th>Tipo</th>
                        <th>Fecha</th>
                        <th>Contenido</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="informesTable">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['programa'] . "</td>";
                            echo "<td>" . $row['tipo'] . "</td>";
                            echo "<td>" . $row['fecha'] . "</td>";
                            echo "<td>" . $row['contenido'] . "</td>";
                            echo "<td>
                                    <button class='btn btn-sm btn-primary' data-bs-toggle='modal' data-bs-target='#editarInformeModal' data-id='" . $row['id'] . "' data-programa='" . $row['programa'] . "' data-tipo='" . $row['tipo'] . "' data-fecha='" . $row['fecha'] . "' data-contenido='" . $row['contenido'] . "'>Editar</button>
                                    <form method='POST' action='EliminarInforme.php' style='display:inline-block;'>
                                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                                        <button type='submit' class='btn btn-sm btn-danger'>Eliminar</button>
                                    </form>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No se encontraron informes</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Modal para Crear Nuevo Informe -->
        <div class="modal fade" id="crearInformeModal" tabindex="-1" aria-labelledby="crearInformeModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="crearInformeModalLabel">Crear Nuevo Informe</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form id="crearInformeForm" method="POST" action="AgregarInforme.php">
                    <div class="mb-3">
                    <label for="programa" class="form-label">Programa</label>
                    <select class="form-select" id="programa" name="programa" required>
                        <option selected disabled>Seleccionar programa</option>
                        <option value="Programa A">Programa A</option>
                        <option value="Programa B">Programa B</option>
                        <option value="Programa C">Programa C</option>
                    </select>
                    </div>
                    <div class="mb-3">
                    <label for="tipo" class="form-label">Tipo</label>
                    <select class="form-select" id="tipo" name="tipo" required>
                        <option selected disabled>Seleccionar tipo</option>
                        <option value="Anual">Anual</option>
                        <option value="Mensual">Mensual</option>
                        <option value="Semanal">Semanal</option>
                    </select>
                    </div>
                    <div class="mb-3">
                    <label for="fecha" class="form-label">Fecha</label>
                    <input type="month" class="form-control" id="fecha" name="fecha" min="2024-01" max="2024-12" required>
                    </div>
                    <div class="mb-3">
                    <label for="contenido" class="form-label">Contenido</label>
                    <textarea class="form-control" id="contenido" name="contenido" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-dark w-100">Agregar Informe</button>
                </form>
                </div>
            </div>
            </div>
        </div>

        <!-- Modal para Editar Informe -->
        <div class="modal fade" id="editarInformeModal" tabindex="-1" aria-labelledby="editarInformeModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="editarInformeModalLabel">Editar Informe</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form id="editarInformeForm" method="POST" action="EditarInforme.php">
                    <input type="hidden" id="edit-id" name="id">
                    <div class="mb-3">
                    <label for="edit-programa" class="form-label">Programa</label>
                    <select class="form-select" id="edit-programa" name="programa" required>
                        <option selected disabled>Seleccionar programa</option>
                        <option value="Programa A">Programa A</option>
                        <option value="Programa B">Programa B</option>
                        <option value="Programa C">Programa C</option>
                    </select>
                    </div>
                    <div class="mb-3">
                    <label for="edit-tipo" class="form-label">Tipo</label>
                    <select class="form-select" id="edit-tipo" name="tipo" required>
                        <option selected disabled>Seleccionar tipo</option>
                        <option value="Anual">Anual</option>
                        <option value="Mensual">Mensual</option>
                        <option value="Semanal">Semanal</option>
                    </select>
                    </div>
                    <div class="mb-3">
                    <label for="edit-fecha" class="form-label">Fecha</label>
                    <input type="month" class="form-control" id="edit-fecha" name="fecha" min="2024-01" max="2024-12" required>
                    </div>
                    <div class="mb-3">
                    <label for="edit-contenido" class="form-label">Contenido</label>
                    <textarea class="form-control" id="edit-contenido" name="contenido" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-dark w-100">Guardar Cambios</button>
                </form>
                </div>
            </div>
            </div>
        </div>

        <!-- Modal para Filtrar Informes -->
        <div class="modal fade" id="filtrarInformeModal" tabindex="-1" aria-labelledby="filtrarInformeModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="filtrarInformeModalLabel">Filtrar Informes</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="filtrarInformeForm" method="POST" action="Informes.php">
                            <div class="mb-3">
                                <label for="tipo_filtro" class="form-label">Tipo</label>
                                <select class="form-select" id="tipo_filtro" name="tipo_filtro">
                                    <option value="">Todos</option>
                                    <option value="Anual">Anual</option>
                                    <option value="Mensual">Mensual</option>
                                    <option value="Semanal">Semanal</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-dark w-100">Filtrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            var editarInformeModal = document.getElementById('editarInformeModal');
            editarInformeModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var id = button.getAttribute('data-id');
                var programa = button.getAttribute('data-programa');
                var tipo = button.getAttribute('data-tipo');
                var fecha = button.getAttribute('data-fecha');
                var contenido = button.getAttribute('data-contenido');

                var modalTitle = editarInformeModal.querySelector('.modal-title');
                var editIdInput = editarInformeModal.querySelector('#edit-id');
                var editProgramaInput = editarInformeModal.querySelector('#edit-programa');
                var editTipoInput = editarInformeModal.querySelector('#edit-tipo');
                var editFechaInput = editarInformeModal.querySelector('#edit-fecha');
                var editContenidoInput = editarInformeModal.querySelector('#edit-contenido');

                modalTitle.textContent = 'Editar Informe';
                editIdInput.value = id;
                editProgramaInput.value = programa;
                editTipoInput.value = tipo;
                editFechaInput.value = fecha;
                editContenidoInput.value = contenido;
            });
        </script>
    </section>
</body>
</html>

<?php
$conn->close(); // Cierra la conexión
?>
