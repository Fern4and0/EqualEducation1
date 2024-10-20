<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Iniciamos la sesión
}
?>

<!-- header-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold text-uppercase" href="EqualEducation/Inicio.php">Equal Edu</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/EqualEducation/inicio.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Resources/views/programas.php">Programas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Sobre nosotros</a>
                </li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i> <!-- Ícono de usuario -->
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person"></i> Perfil</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-gear"></i> Configuración</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="/EqualEducation/Controllers/Login/Logout.php"><i class="bi bi-box-arrow-right"></i> Cerrar Sesión</a></li>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if (!isset($_SESSION['user_id'])): ?>
                    <!-- Mostrar "Inicia Sesión" si no hay sesión activa -->
                    <li class="nav-item">
                        <a class="nav-link" href="/EqualEducation/Resources/views/login.html">Inicia Sesión</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Resources/views/Modals.php">Únete</a>
                    </li>
                <?php endif; ?>

                <li class="nav-item">
                    <a class="btn btn-primary" href="Resources/views/donaciones.php">Donar</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
