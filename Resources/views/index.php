<?php
// Iniciar sesión para verificar si el usuario está logueado
session_start();

// Verificar si el usuario tiene sesión activa
$role_id = $_SESSION['id_rol'] ?? null;

if ($role_id) {
  // Determinar la URL del tablero según el rol del usuario
  switch ($role_id) {
    case 1:
      $dashboard_url = "/EqualEducation/Controllers/Administrador/Administrador-Dashboard.php";
      break;
    case 2:
      $dashboard_url = "/EqualEducation/Controllers/Coordinador/Cordi-Dashboard.php";
      break;
    case 3:
      $dashboard_url = "/EqualEducation/Controllers/Beneficiario/Beneficiario-Dashboard.php";
      break;
    case 4:
      $dashboard_url = "/EqualEducation/Controllers/Voluntario/Voluntario-Dashboard.php";
      break;
    case 5:
      $dashboard_url = "/EqualEducation/Controllers/Donador/Donador-Dashboard.php"; // Redirigir directamente a donaciones
      break;
    default:
      $dashboard_url = "../views/login.html"; // Si no hay rol válido
      break;
  }
} else {
  $dashboard_url = "../views/login.html"; // Redirige al login si no hay sesión
}
?>

<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
<head>
  <title>Equal Education</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" href="images/favicon.png" type="image/x-icon">
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Poppins:300,300i,400,500,600,700,800,900,900i%7CRoboto:400%7CRubik:100,400,700">
  <link rel="stylesheet" href="../css/bootstrap.css">
  <link rel="stylesheet" href="../css/fonts.css">
  <link rel="stylesheet" href="../css/styles_index.css">
  <style>
    .ie-panel {
      display: none;
      background: #212121;
      padding: 10px 0;
      box-shadow: 3px 3px 5px 0 rgba(0, 0, 0, .3);
      clear: both;
      text-align: center;
      position: relative;
      z-index: 1;
    }

    html.ie-10 .ie-panel, html.lt-ie-10 .ie-panel {
      display: block;
    }
  </style>
</head>
<body>
  <div class="preloader">
    <div class="preloader-body">
      <div class="cssload-container">
        <div class="cssload-speeding-wheel"></div>
      </div>
      <p>Loading...</p>
    </div>
  </div>
  <div class="page">
    <!-- Page Header-->
    <header class="section page-header">
      <!-- RD Navbar-->
      <div class="rd-navbar-wrap">
        <nav class="rd-navbar rd-navbar-classic" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed"
          data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static"
          data-lg-device-layout="rd-navbar-static" data-xl-layout="rd-navbar-static" data-xl-device-layout="rd-navbar-static"
          data-xxl-layout="rd-navbar-static" data-xxl-device-layout="rd-navbar-static" data-lg-stick-up-offset="46px"
          data-xl-stick-up-offset="46px" data-xxl-stick-up-offset="46px" data-lg-stick-up="true" data-xl-stick-up="true"
          data-xxl-stick-up="true">
          <div class="rd-navbar-main-outer">
            <div class="rd-navbar-main">
              <!-- RD Navbar Panel-->
              <div class="rd-navbar-panel">
                <!-- RD Navbar Toggle-->
                <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
                <!-- RD Navbar Brand-->
                <div class="rd-navbar-brand">
                  <a href="../views/index.html"><img class="brand-logo-light" src="../Images/logo.png" alt="" width="100" height=""/></a>
                </div>
              </div>
              <div class="rd-navbar-main-element">
                <div class="rd-navbar-nav-wrap">
                  <!-- RD Navbar Nav-->
                  <ul class="rd-navbar-nav">
                    <li class="rd-nav-item active"><a class="rd-nav-link" href="../views/index.php">Inicio</a></li>
                    <li class="rd-nav-item"><a class="rd-nav-link" href="#">Programas</a></li>
                    <li class="rd-nav-item"><a class="rd-nav-link" href="../views/nosotros.html">Sobre nosotros</a></li>
                    <?php if (!isset($_SESSION['user_id'])): ?>
                      <li class="rd-nav-item"><a class="rd-nav-link" href="../views/login.html">Iniciar sesión</a></li>
                    <?php else: ?>
                      <li class="rd-nav-item">
                        <div class="dropdown">
                          <button class="button button-primary button-sm dropdown-toggle" type="button" id="profileDropdown"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="icon icon-md linearicons-user"></span> 
                          </button>
                          <div class="dropdown-menu" aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="<?php echo $dashboard_url; ?>">Mi Tablero</a>
                            <a class="dropdown-item" href="/EqualEducation/Controllers/Login/Logout.php">Cerrar Sesión</a>
                          </div>
                        </div>
                      </li>
                    <?php endif; ?>
                  </ul>
                  <a class="button button-primary button-sm" href="../views/donaciones.php">Donar</a>
                </div>
              </div>
              <a class="button button-primary button-sm" href="../views/donaciones.php">Donar</a>
            </div>
          </div>
        </nav>
      </div>
    </header>

    <!-- Swiper-->
    <section class="section section-lg section-main-bunner section-main-bunner-filter">
      <div class="main-bunner-img" style="background-image: url(../../Public/image/img10.jpg); background-size: cover;"></div>
      <div class="main-bunner-inner">
        <div class="container">
          <div class="row row-50 justify-content-lg-center align-items-lg-center">
            <div class="col-lg-12">
              <div class="bunner-content-modern text-center">
                <h1 class="main-bunner-title">Equal Education</h1>
                <p>Hacemos todo lo posible para que niños y jovenes tengan una educación de calidad. Creemos que cada persona debe de dejar su huella en el mundo y ayudar a construir un futuro mejor.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="section section-xl">
      <div class="container">
        <div class="row row-50 justify-content-lg-between align-items-lg-center">
          <div class="col-lg-6">
            <div class="box-img-animate">
              <div class="box-img-animate-item" data-parallax-scroll="{&quot;y&quot;: 0, &quot;x&quot;: 140,  &quot;smoothness&quot;: 50 }"><img src="../../Public/image/E1.jpeg" alt=""></div>
              <div class="box-img-animate-item" data-parallax-scroll="{&quot;y&quot;: 150, &quot;x&quot;: 0,  &quot;smoothness&quot;: 50 }"><img src="../../Public/image/E2.jpg" alt=""></div>
              <div class="box-img-animate-item" data-parallax-scroll="{&quot;y&quot;:70, &quot;x&quot;: -250,  &quot;smoothness&quot;: 50 }"><img src="../../Public/image/E3.png" alt=""></div>
              <div class="box-img-animate-item" data-parallax-scroll="{&quot;y&quot;:20, &quot;x&quot;: 20,  &quot;smoothness&quot;: 50 }"><img src="../../Public/image/E4.png" alt=""></div>
              <div class="box-img-animate-item" data-parallax-scroll="{&quot;y&quot;:60, &quot;x&quot;: 70,  &quot;smoothness&quot;: 50 }"><img src="../../Public/image/E5.jpeg" alt=""></div>
              <div class="box-img-animate-item" data-parallax-scroll="{&quot;y&quot;:0, &quot;x&quot;: 140,  &quot;smoothness&quot;: 50 }"><img src="../../Public/image/E6.jpg" alt=""></div>
            </div>
          </div>
          <div class="col-lg-6 col-xl-5">
            <div class="innset-xl-left-70">
              <h3>Nuestra misión</h3>
              <p class="text-opacity-80">Nuestra organización persigue varios objetivos que pueden identificarse como nuestra misión.</p>
              <div class="row row-50">
                <div class="col-md-6 col-lg-12">
                  <div class="box-icon-modern">
                    <div class="box-icon-inner decorate-triangle"><span class="icon-xl linearicons-pencil icon-primary"></span></div>
                    <div class="box-icon-caption">
                      <h4><a>Educación Igualitaria</a></h4>
                      <p>Nuestra misión principal es brindar eduación igualitaria a niños y jovenes.</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-lg-12">
                  <div class="box-icon-modern">
                    <div class="box-icon-inner decorate-circle"><span class="icon-xl linearicons-library icon-primary"></span></div>
                    <div class="box-icon-caption">
                      <h4><a>Programas Educativos</a></h4>
                      <p>Ofrecer programas educativos gratuitos y de alta calidad.</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-lg-12">
                  <div class="box-icon-modern">
                    <div class="box-icon-inner decorate-rectangle"><span class="icon-xl linearicons-book icon-primary"></span></div>
                    <div class="box-icon-caption">
                      <h4><a>Disposición al aprendizaje</a></h4>
                      <p>Diseñar programas flexibles tomando en cuenta la diversidad estudiantil.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="section section-lg bg-gray-1">
      <div class="container">
        <div class="row justify-content-center text-center">
          <div class="col-md-9 col-lg-7 wow-outer">
            <div class="wow slideInDown">
              <h3>Últimas causas</h3>
              <p>En Equal Education, existen diversas causas y proyectos benéficos en los que siempre puedes participar.</p>
            </div>
          </div>
        </div>
        <div class="row row-50">
          <div class="col-md-6 col-lg-4 wow-outer">
            <div class="wow fadeInUp">
              <article class="box-causes">
                <div class="box-causes-img"><img src="../../Public/image/img6.jpg" alt="" width="372" height="396"/><a class="button button-sm button-primary" href="../views/donaciones.php">Donate</a>
                </div>
                <h4 class="font-weight-medium"><a>Becas para jovenes</a></h4>
                <p class="box-causes-donate"><span class="box-causes-donate-complete">$20,000</span> de <span>$100,000</span> pesos recaudados para becas dirigidas hacia jovenes en situación de resago educativo
                </p>
              </article>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 wow-outer">
            <div class="wow fadeInUp">
              <article class="box-causes">
                <div class="box-causes-img"><img src="../../Public/image/img6.jpg" alt="" width="372" height="396"/><a class="button button-sm button-primary" href="../views/donaciones.php">Donate</a>
                </div>
                <h4 class="font-weight-medium"><a>Apoyo económico a niños</a></h4>
                <p class="box-causes-donate"><span class="box-causes-donate-complete">$10,000</span> de <span>$30,000</span> pesos recaudados para apoyar económicamente a niños necesitados
                </p>
              </article>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 wow-outer">
            <div class="wow fadeInUp">
              <article class="box-causes">
                <div class="box-causes-img"><img src="../../Public/image/img6.jpg" alt="" width="372" height="396"/><a class="button button-sm button-primary" href="../views/donaciones.php">Donate</a>
                </div>
                <h4 class="font-weight-medium"><a>Apoyo a programas educativos</a></h4>
                <p class="box-causes-donate"><span class="box-causes-donate-complete">$42,280</span> de <span>$45,000</span> pesos recaudados para apoyar económicamente a programas educativos
                </p>
              </article>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Page Footer-->
    <footer class="section footer-minimal context-dark">
      <div class="container wow-outer">
        <div class="wow fadeIn">
          <div class="row row-50 row-lg-60">
            <div class="col-12"><a href="../views/index.html"><img src="../Images/logo.png" alt="" width="207" height="51"/></a></div>
            <div class="col-12">
              <ul class="footer-minimal-nav">
                <li><a href="../views/nosotros.html">Equipo</a></li>
                <li><a href="#">Términos de servicio</a></li>
                <li><a href="#">Política de privacidad</a></li>
                <li><a href="../views/contacto.html">Contacto</a></li>
              </ul>
            </div>
          </div>
          <p class="rights"><span>&copy;&nbsp;</span><span class="copyright-year"></span><span>&nbsp;</span><span>Equal Education</span><span>.&nbsp;</span><span>All Rights Reserved.</span><span>&nbsp;</span>Design&nbsp;by Equal Education</p>
        </div>
      </div>
    </footer>
  </div>
  <div class="snackbars" id="form-output-global"></div>
  <script src="../js/core.min.js"></script>
  <script src="../js/scriptt.js"></script>
</body>
</html>
