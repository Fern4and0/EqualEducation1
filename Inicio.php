<!-- inicio.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real People, Real Solutions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="Resources/css/style_ini.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body> 

  <!-- Incluir el header -->
<?php include('resources/views/layout/header.php'); ?>

<!-- Header Section -->
<header class="header text-center d-flex justify-content-center align-items-center" style="height: 65vh;">
    <video autoplay loop muted playsinline style="position: absolute; width: 100%; height: 100%; object-fit: cover;">
        <source src="./Public/image/Estudiantes.mp4" type="video/mp4">
        Tu navegador no soporta el video.
    </video>
    <div class="header-content text-white" style="position: relative; z-index: 1;">  
        <h1>Un Futuro Mejor a Través de la Educación</h1>
    </div>
</header>

<!-- Main Content -->
<main class="container my-5">
    <h2 class="text-center mb-4">¡Programas y ayudas!</h2>
    <!-- Efecto de carrusel-->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-interval="8000">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button> <!-- Nuevo indicador para el nuevo slide -->
        </div>
        <div class="carousel-inner">

            <!-- Primera seccion -->
            <div class="carousel-item active">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm hover-effect">
                            <img src="Public/image/img7.jpg" height="250" width="300" class="card-img-top" alt="Programa 1">
                            <div class="card-body">
                                <p class="card-text">Descripción del programa.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm hover-effect">
                            <img src="Public/image/img8.jpg" height="250" width="300" class="card-img-top" alt="Programa 2">
                            <div class="card-body">
                                <p class="card-text">Descripción del programa.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm hover-effect">
                            <img src="Public/image/img9.jpg" height="250" width="300" class="card-img-top" alt="Programa 3">
                            <div class="card-body">
                                <p class="card-text">Descripción del programa.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Segunda seccion -->
            <div class="carousel-item">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm hover-effect">
                            <img src="Public/image/img6.jpg" height="250" width="300" class="card-img-top" alt="Programa 4">
                            <div class="card-body">
                                <p class="card-text">Descripción del nuevo programa.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm hover-effect">
                            <img src="Public/image/img6.jpg" height="250" width="300" class="card-img-top" alt="Programa 6">
                            <div class="card-body">
                                <p class="card-text">Descripción del programa.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm hover-effect">
                            <img src="Public/image/img6.jpg" height="250" width="300" class="card-img-top" alt="Programa 6">
                            <div class="card-body">
                                <p class="card-text">Descripción del programa.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <!-- Controles del carrusel -->
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</main>

    <!-- Footer -->
    <?php include('resources/views/layout/footer.php');?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>