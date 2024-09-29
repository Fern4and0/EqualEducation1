<!-- inicio.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real People, Real Solutions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="resources/css/style_ini.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body> 

    <!-- Incluir el header -->
    <?php include('resources/views/layout/header.php'); ?>

    <!-- Header Section -->
    <header class="header text-center d-flex justify-content-center align-items-center">
    <div class="header-content text-white">
        <h1>Un Futuro Mejor a Través de la Educación</h1>
    </div>
</header>

<!-- Main Content -->
<main class="container my-5">
    <h2 class="text-center mb-4">¡Casi lo logramos! Financia los últimos pocos dólares que necesitan</h2>

    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm hover-effect">
                <img src="img1.jpg" class="card-img-top" alt="Persona 1">
                <div class="card-body">
                    <p class="card-text">Descripción de la primera persona que necesita financiamiento.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm hover-effect">
                <img src="img2.jpg" class="card-img-top" alt="Persona 2">
                <div class="card-body">
                    <p class="card-text">Descripción de la segunda persona que necesita financiamiento.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm hover-effect">
                <img src="img3.jpg" class="card-img-top" alt="Persona 3">
                <div class="card-body">
                    <p class="card-text">Descripción de la tercera persona que necesita financiamiento.</p>
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
