<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil del Beneficiario</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'navbar.php';?>
    <div class="container mt-5">
        <h1>Editar Perfil del Beneficiario</h1>
        <form action="editar_perfil.php" method="POST">
            <div class="form-group">
                <label for="razon">Razón:</label>
                <input type="text" class="form-control" id="razon" name="razon" value="Razón Ejemplo">
            </div>
            <div class="form-group">
                <label for="localidad">Localidad:</label>
                <input type="text" class="form-control" id="localidad" name="localidad" value="Localidad Ejemplo">
            </div>
            <div class="form-group">
                <label for="ocupacion">Ocupación:</label>
                <select class="form-control" id="ocupacion" name="ocupacion">
                    <option value="Estudiante" selected>Estudiante</option>
                    <option value="Desempleado">Desempleado</option>
                    <option value="Trabajador">Trabajador</option>
                </select>
            </div>
            <div class="form-group">
                <label for="preferencias_educativas">Preferencias Educativas:</label>
                <select class="form-control" id="preferencias_educativas" name="preferencias_educativas">
                    <option value="Ciencias">Ciencias</option>
                    <option value="Matemáticas">Matemáticas</option>
                    <option value="Lengua">Lengua</option>
                    <option value="Historia">Historia</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>