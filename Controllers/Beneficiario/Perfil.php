<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beneficiarios Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            margin-bottom: 20px;
        }
        .card {
            margin-bottom: 20px;
        }
        .profile-card {
            max-width: 700px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .profile-header img {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            margin-right: 15px;
        }
        .profile-header h2 {
            margin: 0;
        }
        .profile-info {
            margin-bottom: 10px;
        }
        .profile-info i {
            margin-right: 10px;
        }
        .profile-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .nav-tabs .nav-link {
            color: #495057;
        }
        .nav-tabs .nav-link.active {
            background-color: #fff;
            border-color: #dee2e6 #dee2e6 #fff;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Beneficiarios Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="Beneficiario-Dashboard.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Programas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Actividades</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Perfil.php">Perfil</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Cerrar Sesión</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="profile-card">
            <div class="profile-header">
                <img src="https://via.placeholder.com/70" alt="Foto de perfil">
                <div>
                    <h2>María González</h2>
                    <p class="text-muted">Beneficiario desde 15/03/2022</p>
                </div>
                <button class="btn btn-outline-secondary ml-auto">Editar Perfil</button>
            </div>
            
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Información General</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Ayuda Recibida</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Notas e Historial</a>
                </li>
            </ul>
            
            <div class="profile-info mt-3">
                <p><i class="fas fa-user"></i> Edad: 35 años</p>
                <p><i class="fas fa-map-marker-alt"></i> Calle Principal 123, Ciudad</p>
                <p><i class="fas fa-phone"></i> +1234567890</p>
                <p><i class="fas fa-calendar"></i> Ingreso: 15/03/2022</p>
            </div>
            
            <div class="profile-actions">
                <button class="btn btn-dark">Registrar Nueva Ayuda</button>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
