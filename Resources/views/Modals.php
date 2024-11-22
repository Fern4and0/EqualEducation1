<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Inscripción</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        /* Estilos personalizados */
        .btn-beneficiario, .btn-voluntario, .btn-coordinador {
            background-color: #28a745;
            color: white;
            font-size: 1.2em;
            margin-top: 20px;
            border-radius: 5px;
            padding: 12px 30px;
        }
        .btn-beneficiario:hover, .btn-voluntario:hover, .btn-coordinador:hover {
            background-color: #218838;
            cursor: pointer;
        }

        .modal-header, .btn-submit {
            background-color: #343a40;
            color: white;
        }
        
        .modal-title {
            font-size: 1.5em;
        }
        
        .modal-body {
            padding: 20px;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        .form-group label {
            font-weight: bold;
        }

        .modal-content {
            border-radius: 10px;
        }

        .form-control, select, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        
        textarea {
            height: 100px;
        }

        .header {
            background-image: url('https://via.placeholder.com/1200x600'); 
            background-size: cover;
            background-position: center;
            height: 50vh;
        }

        .header-content {
            text-align: center;
            color: white;
            padding: 50px;
        }

        .header h1 {
            font-size: 2.5em;
            margin-bottom: 20px;
        }

        .header-content button {
            margin: 10px;
        }
        
        .modal-footer {
            background-color: #f8f9fa;
            text-align: center;
        }

        .modal-body h6 {
            font-size: 1.2em;
            color: #343a40;
        }
    </style>
</head>
<body>

    <!-- Header Section -->
    <header class="header text-center d-flex justify-content-center align-items-center" style="background-image: url('../../Public/image/img6.jpg'); background-size: cover; background-position: center; height: 50vh; ">>
        <div class="header-content">
            <h1>¡Únete a nuestro programa y transforma tu vida!</h1>
            <button type="button" class="btn btn-beneficiario" data-bs-toggle="modal" data-bs-target="#formularioBeneficiarioModal">Quiero ser Beneficiario</button>
            <button type="button" class="btn btn-voluntario" data-bs-toggle="modal" data-bs-target="#formularioVoluntarioModal">Quiero ser Voluntario</button>
            <button type="button" class="btn btn-coordinador" data-bs-toggle="modal" data-bs-target="#formularioCoordinadorModal">Quiero ser Coordinador</button>
        </div>
    </header>

 <!-- Modal Beneficiario -->
<div class="modal fade" id="formularioBeneficiarioModal" tabindex="-1" aria-labelledby="formularioBeneficiarioLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formularioBeneficiarioLabel">Formulario de Beneficiarios</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formularioBeneficiario" method="post" action="../../Controllers/registro_beneficiarios.php" novalidate>
                    <div class="form-group">
                        <label for="ocupacion">Ocupación:</label>
                        <select id="ocupacion" name="ocupacion" class="form-control" required>
                            <option value="">Seleccione una opción</option>
                            <option value="Estudiante">Estudiante</option>
                            <option value="Desempleado">Desempleado</option>
                            <option value="Trabajador">Trabajador</option>
                        </select>
                        <small class="text-danger d-none" id="ocupacionError">Este campo es obligatorio.</small>
                    </div>

                    <div class="form-group">
                        <label for="razon">Razón:</label>
                        <textarea id="razon" name="razon" class="form-control" required></textarea>
                        <small class="text-danger d-none" id="razonError">Este campo es obligatorio.</small>
                    </div>

                    <div class="form-group">
                        <label for="localidad">Localidad:</label>
                        <input id="localidad" type="text" name="localidad" class="form-control" required>
                        <small class="text-danger d-none" id="localidadError">Este campo es obligatorio.</small>
                    </div>
                    
                    <div class="form-group">
                        <label for="preferencias_educativas">Preferencias Educativas:</label>
                        <select id="preferencias_educativas" name="preferencias_educativas" class="form-control" required>
                            <option value="">Seleccione una opción</option>
                            <option value="Ciencias">Ciencias</option>
                            <option value="Matemáticas">Matemáticas</option>
                            <option value="Lengua">Lengua</option>
                            <option value="Historia">Historia</option>
                            <option value="Arte">Arte</option>
                            <option value="Tecnología">Tecnología</option>
                        </select>
                        <small class="text-danger d-none" id="preferenciasError">Este campo es obligatorio.</small>
                    </div>

                    <button type="submit" class="btn btn-submit">Enviar</button>
                </form>
            </div>
        </div>
    </div>
</div>

    <!-- Modal Voluntario -->
<div class="modal fade" id="formularioVoluntarioModal" tabindex="-1" aria-labelledby="formularioVoluntarioLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formularioVoluntarioLabel">Formulario de Voluntarios</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario Voluntario -->
                <form method="POST" action="../../Controllers/registro_voluntario.php">
                    <div class="form-group">
                        <label for="ocupacion">Ocupación:</label>
                        <input type="text" class="form-control" name="ocupacion" required>
                    </div>

                    <div class="form-group">
                        <label for="motivacion">Motivación:</label>
                        <textarea class="form-control" name="motivacion" rows="3" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="localidad">Localidad:</label>
                        <input type="text" class="form-control" name="localidad" required>
                    </div>

                    <div class="form-group">
                        <label for="habilidades_tecnicas">Habilidades Técnicas:</label>
                        <textarea class="form-control" name="habilidades_tecnicas" rows="3" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="disponibilidad">Disponibilidad:</label>
                        <input type="text" class="form-control" name="disponibilidad" required>
                    </div>

                    <button type="submit" class="btn btn-submit mt-3">Enviar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Coordinadores -->
<div class="modal fade" id="formularioCoordinadorModal" tabindex="-1" aria-labelledby="formularioCoordinadorLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formularioCoordinadorLabel">Formulario de Coordinadores</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="../../Controllers/registro_coordinadores.php">
                    <div class="form-group">
                        <label for="experiencia">Experiencia:</label>
                        <textarea name="experiencia" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="habilidades">Habilidades:</label>
                        <textarea name="habilidades" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="motivacion">Motivación:</label>
                        <textarea name="motivacion" class="form-control" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
            </div>
        </div>
    </div>
</div>

    <script src="../../Resources/JS/Dashboard.js" defer></script>
    <script>
document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("formularioBeneficiario");
    const modal = document.getElementById("formularioBeneficiarioModal");

    // Campos
    const ocupacion = document.getElementById("ocupacion");
    const razon = document.getElementById("razon");
    const localidad = document.getElementById("localidad");
    const preferencias = document.getElementById("preferencias_educativas");

    // Mensajes de error
    const ocupacionError = document.getElementById("ocupacionError");
    const razonError = document.getElementById("razonError");
    const localidadError = document.getElementById("localidadError");
    const preferenciasError = document.getElementById("preferenciasError");

    // Validación al enviar el formulario
    form.addEventListener("submit", function (event) {
        let valid = true;

        if (ocupacion.value === "") {
            valid = false;
            ocupacionError.classList.remove("d-none");
        } else {
            ocupacionError.classList.add("d-none");
        }

        if (razon.value.trim() === "") {
            valid = false;
            razonError.classList.remove("d-none");
        } else {
            razonError.classList.add("d-none");
        }

        if (localidad.value.trim() === "") {
            valid = false;
            localidadError.classList.remove("d-none");
        } else {
            localidadError.classList.add("d-none");
        }

        if (preferencias.value === "") {
            valid = false;
            preferenciasError.classList.remove("d-none");
        } else {
            preferenciasError.classList.add("d-none");
        }

        if (!valid) {
            event.preventDefault(); // Evita el envío si hay errores
        }
    });

    // Limpiar el formulario al cerrar el modal
    modal.addEventListener("hidden.bs.modal", function () {
        form.reset(); // Limpia todos los campos del formulario
        ocupacionError.classList.add("d-none");
        razonError.classList.add("d-none");
        localidadError.classList.add("d-none");
        preferenciasError.classList.add("d-none");
    });
});
</script>
</script>
</body>
</html>

