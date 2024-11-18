<?php

session_start();

include '../../DB/DB.php';

$sql = "SELECT id, nombre, descripcion, fecha_inicio, fecha_final FROM programas WHERE user_id = 2 ORDER BY id"; //cambiar el 2 por el id del coordinador
$consulta = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../Resources/css/styles_coordinadores.css">
    <link rel="stylesheet" href="../../Resources/css/styles_modal.css">
</head>
<body>
    <div class="panel">
        <h2>Panel de coordinadores</h2>
        <h3>Gestión de programas</h3>
        <div class="programas">
            <span>Total de programas: 2</span>
        </div>
    </div>
    <div class="titulo">
        <h2>Programas creados</h2>
    </div>
    <div class="contenedor-programas">
    <?php
        if ($consulta->num_rows > 0) {
            // Mostrar los productos en divs
            while($row = $consulta->fetch_assoc()) {
                $id = $row['id'];
                echo '
                <div class="programa">
                    <img src="../../Public/image/img2.jpeg" alt="Imagen del programa">
                <div class="programa-contenido">
                <h3>' . $row["nombre"] . '</h3>
                <p>' . $row["descripcion"] . '</p>
                <select name="status" id="status" required>
                    <option value="inac">Inactivo</option>
                    <option value="Enprog">En progreso</option>
                    <option value="Fin">Finalizado</option>
                </select>
                <div class="acciones">  
                    <button class="btn-ver">Ver cronograma</button>
                    <button id="open-editar-'.$id.'" class="btn-editar" onClick="editarPrgm('.$id.')">Editar</button>
                    <button id="open-eliminar-'.$id.'" class="btn-eliminar" onClick="eliminarPrgm('.$id.')">Eliminar</button>
                </div>
            </div>
        </div>


        <dialog id="modal-eliminar-'.$id.'" class="modalEliminar">
            <div class="eliminarContent">
                <form action="../../Controllers/Coordinador/eliminarPrograma.php" method="POST">
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
                <form action="../../Controllers/Coordinador/editarPrograma.php" method="POST">
                    <div class="form-floating mb-3">
                        <input type="hidden" name="id" value="'.$id.'">
                        <input type="hidden" name="user_id" value="2"> <!-- Cambiar el user_id -->
                        <input class="form-control" id="floatingInput" name="nombre" placeholder="name@example.com">
                        <label for="floatingInput">Titulo</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="floatingInput" name="fecha_ini" placeholder="name@example.com">
                        <label for="floatingInput">Fecha de inicio</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="floatingInput" name="fecha_fin" placeholder="name@example.com">
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
            <form action="../../Controllers/Coordinador/crearPrograma.php" method="POST">
                <div class="form-floating mb-3">
                    <input type="hidden" name="user_id" value="2"> <!-- Cambiar el user_id -->
                    <input class="form-control" id="floatingInput" name="nombre" placeholder="name@example.com">
                    <label for="floatingInput">Titulo</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="date" class="form-control" id="floatingInput" name="fecha_ini" placeholder="name@example.com">
                    <label for="floatingInput">Fecha de inicio</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="date" class="form-control" id="floatingInput" name="fecha_fin" placeholder="name@example.com">
                    <label for="floatingInput">Fecha de conclusion</label>
                </div>
                <div class="form-floating">
                    <textarea class="form-control" name="descripcion" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="../../Resources/js/programas.js"></script>
</body>
</html>