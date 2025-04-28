<div class="page-header">

  <!-- Sidebar brand starts -->
  <div class="brand">
    <a href="<?php echo APP_URL; ?>" class="logo">
      <img src="<?php echo APP_URL; ?>images/logo.webp" class="d-none d-md-block me-4" alt="Bloom Admin Dashboard" />
      <img src="<?php echo APP_URL; ?>images/logo.webp" class="d-block d-md-none me-4" alt="Bloom Admin Dashboard" />
    </a>
  </div>
  <!-- Sidebar brand ends -->

  <div class="toggle-sidebar" id="toggle-sidebar">
    <i class="bi bi-list"></i>
  </div>

  <!-- Header actions ccontainer start -->
  <div class="header-actions-container">

    <!-- Header actions start -->
    <!-- Header actions start -->

    <!-- Header profile start -->
    <div class="header-profile d-flex align-items-center">
      <div class="dropdown">
        <a href="#" id="userSettings" class="user-settings" data-toggle="dropdown" aria-haspopup="true">
          <span class="user-name d-none d-md-block">
            <?php echo $_SESSION['nombre'] ?>
          </span>
          <span class="avatar">
            <img src="<?php echo !empty($_SESSION['imagen']) ? 'files/' . $_SESSION['imagen'] : 'images/users.svg'; ?>" alt="User Avatar" />
            <span class="status online"></span>
          </span>
        </a>
        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userSettings">
          <div class="header-profile-actions">
            <a href="<?php echo APP_URL; ?>usuario">Perfil</a>
            <a href="<?php echo APP_URL; ?>logout">Cerrar Sesion</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Header profile end -->

  </div>
  <!-- Header actions ccontainer end -->
</div>
