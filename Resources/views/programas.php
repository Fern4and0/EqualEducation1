<?php

session_start();

include '../../DB/DB.php';

$sql = "SELECT id, nombre, objetivo, fecha_ini, fecha_fin FROM programas ORDER BY fecha_ini ASC";
$consulta = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Display:ital,wght@0,100..900;1,100..900&display=swap');
        body{
            background-color: #f5f7fa;
            font-family: "Noto Sans Display";
        }
        .donation-header {
            position: relative;
            height: 400px;
            background-color: #f0f0f0;
            overflow: hidden;
        }

        .donation-header img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: brightness(60%);
        }

        .overlay-text {
            width: 25rem;
            text-align: left;
            position: absolute;
            top: 50%;
            left: 25%;
            transform: translate(-50%, -50%);
            color: white;
        }

        .overlay-text h1 {
            font-size: 2.5rem;
            font-weight: bold;
        }
        .program-header {
            font-weight: bold;
            font-size: 2rem;
            margin-top: 3rem;
            margin-bottom: 1rem;
        }

        .subheader {
            font-size: 1.25rem;
            margin-bottom: 4rem;
        }

        .featured-program{
            margin: 0 auto;
            width: 65rem;
            margin-bottom: 2rem;
            background-color: #fff;
            padding: 1.5rem;
            box-shadow: 0 3px 0 0 rgba(0, 0, 0, 0.025);
            border: solid 1.5px rgba(65, 65, 66, 0.2);
            border-radius: 20px;
            display: flex;
            opacity: 0;
            transform: translateY(50px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }
        .featured-program.show{
            opacity: 1;
            transform: translateY(0);
        }

        .featured-image {
            border-radius: 10px;
            width: 140px;
            height: 140px;
        }

        .featured-text {
            max-height: 5rem;
            overflow: hidden;
            position: relative;
            font-size: 1.1rem;
            transition: max-height 1s ease;
        }
        .featured-text.expanded{
            max-height: none;
        }

        .program-info {
            margin-top: 1rem;
        }
        .contenido{
            margin-left: 1.5rem;
        }

        .hidden-content {
            display: none;
        }
        .prgm-footer{
            display: flex;
            justify-content: space-between;
        }
        .unirse{
            font-family: Arial, Helvetica, sans-serif;
            display: none;
            border: none;
            color: #fff;
            background-color: #000;
            border-radius: 5px;
            font-size: 1.1rem;
        }

        .show-more{
            padding: 0;
            border: none;
            color: #000;
            background-color: transparent;
        }
    </style>
</head>

<body>
    <?php include('layout/header.php'); ?>
    <div class="container-fluid p-0">
        <div class="donation-header text-center">
            <img src="../../Public/image/img6.jpg" alt="Imagen" class="img-fluid">
            <div class="overlay-text">
                <h1>Participa en programas gratuitos</h1>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Program header -->
        <h2 class="program-header text-center">Programas disponibles</h2>
        <p class="subheader text-center">Participa en nuestros programas educativos gratuitos y abre la puerta a nuevas oportunidades.
            Aprende nuevas habilidades, mejora tu futuro y conéctate con una comunidad de personas que, como tú, buscan superarse.
            ¡Es el momento de invertir en ti mismo, sin costo alguno!</p>
        
        <?php
        if ($consulta->num_rows > 0) {
            // Mostrar los productos en divs
            while($row = $consulta->fetch_assoc()) {
                $id = $row['id'];
                echo "<div class='featured-program'>
            <div>
                <img src='https://via.placeholder.com/100' alt='Featured image' class='featured-image'>
            </div>
            <div class='contenido'>
                <h6><strong>" . $row["fecha_ini"] . ' // ' . $row["fecha_fin"] ."</strong></h6>
                <h4>" . $row["nombre"] . "</h4>
                <p id='featured-text-$id' class='featured-text'>
                    " . $row["objetivo"] . "
                </p>
                <div class='prgm-footer'><button class='show-more' id='show-more-btn-$id' onclick='toggleText($id)'>Mostrar más +</button>   <button class='unirse' id='unirse-$id'>Unirse      <i class='bi bi-person-add'></i></button></div>
            </div>
        </div>";
            }
        } else {
            // Si no hay resultados
            echo "<p>No hay programas disponibles</p>";
        }
        ?>
    </div>

    <script>
    function toggleText(id) {
        const featuredText = document.getElementById('featured-text-' + id);
        const showMoreBtn = document.getElementById('show-more-btn-' + id);
        const unirse = document.getElementById('unirse-' + id);
        
        let isExpanded = featuredText.classList.contains('expanded');

        if (isExpanded) {
            featuredText.classList.remove('expanded');
            unirse.style.display = "none";
            showMoreBtn.textContent = "Mostrar más +";
        } else {
            featuredText.classList.add('expanded');
            unirse.style.display = "inline";
            showMoreBtn.textContent = "Mostrar menos -";
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        const featuredPrograms = document.querySelectorAll('.featured-program');

        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('show');
                    observer.unobserve(entry.target); // Deja de observar el elemento una vez ha aparecido
                }
            });
        }, {
            threshold: 0.1 // El 10% del elemento debe ser visible para activarse
        });

        featuredPrograms.forEach(program => {
            observer.observe(program);
        });
    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <?php include('layout/footer.php'); ?>
</body>

</html>
