<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="Cordi-Dashboard.php">Coordinador Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                <a class="nav-link" href="../../Resources/Views/index.php">Inicio</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownRoles" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Gestión de Usuarios
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownRoles">
                        <li><a class="dropdown-item" href="Tabla/Beneficiarios.php">Beneficiarios</a></li>
                        <li><a class="dropdown-item" href="Tabla/Voluntarios.php">Voluntarios</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Programas.php">Programas</a>
                <li class="nav-item">
                    <a class="nav-link" href="Informes.php">Informes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Donadores.php">Donaciones</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="../Login/Logout.php">Cerrar Sesión</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
