<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../Resources/css/styles_donaciones.css">
</head>

<body>
<?php include('layout/header.php'); ?>
    <!-- Header Section -->
    <div class="container-fluid p-0">
        <div class="donation-header text-center">
            <img src="../../Public/image/img4.jpg" alt="Imagen" class="img-fluid">
            <div class="overlay-text">
                <h1>Cambia vidas para siempre</h1>
            </div>
        </div>
    </div>

    <!-- Donation Form Section -->
    <div class="contenedor">
        <h5>¿Porque contribuir?</h5>
        <p>Tu donación no solo apoya a estudiantes con recursos escolares, becas o acceso a la tecnología, sino que construye un futuro más justo, lleno de oportunidades, ademas de ayudarnos a sostener nuestro trabajo. Al donar, te conviertes en parte de un movimiento que cambia vidas a través de la educación.</p>
        <ul>
            <li><strong>100% Seguro</strong></li>
            <li><strong>Eficaz.</strong>Nuestros informes de impacto avalan la eficacia de nuestro trabajo.</li>
            <li><strong>Efectivo.</strong>90% de las donaciones estan dirigidas a aquellos que mas lo necesitan.</li>
        </ul>
        <p>No importa el monto, cada contribución cuenta y puede cambiar el destino de una comunidad. Ayúdanos a darles a más niños la oportunidad de aprender, crecer y prosperar.</p>
        <!--<style>.pp-DAP6RSE8NFRRJ{text-align:center; margin-left: 280px; border:none;border-radius:10px;min-width:11.625rem;padding:0 2rem;height:2.625rem;font-weight:bold;background-color:#000000;color:#ffffff;font-family:"Helvetica Neue",Arial,sans-serif;font-size:1rem;line-height:1.25rem;cursor:pointer;}</style>
<form action="https://www.sandbox.paypal.com/ncp/payment/DAP6RSE8NFRRJ" method="post" target="_top" style="display:inline-grid;justify-items:center;align-content:start;gap:0.5rem;">
  <input class="pp-DAP6RSE8NFRRJ" type="submit" value="Donar" />
</form> -->
        <div id="donate-button-container">
            <div id="donate-button"></div>
            <script src="https://www.paypalobjects.com/donate/sdk/donate-sdk.js" charset="UTF-8"></script>
            <script>
            PayPal.Donation.Button({
            env:'sandbox',
            hosted_button_id:'FHAFN9D6MVUBC',
            image: {
            src:'https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif',
            alt:'Donate with PayPal button',
            title:'PayPal - The safer, easier way to pay online!',
            },
            onComplete: function(detalles){
                console.log(detalles);
            }
            }).render('#donate-button');

            //convertir los detalles de la donacion a json
            let detallesJSON = JSON.stringify(detalles);

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "../../../Controllers/detallesDonacion.php", true);
            xhr.setRequestHeader("Content-Type", "application/json");
            xhr.send(detallesJSON);
            </script>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <?php include('layout/footer.php'); ?>
</body>

</html>
