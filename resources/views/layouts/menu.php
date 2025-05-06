<nav class="sidebar-wrapper">

  <!-- Sidebar menu starts -->
  <div class="sidebar-menu">
    <div class="sidebarMenuScroll">
      <ul>
        <li>
          <a href="<?php echo APP_URL; ?>">
            <i class="bi bi-house"></i>
            <span class="menu-text">Home</span>
          </a>
        </li>
        <?php if (isset($_SESSION['permisos']) && in_array("Ver Usuarios", $_SESSION['permisos'])) : ?>
          <li>
            <a href="<?php echo APP_URL; ?>usuarios">
              <i class="bi bi-person-video2"></i>
              <span class="menu-text">Usuarios</span>
            </a>
          </li>
        <?php endif; ?>
        <?php if (isset($_SESSION['permisos']) && in_array("Ver Recursos", $_SESSION['permisos'])) : ?>
          <li>
            <a href="<?php echo APP_URL; ?>recursos">
              <i class="bi bi-boxes"></i>
              <span class="menu-text">Recursos</span>
            </a>
          </li>
        <?php endif; ?>
        <?php if (isset($_SESSION['permisos']) && in_array("Ver Roles", $_SESSION['permisos'])) : ?>
          <li>
            <a href="<?php echo APP_URL; ?>roles">
              <i class="bi bi-file-earmark-lock2-fill"></i>
              <span class="menu-text">Roles</span>
            </a>
          </li>
        <?php endif; ?>
        <li>
          <a href="<?php echo APP_URL; ?>categorias">
            <i class="bi bi-tags"></i>
            <span class="menu-text">Categorias</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
  <!-- Sidebar menu ends -->
</nav>
