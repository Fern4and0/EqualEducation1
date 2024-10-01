<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventana de Actividades</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Reddit+Sans+Condensed:wght@200..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/Resources/css/styles_objetivo.css">
</head>
<body>
<?php include('layout/header.php') ?>
    <nav class="navegacion-secundaria">
        <a class="navegacion-secundaria__opcion" href="#">Programas</a>
        <a class="navegacion-secundaria__opcion" href="#">Cronogramas</a>
    </nav>

    <main class="contenedor">
        <div class="barra-lateral">
            <a class="barra-lateral__opcion" href="objetivo.php">Objetivo</a>
            <a class="barra-lateral__opcion" href="actividades.php">Actividades</a>
            <a class="barra-lateral__opcion" href="personas.php">Personas</a>
        </div>
        <div class="contenido">
            <div class="contenido-img"></div>
            <div class="contenido-objetivo">
                <textarea class="contenido-txtarea" placeholder="Agrega el objetivo del programa" name="objetivo" id="objetivo"></textarea>
                <div class="contenido-txtarea--publicar">Publicar</div>
            </div>
        </div>
    </main>
</body>
</html>