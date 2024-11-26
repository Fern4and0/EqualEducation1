<?php
// Controllers/Coordinador/Cordi-Dashboard.php

session_start(); // Inicia la sesión

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../Resources/Views/Login.html"); // Redirige al login si no está autenticado
    exit(); // Detiene la ejecución
}

include '../../DB/db.php'; // Incluye la conexión a la base de datos

// Consulta para obtener el total de usuarios registrados
$sqlUsuarios = "SELECT COUNT(*) AS total_usuarios FROM users";
$resultUsuarios = $conn->query($sqlUsuarios); // Ejecuta la consulta
$totalUsuarios = $resultUsuarios->fetch_assoc()['total_usuarios']; // Obtiene el resultado de la consulta

// Consulta para obtener las donaciones totales
$sqlDonaciones = "SELECT COALESCE(SUM(monto), 0) AS total_donaciones FROM donaciones";
$resultDonaciones = $conn->query($sqlDonaciones); // Ejecuta la consulta
$totalDonaciones = $resultDonaciones->fetch_assoc()['total_donaciones']; // Obtiene el resultado de la consulta

// Consulta para obtener la cantidad de beneficiarios registrados
$sqlBeneficiarios = "SELECT COUNT(*) AS total_beneficiarios FROM beneficiarios";
$resultBeneficiarios = $conn->query($sqlBeneficiarios); // Ejecuta la consulta
$totalBeneficiarios = $resultBeneficiarios->fetch_assoc()['total_beneficiarios']; // Obtiene el resultado de la consulta

$sql = "SELECT id, nombre, descripcion, fecha_ini, fecha_fin, foto FROM programas"; //cambiar el 2 por el id del coordinador
$consulta = $conn->query($sql);

$fecha_actual = date('Y-m-d');

// Cerrar la conexión a la base de datos
$conn->close(); // Cierra la conexión a la base de datos
?>

<!DOCTYPE html>
<html lang="en"></html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coordinador Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../Resources/css/styles_coordinadores.css">
    <link rel="stylesheet" href="../../Resources/css/styles_modal.css">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 0 !important;
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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Coordinador Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'Index.php' ? 'active' : ''; ?>" href="../../Resources/views/index.html"><i class="fas fa-home"></i> Inicio</a></a>
                </li>
                <li class="nav-item">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownRoles" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Gestion de Usuarios
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownRoles">
                            <a class="dropdown-item" href="Tabla/Beneficiarios.php">Beneficiarios</a>
                            <a class="dropdown-item" href="Tabla/Voluntarios.php">Voluntarios</a>
                        </div>
                    </li>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Informes.php">Informes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Donadores.php">Donaciones</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="../Login/Logout.php">Cerrar Sesión</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="contenedor-programas">
    <?php
        if ($consulta->num_rows > 0) {
            // Mostrar los productos en divs
            while($row = $consulta->fetch_assoc()) {
                $id = $row['id'];
                echo '
                <div class="programa">
                    <img src="../../Public/image/' . $row["id"] .'.png" alt="Imagen del programa">
                <div class="programa-contenido">
                <h3>' . $row["nombre"] . '</h3>
                <p>' . $row["descripcion"] . '</p>
                <div class="acciones">  
                    <button id="open-eliminar-'.$id.'" class="btn-eliminar" onClick="eliminarPrgm('.$id.')">Eliminar</button>
                    <button id="open-editar-'.$id.'" class="btn-editar" onClick="editarPrgm('.$id.')">Editar</button>
                </div>
            </div>
        </div>


        <dialog id="modal-eliminar-'.$id.'" class="modalEliminar">
            <div class="eliminarContent">
                <form action="eliminarPrograma.php" method="POST">
                <input type="hidden" name="id" value="'.$id.'">
                <input type="hidden" name="user_id" value="2"> <!-- Cambiar el user_id -->
                <span>¿Estas seguro que quieres eliminar este programa?</span>
                <div class="eliminar-footer">
                    <button id="eliminar" type="submit">Eliminar</button>
                    <button type="button" id="close-eliminar-'.$id.'">Cancelar</button>
                </div>
                </form>
            </div>
        </dialog>
        <dialog id="modal-editar-'.$id.'" class="modalEditar"> 
            <div class="editarContent">
                <h2>Editar programa</h2>
                <form action="editarPrograma.php" method="POST" enctype="multipart/form-data">
                    <div class="form-floating mb-3">
                        <input type="hidden" name="id_programa" value="'.$id.'">
                        <input type="hidden" name="user_id" value="2"> <!-- Cambiar el user_id -->
                        <input class="form-control" id="floatingInput" name="nombre" placeholder="name@example.com" required>
                        <label for="floatingInput">Titulo</label>
                    </div>
                    <div class="mb-3">
                    <label for="formFile" class="form-label">Imagen</label>
                    <input class="form-control" type="file" id="formFile" name="foto" accept="image/png" required>
                </div>
                <div class="row g-2 mb-3">
                <div class="col-md-4">
                    <div class="form-floating">
                        <input type="number" class="form-control" id="numericInput" name="cupo_maximo" placeholder="0" min="1" max="200" required>
                        <label for="numericInput">Cupo maximo</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating">
                        <select class="form-select" id="selectInput1" name="tipo" required>
                            <option value="" disabled selected>Seleccione una opción</option>
                            <option value="1">Curso</option>
                            <option value="2">Taller</option>
                            <option value="3">Seminario</option>
                            <option value="4">Conferencia</option>
                        </select>
                        <label for="selectInput1">Tipo de programa</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating mb-3">
                        <input class="form-control" id="floatingInput" name="ubicacion" placeholder="" required>
                        <label for="floatingInput">Ubicación</label>
                    </div>
                </div>
                </div>
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="floatingInput" name="fecha_ini" placeholder="name@example.com" min="'.$fecha_actual.'" required>
                        <label for="floatingInput">Fecha de inicio</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="floatingInput" name="fecha_fin" placeholder="name@example.com" min="'.$fecha_actual.'" requires>
                        <label for="floatingInput">Fecha de conclusion</label>
                    </div>
                    <div class="form-floating">
                        <textarea class="form-control" name="descripcion" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                        <label for="floatingTextarea">Descripción</label>
                    </div>
                    <!-- Botones para crear o cancelar -->
                    <div class="modal-footer">
                        <button id="crear" type="submit">Editar</button>
                        <button type="button" id="close-editar-'.$id.'">Cancelar</button>
                    </div>
                </form>
            </div>
        </dialog>';
            }
        } else {
            // Si no hay resultados
            echo "<p>No hay programas disponibles</p>";
        }
        ?>
    </div>
    <div class="boton-crear">
    <button class="crear-act" id="openModalBtn">
        Crear programa<br>
        <i style="font-weight: bold; font-size: 30px;" class="bi bi-plus-lg"></i>
    </button></div>
    <dialog id="modal" class="modal">
        <div class="modal-content">
            <h2>Crear programa</h2>
            <form action="crearPrograma.php" method="POST" enctype="multipart/form-data">
                <div class="form-floating mb-3">
                    <input type="hidden" name="user_id" value="2"> <!-- Cambiar el user_id -->
                    <input class="form-control" id="floatingInput" name="nombre" placeholder="" required>
                    <label for="floatingInput">Titulo</label>
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Imagen</label>
                    <input class="form-control" type="file" id="formFile" name="foto" accept="image/png" required>
                </div>
                <div class="row g-2 mb-3">
                <div class="col-md-4">
                    <div class="form-floating">
                        <input type="number" class="form-control" id="numericInput" name="cupo_maximo" placeholder="0" min="1" max="200" required>
                        <label for="numericInput">Cupo maximo</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating">
                        <select class="form-select" id="selectInput1" name="tipo" required>
                            <option value="" disabled selected>Seleccione una opción</option>
                            <option value="1">Curso</option>
                            <option value="2">Taller</option>
                            <option value="3">Seminario</option>
                            <option value="4">Conferencia</option>
                        </select>
                        <label for="selectInput1">Tipo de programa</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating mb-3">
                        <input class="form-control" id="floatingInput" name="ubicacion" placeholder="" required>
                        <label for="floatingInput">Ubicación</label>
                    </div>
                </div>
                </div>
                <div class="form-floating mb-3">
                    <input type="date" class="form-control" id="floatingInput" name="fecha_ini" placeholder="" min="<?php echo $fecha_actual; ?>" required>
                    <label for="floatingInput">Fecha de inicio</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="date" class="form-control" id="floatingInput" name="fecha_fin" placeholder="" min="<?php echo $fecha_actual; ?>" required>
                    <label for="floatingInput">Fecha de conclusion</label>
                </div>
                <div class="form-floating">
                    <textarea class="form-control" name="descripcion" placeholder="" id="floatingTextarea" style="height: 100px;"></textarea>
                    <label for="floatingTextarea">Descripción</label>
                </div>
                <!-- Botones para crear o cancelar -->
                <div class="modal-footer">
                    <button id="crear" type="submit">Crear</button>
                    <button type="button" id="closeModalBtn">Cancelar</button>
                </div>
            </form>
        </div>
    </dialog>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="../../Resources/js/programas.js"></script>
</body>
</html>
