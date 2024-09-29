<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Únete como Voluntario o Beneficiario</title>
    <link rel="stylesheet" href="resources/css/style_modal.css">>
    <!-- Link a Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <!-- Incluir el header -->
    <?php include('layout/header.php');?>
    <!-- Sección Hero -->
    <section class="hero d-flex justify-content-center align-items-center">
        <div class="text-center">
            <h1 class="display-4">Únete y Haz la Diferencia</h1>
            <p class="lead">Conviértete en voluntario o beneficiario y ayuda a reducir la desigualdad educativa.</p>
            <button class="btn btn-lg cta-button btn-danger" data-bs-toggle="modal" data-bs-target="#formModal">Únete
                Ahora</button>
        </div>
    </section>

    <!-- Sección de Información -->
    <section class="container mt-5">
        <h2 class="section-title text-center">¿Por qué Unirse?</h2>
        <p class="text-center mb-5">Ser voluntario o beneficiario en nuestra organización te permite marcar la
            diferencia en la vida de muchas personas. Ayuda a crear oportunidades y cerrar la brecha educativa.</p>

        <div class="row text-center">
            <div class="col-md-4">
                <i class="bi bi-people" style="font-size: 3rem; color: #ff6b6b;"></i>
                <h4 class="mt-3">Red de Apoyo</h4>
                <p>Únete a una red de voluntarios y beneficiarios comprometidos con el mismo objetivo.</p>
            </div>
            <div class="col-md-4">
                <i class="bi bi-lightbulb" style="font-size: 3rem; color: #ff6b6b;"></i>
                <h4 class="mt-3">Innovación Educativa</h4>
                <p>Participa en programas educativos innovadores que generan un impacto real en la sociedad.</p>
            </div>
            <div class="col-md-4">
                <i class="bi bi-heart" style="font-size: 3rem; color: #ff6b6b;"></i>
                <h4 class="mt-3">Apoyo Integral</h4>
                <p>Recibe el apoyo que necesitas para crecer y superar cualquier barrera educativa.</p>
            </div>
        </div>
    </section>

    <!-- Sección de Testimonios -->
    <section class="container mt-5">
        <h2 class="section-title text-center">Testimonios</h2>

        <div class="row">
            <div class="col-md-4">
                <div class="testimonial-card text-center">
                    <img src="https://via.placeholder.com/100" alt="Testimonio 1" class="img-fluid">
                    <h5 class="mt-3">Ana Gómez</h5>
                    <p>"Gracias a este programa, pude continuar mis estudios y alcanzar mis metas. ¡Estoy muy
                        agradecida!"</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="testimonial-card text-center">
                    <img src="https://via.placeholder.com/100" alt="Testimonio 2" class="img-fluid">
                    <h5 class="mt-3">Carlos Pérez</h5>
                    <p>"Ser voluntario me ha permitido aprender, ayudar y conocer personas maravillosas. ¡Una
                        experiencia inolvidable!"</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="testimonial-card text-center">
                    <img src="https://via.placeholder.com/100" alt="Testimonio 3" class="img-fluid">
                    <h5 class="mt-3">Lucía Hernández</h5>
                    <p>"He encontrado una comunidad de apoyo que me ha permitido crecer personal y profesionalmente."
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal con Formulario -->
    <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">¡Sé Parte de Nuestra Causa!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Botones para cambiar de formulario -->
                    <div class="d-flex justify-content-center mb-4">
                        <button class="btn btn-primary me-2" onclick="mostrarFormulario('beneficiarios')">Formulario
                            Beneficiarios</button>
                        <button class="btn btn-secondary" onclick="mostrarFormulario('voluntarios')">Formulario
                            Voluntarios</button>
                    </div>

                    <!-- Formulario de Beneficiarios -->
                    <div id="form-beneficiarios" class="p-4 rounded bg-light">
                        <h3 class="text-center mb-4">Formulario de Beneficiarios</h3>
                        <form action="ruta_beneficiarios" method="POST">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre Completo</label>
                                <input type="text" class="form-control" id="nombre" name="nombre"
                                    placeholder="Ingresa tu nombre completo" required>
                            </div>

                            <!-- fecha_nacimiento -->
                            <div class="mb-3">
                                <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento"
                                    required>
                            </div>

                            <!-- direccion -->
                            <div class="mb-3">
                                <label for="direccion" class="form-label">Dirección</label>
                                <input type="text" class="form-control" id="direccion" name="direccion"
                                    placeholder="Ingresa tu dirección" required>
                            </div>

                            <!-- nivel_edu -->
                            <div class="mb-3">
                                <label for="nivel_edu" class="form-label">Nivel Educativo</label>
                                <input type="text" class="form-control" id="nivel_edu" name="nivel_edu"
                                    placeholder="Ingresa tu nivel educativo" required>
                            </div>

                            <!-- situacion_eco -->
                            <div class="mb-3">
                                <label for="situacion_eco" class="form-label">Situación Económica</label>
                                <textarea class="form-control" id="situacion_eco" name="situacion_eco" rows="3"
                                    placeholder="Describe tu situación económica" required></textarea>
                            </div>

                            <!-- programa_asig -->
                            <div class="mb-3">
                                <label for="programa_asig" class="form-label">Programa Asignado</label>
                                <input type="number" class="form-control" id="programa_asig" name="programa_asig"
                                    placeholder="Ingresa el ID del Programa Asignado" required>
                            </div>

                            <!-- fecha_de_ingr -->
                            <div class="mb-3">
                                <label for="fecha_de_ingr" class="form-label">Fecha de Ingreso</label>
                                <input type="datetime-local" class="form-control" id="fecha_de_ingr"
                                    name="fecha_de_ingr" required>
                            </div>

                            <!-- Botón de enviar -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Enviar</button>
                            </div>
                        </form>
                    </div>

                    <!-- Formulario de Voluntarios -->
                    <div id="form-voluntarios" class="p-4 rounded bg-light d-none">
                        <h3 class="text-center mb-4">Formulario de Voluntarios</h3>
                        <form action="ruta_voluntarios" method="POST">
                            <!-- Campos para el formulario de voluntarios -->
                            <div class="mb-3">
                                <label for="nombre_voluntario" class="form-label">Nombre Completo</label>
                                <input type="text" class="form-control" id="nombre_voluntario" name="nombre_voluntario"
                                    placeholder="Ingresa tu nombre completo" required>
                            </div>
                            <!-- Otros campos del formulario... -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-secondary">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include('layout/footer.php');?>

    <!-- Scripts de Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Función para alternar entre formularios
        function mostrarFormulario(tipo) {
            if (tipo === 'beneficiarios') {
                document.getElementById('form-beneficiarios').classList.remove('d-none');
                document.getElementById('form-voluntarios').classList.add('d-none');
            } else {
                document.getElementById('form-beneficiarios').classList.add('d-none');
                document.getElementById('form-voluntarios').classList.remove('d-none');
            }
        }
    </script>

</body>

</html>