<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Beneficiarios</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        /* Estilos personalizados */
        .btn-beneficiario {
            background-color: #28a745;
            color: white;
            font-size: 1.2em;
            margin-top: 20px;
        }
        .modal-header, .btn-submit {
            background-color: #343a40; /* Color oscuro del header */
            color: white;
        }
        .form-group label {
            font-weight: bold;
        }
        .modal-body {
            padding: 20px;
        }
        .mensaje-inspirador {
            text-align: center;
            margin-bottom: 20px;
            font-size: 1.5em;
            color: #28a745;
        }
        /* Imagen inspiradora */
        .mensaje-imagen {
            text-align: center;
            margin-bottom: 30px;
        }
        .mensaje-imagen img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <?php include('layout/header.php');?>

    
    <header class="header text-center d-flex justify-content-center align-items-center" style="background-image: url('../../Public/image/img6.jpg'); background-size: cover; background-position: center; height: 50vh; ">
    <div class="header-content text-white">  
    <h1>¡Únete como beneficiario y transforma tu vida!</h1>
    <button type="button" class="btn btn-beneficiario" data-bs-toggle="modal" data-bs-target="#formularioBeneficiarioModal">
            Quiero ser beneficiario
        </button>
    </div>
    </div>

    </header>           
        

    <!-- Modal -->
    <div class="modal fade" id="formularioBeneficiarioModal" tabindex="-1" aria-labelledby="formularioBeneficiarioLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formularioBeneficiarioLabel">Formulario de Beneficiarios</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../../Controllers/Dashboard/Solicitudes.php" method="POST">
                        <!-- Nombre Completo -->
                        <div class="form-group mb-3">
                            <label for="nombre">Nombre Completo:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresa tu nombre completo" required>
                        </div>

                        <!-- Fecha de Nacimiento -->
                        <div class="form-group mb-3">
                            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
                        </div>

                        <!-- Dirección -->
                        <div class="form-group mb-3">
                            <label for="direccion">Dirección:</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Ingresa tu dirección" required>
                        </div>

                        <!-- Nivel Educativo -->
                        <div class="form-group mb-3">
                            <label for="nivel_edu">Nivel Educativo:</label>
                            <input type="text" class="form-control" id="nivel_edu" name="nivel_edu" placeholder="Ingresa tu nivel educativo" required>
                        </div>

                        <!-- Situación Económica -->
                        <div class="form-group mb-3">
                            <label for="situacion_eco">Situación Económica:</label>
                            <textarea class="form-control" id="situacion_eco" name="situacion_eco" placeholder="Describe tu situación económica" required></textarea>
                        </div>

                        <!-- Fecha de Ingreso -->
                        <div class="form-group">
                    <label for="fecha_de_ingr">Fecha de Ingreso:</label>
                    <input type="datetime-local" id="fecha_de_ingr" name="fecha_de_ingr" placeholder="dd/mm/aaaa --:--" required>
                    </div>
                        <!-- Botón de envío -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-submit w-100">Enviar Solicitud</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="../../Resources/JS/Dashboard.js" defer></script>
</body>
</html>
