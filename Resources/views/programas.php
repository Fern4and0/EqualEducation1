<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Reddit+Sans+Condensed:wght@200..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/Resources/css/styles_modal_prgm.css">
    <link rel="stylesheet" href="/Resources/css/styles_programas.css">
</head>
<body>
<?php include('layout/header.php') ?>
    <nav class="navegacion-secundaria">
        <a class="navegacion-secundaria__opcion" href="#">Programas</a>
        <a class="navegacion-secundaria__opcion" href="#">Cronogramas</a>
    </nav>

    <main class="contenedor">
        <div class="programa">
            <div class="programa-img">
                <img src="imgs/images.png" alt="imagen del programa">
            </div>
            <div class="programa-texto">
                <strong>Titulo del programa <br></strong> Curabitur laoreet accumsan eros. Sed a vulputate massa. Aliquam vitae est vitae lorem accumsan faucibus. Duis libero velit,
                condimentum id dui non, dictum gravida nisi. Proin et odio nibh. Pellentesque habitant morbi tristique senectus et netus et
                malesuada fames ac turpis egestas. Maecenas ut ante tempor, auctor leo eu, lobortis odio. Phasellus eget sapien at lacus
                elementum dictum.
            </div>
            <div style="font-size: 2rem;"><strong>fecha de inicio</strong></div>
        </div>
        <button class="btnCrearPrgm" id="openModalBtn">Crear programa<br><i class="bi bi-plus-lg" style="font-size: 3rem;"></i></button>

        <!-- Modal -->
        <dialog id="modal" class="modal">
            <form class="modal-content" method="POST">
                <h2>Crear programa</h2>
                <label for="nombre">Nombre del programa</label>
                <input type="text" id="nombre" placeholder="Nombre del programa">

                <label for="fecha_ini">Fecha de inicio</label>
                <input type="date" id="fecha_ini">

                <label for="fecha_fin">Fecha de conclusión</label>
                <input type="date" id="fecha_fin">

                <!--
                <label for="archivoImagen">Archivo de imagen</label>
                <input type="file" id="archivoImagen" accept="image/*">
                -->

                <!-- Botones de acción -->
                <div class="modal-actions">
                    <button type="submit" id="createBtn">Crear</button>
                    <button id="cancelBtn">Cancelar</button>
                </div>
            </form>
        </dialog>
    </main>
    <script src="/Resources/js/programas.js"></script>
</body>
</html>