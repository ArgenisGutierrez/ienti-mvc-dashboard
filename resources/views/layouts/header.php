        <div class="main-header d-flex align-items-center justify-content-between position-relative">
          <div class="d-flex align-items-center justify-content-center">
            <div class="page-icon">
              <i class="bi bi-house"></i>
            </div>
            <div class="page-title d-none d-md-block">
            <h5>Bienvenido <?php echo $_SESSION['nombre']?>
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
