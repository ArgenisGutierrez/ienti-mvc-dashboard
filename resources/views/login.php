<?php

/**
 * Vista de autenticación de usuarios Login
 * 
 * @category Vistas
 * @package  Auth
 * 
 * @uses \Lib\Alert Para mostrar notificaciones
 * @see  \App\Controllers\AuthController Controlador asociado
 * 
 * @var string $old_email Email almacenado en sesión para autocompletar
 */
session_start();
// Redirección si el usuario ya está autenticado
if (!empty($_SESSION['usuario_id']) && !empty($_SESSION['nombre'])) {
  session_regenerate_id(true);
  header('Location:' . APP_URL);
  exit();
} else {
  $old_email = $_SESSION['email'] ?? '';
?>
  <!DOCTYPE html>
  <html lang="es-MX">

  <head>
    <!-- Metadatos comunes -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Metadatos SEO -->
    <link rel="shortcut icon" href="images/icon.ico" />

    <!-- Título dinámico -->
    <title><?php echo APP_NAME ?></title>

    <!-- *************
       Hojas de estilo
       ************* -->
    <!-- Bootstrap core -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />

    <!-- Iconos Bootstrap -->
    <link rel="stylesheet" href="fonts/bootstrap/bootstrap-icons.css" />

    <!-- Estilos principales -->
    <link rel="stylesheet" href="css/main.min.css" />

    <!-- Estilos específicos de login -->
    <link rel="stylesheet" href="css/login.css" />

    <!-- Efectos de partículas -->
    <link rel="stylesheet" href="vendor/particles/particles.css" />
  </head>

  <body class="login-container">
    <!-- Efecto de partículas background -->
    <div id="particles-js"></div>
    <div class="countdown-bg"></div>

    <!-- Contenedor principal del formulario -->
    <div class="container" style="z-index: 1;">
      <form action="<?php echo APP_URL; ?>login"
        method="post"
        class="needs-validation"
        novalidate
        autocomplete="off">

        <div class="login-box rounded-2 p-5">
          <!-- Cabecera del formulario -->
          <div class="login-form">
            <a href="https://www.ienti.com.mx" class="login-logo mb-3">
              <img src="images/logo.webp" alt="Logo ienti & manwere" />
            </a>
            <h5 class="fw-light mb-5">Inicia Sesión para acceder</h5>

            <!-- Campo: Email -->
            <div class="mb-3">
              <label class="form-label">Correo</label>
              <input id="email_usuario"
                name="email_usuario"
                type="text"
                class="form-control"
                placeholder="Ingresa tu correo"
                value="<?php echo $old_email ?>"
                required />
            </div>

            <!-- Campo: Contraseña con toggle -->
            <div class="mb-3 position-relative">
              <label class="form-label">Contraseña</label>
              <div class="input-group">
                <input id="password_usuario"
                  name="password_usuario"
                  type="password"
                  class="form-control"
                  placeholder="Ingresa tu contraseña"
                  required />
                <button type="button"
                  class="btn btn-link text-decoration-none position-absolute end-0 top-50 translate-middle-y"
                  onclick="togglePasswordVisibility()"
                  aria-label="Mostrar/ocultar contraseña">
                  <i id="eyeIcon" class="bi bi-eye-slash"></i>
                </button>
              </div>
            </div>

            <!-- Enlaces adicionales -->
            <div class="d-flex align-items-center justify-content-between">
              <a href="<?php echo APP_URL; ?>forgetPassword"
                class="text-blue text-decoration-underline">
                ¿Olvidaste tu contraseña?
              </a>
            </div>

            <!-- Botón de submit -->
            <div class="d-grid py-3">
              <button type="submit"
                class="btn btn-primary"
                value="add"
                name="action">
                Iniciar Sesión
              </button>
            </div>
          </div>

          <!-- Enlace a registro -->
          <div class="text-center pt-3">
            <span>¿No tienes cuenta?</span>
            <a href="<?php echo APP_URL; ?>registro"
              class="text-blue text-decoration-underline ms-2">
              Crear Cuenta
            </a>
          </div>
        </div>
      </form>
    </div>

    <!-- *************
       Scripts
       ************* -->
    <!-- Validaciones de formulario -->
    <script src="js/validations.js"></script>

    <!-- SweetAlert2 para notificaciones -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Sistema de alertas -->
    <?php Lib\Alert::display(); ?>

    <!-- Efectos de partículas -->
    <script src="vendor/particles/particles.min.js"></script>
    <script src="vendor/particles/particles-custom.js"></script>

    <!-- Toggle de visibilidad de contraseña -->
    <script>
      /**
       * Alterna la visibilidad del campo de contraseña
       * @function togglePasswordVisibility
       */
      function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password_usuario');
        const eyeIcon = document.getElementById('eyeIcon');

        passwordInput.type = passwordInput.type === 'password' ? 'text' : 'password';
        eyeIcon.classList.toggle('bi-eye-slash');
        eyeIcon.classList.toggle('bi-eye');
      }
    </script>
  </body>

  </html>
<?php
}
?>
