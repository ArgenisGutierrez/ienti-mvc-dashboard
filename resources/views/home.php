<?php

/**
 * Vista principal del dashboard administrativo
 * 
 * @category Vistas
 * @package  Dashboard
 * 
 * @uses \Lib\Alert Para mostrar notificaciones
 * @see  \App\Controllers\HomeController Controlador asociado
 * @uses \Layouts\head.php Header común
 * @uses \Layouts\menu.php Menú lateral
 * 
 * @var int $usuarios Total de usuarios registrados
 * @var int $recursos Total de recursos disponibles
 */
session_start();

// Verificación de sesión activa
if (!empty($_SESSION['usuario_id']) && !empty($_SESSION['nombre'])) {
  session_regenerate_id(true); // Seguridad contra fixation attacks
?>
  <!DOCTYPE html>
  <html lang="es-MX">

  <head>
    <!-- Metadatos comunes -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Título dinámico -->
    <title><?php echo APP_NAME ?></title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="images/icon.ico" />

    <!-- *************
         Hojas de estilo 
         ************* -->
    <!-- Bootstrap core -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />

    <!-- Iconos Bootstrap -->
    <link rel="stylesheet" href="fonts/bootstrap/bootstrap-icons.css" />

    <!-- Estilos principales -->
    <link rel="stylesheet" href="css/main.min.css" />

    <!-- Scrollbar personalizada -->
    <link rel="stylesheet" href="vendor/overlay-scroll/OverlayScrollbars.min.css" />
  </head>

  <body>
    <!-- Preloader -->
    <div id="loading-wrapper">
      <div class="spinner">
        <div class="line1"></div>
        <div class="line2"></div>
        <div class="line3"></div>
        <div class="line4"></div>
        <div class="line5"></div>
        <div class="line6"></div>
      </div>
    </div>

    <!-- Contenedor principal -->
    <div class="page-wrapper">
      <!-- Header -->
      <?php include_once "layouts/head.php"; ?>

      <!-- Contenedor del contenido -->
      <div class="main-container">
        <!-- Menú lateral -->
        <?php include_once "layouts/menu.php"; ?>

        <!-- Contenido principal -->
        <div class="content-wrapper-scroll">
          <!-- Cabecera del contenido -->
          <div class="main-header d-flex align-items-center justify-content-between position-relative">
            <div class="d-flex align-items-center justify-content-center">
              <div class="page-icon">
                <i class="bi bi-house"></i>
              </div>
              <div class="page-title d-none d-md-block">
                <h5>Bienvenido <?php echo $_SESSION['nombre'] ?></h5>
              </div>
            </div>
          </div>

          <!-- Estadísticas -->
          <div class="content-wrapper">
            <div class="row gx-3">
              <div class="col-xl-12">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">Administrador Home</div>
                  </div>
                  <div class="card-body">
                    <div class="row gx-3">
                      <!-- Tarjeta: Usuarios -->
                      <div class="col-xxl-3 col-sm-6 col-12">
                        <div class="stats-tile d-flex align-items-center position-relative tile-green">
                          <div class="sale-icon icon-box xl rounded-5 me-3">
                            <i class="bi bi-emoji-smile font-2x text-green"></i>
                          </div>
                          <div class="sale-details">
                            <h5 class="text-light">Usuarios</h5>
                            <h3><?php echo $usuarios ?></h3>
                          </div>
                        </div>
                      </div>

                      <!-- Tarjeta: Recursos -->
                      <div class="col-xxl-3 col-sm-6 col-12">
                        <div class="stats-tile d-flex align-items-center position-relative tile-blue">
                          <div class="sale-icon icon-box xl rounded-5 me-3">
                            <i class="bi bi-sticky font-2x text-blue"></i>
                          </div>
                          <div class="sale-details">
                            <h5 class="text-light">Recursos</h5>
                            <h3><?php echo $recursos ?></h3>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Footer -->
          <div class="app-footer">
            <span>© ienti & manwere</span>
          </div>
        </div>
      </div>
    </div>

    <!-- *************
         Scripts 
         ************* -->
    <!-- Dependencias principales -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>

    <!-- Scrollbar personalizada -->
    <script src="vendor/overlay-scroll/jquery.overlayScrollbars.min.js"></script>
    <script src="vendor/overlay-scroll/custom-scrollbar.js"></script>

    <!-- Gráficos -->
    <script src="vendor/apex/apexcharts.min.js"></script>
    <script src="vendor/apex/custom/dash1/analytics.js"></script>

    <!-- Notificaciones -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php Lib\Alert::display(); ?>

    <!-- Scripts principales -->
    <script src="js/main.js"></script>
  </body>

  </html>
<?php
} else {
  // Redirección para usuarios no autenticados
  header('Location:' . APP_URL . 'login');
  exit();
}
?>
