<!DOCTYPE html>
<html lang="es-MX">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title></title>

  <!-- Meta -->
  <meta name="description" content="Marketplace for Bootstrap Admin Dashboards" />
  <meta name="author" content="Bootstrap Gallery" />
  <link rel="canonical" href="https://www.bootstrap.gallery/">
  <meta property="og:url" content="https://www.bootstrap.gallery">
  <meta property="og:title" content="Admin Templates - Dashboard Templates | Bootstrap Gallery">
  <meta property="og:description" content="Marketplace for Bootstrap Admin Dashboards">
  <meta property="og:type" content="Website">
  <meta property="og:site_name" content="Bootstrap Gallery">
  <link rel="shortcut icon" href="images/favicon.svg" />

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
    <div class="page-header">

      <!-- Sidebar brand starts -->
      <div class="brand">
      <a href="<?php echo APP_URL;?>" class="logo">
          <img src="images/logo.webp" class="d-none d-md-block me-4" alt="Bloom Admin Dashboard" />
          <img src="images/logo.webp" class="d-block d-md-none me-4" alt="Bloom Admin Dashboard" />
        </a>
      </div>
      <!-- Sidebar brand ends -->

      <div class="toggle-sidebar" id="toggle-sidebar">
        <i class="bi bi-list"></i>
      </div>

      <!-- Header actions ccontainer start -->
      <div class="header-actions-container">

        <!-- Search container start -->
        <div class="search-container me-4 d-xl-block d-lg-none">

          <!-- Search input group start -->
          <input type="text" class="form-control" placeholder="Search" />
          <!-- Search input group end -->

        </div>
        <!-- Search container end -->

        <!-- Header actions start -->
        <div class="header-actions d-xl-flex d-lg-none gap-4">
          <div class="dropdown">
            <a class="dropdown-toggle" href="#!" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-envelope-open fs-5 lh-1"></i>
              <span class="count-label"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-end shadow-lg">
              <div class="dropdown-item">
                <div class="d-flex py-2 border-bottom">
                  <img src="images/user.png" class="img-3x me-3 rounded-3" alt="Admin Dashboards" />
                  <div class="m-0">
                    <h6 class="mb-1 fw-semibold">Sophie Michiels</h6>
                    <p class="mb-1">Membership has been ended.</p>
                    <p class="small m-0 text-secondary">Today, 07:30pm</p>
                  </div>
                </div>
              </div>
              <div class="dropdown-item">
                <div class="d-flex py-2 border-bottom">
                  <img src="images/user2.png" class="img-3x me-3 rounded-3" alt="Admin Dashboards" />
                  <div class="m-0">
                    <h6 class="mb-1 fw-semibold">Benjamin Michiels</h6>
                    <p class="mb-1">Congratulate, James for new job.</p>
                    <p class="small m-0 text-secondary">Today, 08:00pm</p>
                  </div>
                </div>
              </div>
              <div class="dropdown-item">
                <div class="d-flex py-2">
                  <img src="images/user1.png" class="img-3x me-3 rounded-3" alt="Admin Dashboards" />
                  <div class="m-0">
                    <h6 class="mb-1 fw-semibold">Jehovah Roy</h6>
                    <p class="mb-1">Lewis added new schedule release.</p>
                    <p class="small m-0 text-secondary">Today, 09:30pm</p>
                  </div>
                </div>
              </div>
              <div class="d-grid mx-3 my-1">
                <a href="javascript:void(0)" class="btn btn-primary">View all</a>
              </div>
            </div>
          </div>
          <a href="account-settings.html" data-bs-toggle="tooltip" data-bs-placement="bottom"
            data-bs-custom-class="custom-tooltip-blue" data-bs-title="Settings">
            <i class="bi bi-gear fs-5"></i>
          </a>
        </div>
        <!-- Header actions start -->

        <!-- Header profile start -->
        <div class="header-profile d-flex align-items-center">
          <div class="dropdown">
            <a href="#" id="userSettings" class="user-settings" data-toggle="dropdown" aria-haspopup="true">
              <span class="user-name d-none d-md-block">Michelle White</span>
              <span class="avatar">
                <img src="images/user7.png" alt="User Avatar" />
                <span class="status online"></span>
              </span>
            </a>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userSettings">
              <div class="header-profile-actions">
                <a href="profile.html">Profile</a>
                <a href="account-settings.html">Settings</a>
                <a href="login.html">Logout</a>
              </div>
            </div>
          </div>
        </div>
        <!-- Header profile end -->

      </div>
      <!-- Header actions ccontainer end -->

    </div>
    <!-- Page header ends -->

    <!-- Main container start -->
    <div class="main-container">

      <!-- Sidebar wrapper start -->
<nav class="sidebar-wrapper">

        <!-- Sidebar menu starts -->
        <div class="sidebar-menu">
          <div class="sidebarMenuScroll">
            <ul>
              <li>
                <a href="">
                  <i class="bi bi-house"></i>
                  <span class="menu-text">Home</span>
                </a>
              </li>
              <li>
              <a href="<?php echo APP_URL;?>usuarios">
                  <i class="bi bi-person-video2"></i>
                  <span class="menu-text">Usuarios</span>
                </a>
              </li>
              <li>
              <a href="<?php echo APP_URL;?>recursos">
                  <i class="bi bi-boxes"></i>
                  <span class="menu-text">Recursos</span>
                </a>
              </li>
              <li>
              <a href="<?php echo APP_URL;?>roles">
                  <i class="bi bi-file-earmark-lock2-fill"></i>
                  <span class="menu-text">Roles</span>
                </a>
              </li>
            </ul>
          </div>
        </div>
        <!-- Sidebar menu ends -->
      </nav>
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
              <h5>Welcome back,
              </h5>
            </div>
          </div>
          <!-- Live updates start -->
          <ul class="updates d-flex align-items-end flex-column overflow-hidden" id="updates">
            <li>
              <a href="javascript:void(0)">
                <i class="bi bi-envelope-paper text-red font-1x me-2"></i>
                <span>12 emails from David Michaiah.</span>
              </a>
            </li>
            <li>
              <a href="javascript:void(0)">
                <i class="bi bi-bar-chart text-blue font-1x me-2"></i>
                <span>15 new features updated successfully.</span>
              </a>
            </li>
            <li>
              <a href="javascript:void(0)">
                <i class="bi bi-folder-check text-yellow font-1x me-2"></i>
                <span>The media folder is created successfully.</span>
              </a>
            </li>
          </ul>
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
