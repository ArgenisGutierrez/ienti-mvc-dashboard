<?php
session_start();
if (!empty($_SESSION['usuario_id']) && !empty($_SESSION['nombre'])) {
  session_regenerate_id(true);
?>
  <!DOCTYPE html>
  <html lang="es-MX">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php echo APP_NAME ?></title>

    <link rel="shortcut icon" href="images/icon.ico" />

    <!-- *************
            ************ Common Css Files *************
        ************ -->
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />

    <!-- Bootstrap font icons css -->
    <link rel="stylesheet" href="fonts/bootstrap/bootstrap-icons.css" />

    <!-- Main css -->
    <link rel="stylesheet" href="css/main.min.css" />

    <!-- *************
            ************ Vendor Css Files *************
        ************ -->

    <!-- Scrollbar CSS -->
    <link rel="stylesheet" href="vendor/overlay-scroll/OverlayScrollbars.min.css" />
  </head>

  <body>

    <!-- Loading wrapper start -->
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
    <!-- Loading wrapper end -->

    <!-- Page wrapper start -->
    <div class="page-wrapper">

      <!-- Page header starts -->
      <?php include_once "layouts/head.php"; ?>
      <!-- Page header ends -->

      <!-- Main container start -->
      <div class="main-container">

        <!-- Sidebar wrapper start -->
        <?php include_once "layouts/menu.php"; ?>
        <!-- Sidebar wrapper end -->

        <!-- Content wrapper scroll start -->
        <div class="content-wrapper-scroll">

          <!-- Main header starts -->
          <div class="main-header d-flex align-items-center justify-content-between position-relative">
            <div class="d-flex align-items-center justify-content-center">
              <div class="page-icon">
                <i class="bi bi-house"></i>
              </div>
              <div class="page-title d-none d-md-block">
                <h5>Bienvenido <?php echo $_SESSION['nombre'] ?>
                </h5>
              </div>
            </div>
            <!-- Live updates start -->
            <!-- Live updates end -->
          </div>

          <!-- Main header ends -->

          <!-- Content wrapper start -->
          <div class="content-wrapper">
            <!-- Row start -->
            <div class="row gx-3">
              <div class="col-xl-12">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">Administrador Home</div>
                  </div>
                  <div class="card-body">
                    <div class="row gx-3">
                      <div class="col-xxl-3 col-sm-6 col-12">
                        <div class="stats-tile d-flex align-items-center position-relative tile-green">
                          <div class="sale-icon icon-box xl rounded-5 me-3">
                            <i class="bi bi-emoji-smile font-2x text-green"></i>
                          </div>
                          <div class="sale-details">
                            <h5 class="text-light">Usuarios</h5>
                            <h3>
                              <?php echo $usuarios ?>
                            </h3>
                          </div>
                        </div>
                      </div>
                      <div class="col-xxl-3 col-sm-6 col-12">
                        <div class="stats-tile d-flex align-items-center position-relative tile-blue">
                          <div class="sale-icon icon-box xl rounded-5 me-3">
                            <i class="bi bi-sticky font-2x text-blue"></i>
                          </div>
                          <div class="sale-details">
                            <h5 class="text-light">Recursos</h5>
                            <h3>
                              <?php echo $recursos ?>
                            </h3>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Row end -->
          </div>
          <!-- Content wrapper end -->

        </div>
        <!-- Content wrapper scroll end -->

        <!-- App Footer start -->
        <div class="app-footer">
          <span>© ienti & manwere</span>
        </div>
        <!-- App footer end -->

      </div>
      <!-- Main container end -->

    </div>
    <!-- Page wrapper end -->

    <!-- *************
            ************ Required JavaScript Files *************
        ************* -->
    <!-- Required jQuery first, then Bootstrap Bundle JS -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/modernizr.js"></script>
    <script src="js/moment.js"></script>

    <!-- *************
            ************ Vendor Js Files *************
        ************* -->

    <!-- Overlay Scroll JS -->
    <script src="vendor/overlay-scroll/jquery.overlayScrollbars.min.js"></script>
    <script src="vendor/overlay-scroll/custom-scrollbar.js"></script>

    <!-- News ticker -->
    <script src="vendor/newsticker/newsTicker.min.js"></script>
    <script src="vendor/newsticker/custom-newsTicker.js"></script>

    <!-- sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php Lib\Alert::display(); ?>

    <!-- Apex Charts -->
    <script src="vendor/apex/apexcharts.min.js"></script>
    <script src="vendor/apex/custom/dash1/analytics.js"></script>
    <script src="vendor/apex/custom/dash1/visitors.js"></script>
    <script src="vendor/apex/custom/dash1/income.js"></script>
    <script src="vendor/apex/custom/dash1/orders.js"></script>
    <script src="vendor/apex/custom/dash1/sales.js"></script>
    <script src="vendor/apex/custom/dash1/sparkline.js"></script>
    <script src="vendor/apex/custom/dash1/conversion.js"></script>

    <!-- Main Js Required -->
    <script src="js/main.js"></script>
  </body>

  </html>
<?php
} else {
  header('Location:' . APP_URL . 'login');
  exit();
}
?>
