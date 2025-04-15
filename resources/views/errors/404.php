<!DOCTYPE html>
<html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

        <link rel="shortcut icon" href="assets/images/favicon.svg" />

        <!-- Title -->
    <title><?php echo APP_NAME?></title>

        <!-- *************
            ************ Common Css Files *************
        ************ -->
        <!-- Bootstrap css -->
        <link rel="stylesheet" href="../css/bootstrap.min.css" />

        <!-- Login css -->
        <link rel="stylesheet" href="../css/login.css" />

        <!-- Particles CSS -->
        <link rel="stylesheet" href="../vendor/particles/particles.css" />
    </head>

    <body class="error-screen">
        <div id="particles-js"></div>
        <div class="countdown-bg"></div>

        <div class="d-flex flex-column position-relative text-center p-5 mt-5">
            <h1>404</h1>
            <h5 class="fw-lighter mb-4">
                Lo sentimos, la página que buscas no esta disponible
            </h5>
            <a href="<?php echo APP_URL;?>" class="btn m-auto fw-bold">Regresar a la página principal</a>
        </div>

        <!--**************************
            **************************
                **************************
                            Required JavaScript Files
                **************************
            **************************
        **************************-->
        <!-- Required jQuery first, then Bootstrap Bundle JS -->
        <script src="../js/jquery.min.js"></script>
        <script src="../js/bootstrap.bundle.min.js"></script>
        <script src="../js/moment.js"></script>

        <!-- *************
            ************ Vendor Js Files *************
        ************* -->
        <!-- Particles JS -->
        <script src="../vendor/particles/particles.min.js"></script>
        <script src="../vendor/particles/particles-custom.js"></script>
    </body>

</html>
