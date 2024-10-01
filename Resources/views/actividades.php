<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventana de Actividades</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Reddit+Sans+Condensed:wght@200..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/Resources/css/styles_modal.css">
    <link rel="stylesheet" href="/Resources/css/styles.css">
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
            <button class="contenido__crear" id="openModalBtn">Crear<i class="bi bi-plus-lg" style="font-size: 2.9rem; margin-left: 1.5rem;"></i></button>
            <dialog id="modal" class="modal">
                <div class="modal-content">
                    <h2>Crear actividad</h2>
                    <form>
                        <label for="titulo">Título de la actividad</label>
                        <input type="text" id="titulo" name="titulo">
        
                        <label for="fecha-inicio">Fecha de inicio</label>
                        <input type="date" id="fecha-inicio" name="fecha-inicio">
        
                        <label for="fecha-conclusion">Fecha de conclusión</label>
                        <input type="date" id="fecha-conclusion" name="fecha-conclusion">
        
                        <label for="descripcion">Descripción de la actividad</label>
                        <textarea style="resize: vertical;" id="descripcion" name="descripcion" rows="4"></textarea>
        
                        <!-- Botones para crear o cancelar -->
                        <div class="modal-footer">
                            <button type="submit">Crear</button>
                            <button type="button" id="closeModalBtn">Cancelar</button>
                        </div>
                    </form>
                </div>
            </dialog>
            <div class="contenido__actividad">
                <i class="bi bi-journal-text" style="font-size: 3.5rem;"></i>
                <span>Titulo de la actividad</span>
                <span style="margin-left: 28rem;">Fecha de la actividad</span>
                <button class="contenido__actividad--opciones"><i class="bi bi-three-dots-vertical" style="font-size: 3.5rem;"></i></button>
                <div class="descripcion-act">
                    Nam aliquet, urna nec scelerisque hendrerit, felis libero maximus enim, non lobortis magna sem quis odio. Curabitur feugiat
                    quis enim consectetur faucibus. Donec ut molestie nulla. Vivamus porta quam fringilla, laoreet metus non, semper neque.
                    Aenean ornare rhoncus tellus id porttitor. Sed finibus sem volutpat condimentum ornare.
                </div>
            </div>
            <div class="contenido__actividad">
                <i class="bi bi-journal-text" style="font-size: 3.5rem;"></i>
                <span>Titulo de la actividad</span>
                <span style="margin-left: 28rem;">Fecha de la actividad</span>
                <button class="contenido__actividad--opciones"><i class="bi bi-three-dots-vertical" style="font-size: 3.5rem;"></i></button>
                <div class="descripcion-act">
                    Nam aliquet, urna nec scelerisque hendrerit, felis libero maximus enim, non lobortis magna sem quis odio. Curabitur feugiat
                    quis enim consectetur faucibus. Donec ut molestie nulla. Vivamus porta quam fringilla, laoreet metus non, semper neque.
                    Aenean ornare rhoncus tellus id porttitor. Sed finibus sem volutpat condimentum ornare.
                </div>
            </div>
        </div>
    </main>
    <script src="/Resources/js/actividades.js"></script>
</body>
</html>