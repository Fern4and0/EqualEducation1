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
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

</head>
<body> 

  <!-- Incluir el header -->
<?php include('resources/views/layout/header.php'); ?>

<!-- Header Section -->
<header class="header text-center d-flex justify-content-center align-items-center" style="background-image: url('Public/image/img2.jpeg'); background-size: auto; background-position: center; height: 50vh; ">
    <div class="header-content text-white">  
        <h1>Un Futuro Mejor a Través de la Educación</h1>
    </div>
</header>


<!-- Main Content -->
<main class="container my-5">
    <h2 class="text-center mb-4">¡Programas y ayudas!</h2>

    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm hover-effect">
                <img src="Public/image/img7.jpg" height="250" width="300" class="card-img-top"alt="Programa 1">
                <div class="card-body">
                    <p class="card-text">Descripcion del programa.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm hover-effect">
                <img src="Public/image/img8.jpg"  height="250" width="300" class="card-img-top" alt="Programa 2">
                <div class="card-body">
                    <p class="card-text">Descripción del programa.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm hover-effect">
                <img src="Public/image/img9.jpg"  height="250" width="300" class="card-img-top" alt="Programa 3">
                <div class="card-body">
                    <p class="card-text">Descripción del programa.</p>
                </div>
            </div>
        </div>
    </div>
</main>

    <!-- Footer -->
    <?php include('resources/views/layout/footer.php');?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
