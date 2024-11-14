<?php

session_start();

include '../../DB/DB.php';

$sql = "SELECT id, programa_id, nombre, descripcion, fecha FROM actividades WHERE programa_id = 7 ORDER BY id"; //cambiar el programa id
$consulta = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventana de Actividades</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Reddit+Sans+Condensed:wght@200..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../Resources/css/styles_modal.css">
</head>
<body>
    <div class="contenido">
        <button class="contenido__crear" id="openCrear">Crear<i class="bi bi-plus-lg" style="font-size: 2.9rem; margin-left: 1.5rem;"></i></button>
        <dialog id="modalCrear" class="modalCrear">
            <div class="modal-content">
                <h2>Crear actividad</h2>
                <form action="../../Controllers/Coordinador/crearAct.php" method="POST">
                    <div class="form-floating mb-3">
                        <input type="hidden" name="programa_id" value="7"> <!-- Cambiar el value por el id del programa -->
                        <input class="form-control" id="floatingInput" name="nombre" placeholder="name@example.com">
                        <label for="floatingInput">Titulo</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="floatingInput" name="fecha" placeholder="name@example.com">
                        <label for="floatingInput">Fecha</label>
                    </div>
                    <div class="form-floating">
                        <textarea class="form-control" name="descripcion" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                        <label for="floatingTextarea">Descripción</label>
                    </div>
                    <!-- Botones para crear o cancelar -->
                    <div class="modal-footer">
                        <button type="submit">Crear</button>
                        <button type="button" id="closeCrear">Cancelar</button>
                    </div>
                </form>
            </div>
        </dialog>
        <?php
        if ($consulta->num_rows > 0) {
            // Mostrar los productos en divs
            while($row = $consulta->fetch_assoc()) {
                $id = $row['id'];
                echo '
                <div class="actividad">
                    <h3>' . $row["nombre"] . '<span>' . $row["fecha"] . '</span></h3>
                    <p>' . $row["descripcion"] . '</p>
                    <button id="open-editar-'.$id.'" onclick="editarAct('.$id.')">Editar</button>
                    <button id="open-eliminar-'.$id.'" onclick="eliminarAct('.$id.')">Eliminar</button>
                </div>

                <dialog id="modal-editar-'.$id.'" class="modalEditar">
                    <div class="modal-content">
                        <h2>Crear actividad</h2>
                        <form action="../../Controllers/Coordinador/editarAct.php" method="POST">
                            <div class="form-floating mb-3">
                                <input type="hidden" name="id" value="'.$id.'">
                                <input type="hidden" name="programa_id" value="7">
                                <input class="form-control" id="floatingInput" name="nombre" placeholder="name@example.com">
                                <label for="floatingInput">Titulo</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="date" class="form-control" id="floatingInput" name="fecha" placeholder="name@example.com">
                                <label for="floatingInput">Fecha</label>
                            </div>
                            <div class="form-floating">
                                <textarea class="form-control" name="descripcion" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                                <label for="floatingTextarea">Descripción</label>
                            </div>
                            <!-- Botones para crear o cancelar -->
                            <div class="modal-footer">
                                <button type="submit">Editar</button>
                                <button type="button" id="close-editar-">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </dialog>

                <dialog id="modal-eliminar-'.$id.'" class="modalEliminar">
                    <div class="modal-content">
                        <form action="../../Controllers/Coordinador/eliminarAct.php" method="POST">
                        <input type="hidden" name="id" value="'.$id.'">
                        <input type="hidden" name="programa_id" value="7"> <!-- Cambiar el value -->
                        <span>¿Estas seguro que quieres eliminar esta actividad?</span>
                        <div class="eliminar-footer">
                            <button id="eliminar" type="submit">Eliminar</button>
                            <button type="button" id="close-eliminar-'.$id.'">Cancelar</button>
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
    </main>
    <script src="../../Resources/js/actividades.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>