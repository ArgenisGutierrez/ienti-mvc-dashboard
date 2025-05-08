<?php

/**
 * Vista para recuperación de contraseña mediante correo electrónico
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
    <meta name="description" content="Sistema de recuperación de contraseña" />
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
      <form action="<?php echo APP_URL; ?>forgetPassword"
        method="post"
        class="needs-validation"
        novalidate
        autocomplete="off">

        <div class="login-box rounded-2 p-5">
          <!-- Cabecera del formulario -->
          <div class="login-form">
            <a href="https://www.ienti.com.mx" class="login-logo mb-3">
              <img src="images/logo.webp" alt="Logo de la empresa" />
            </a>
            <h5 class="fw-light mb-5">Recuperación de contraseña</h5>

            <!-- Campo: Email -->
            <div class="mb-3">
              <label class="form-label">Correo electrónico</label>
              <input id="email_usuario"
                name="email_usuario"
                type="email"
                class="form-control"
                placeholder="Ingresa tu correo registrado"
                required
                pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
            </div>

            <!-- Botón de submit -->
            <div class="d-grid py-3">
              <button type="submit" class="btn btn-primary">
                Enviar enlace de recuperación
              </button>
            </div>
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
    <?php Lib\Alert::display(); ?>

    <!-- Efectos de partículas -->
    <script src="vendor/particles/particles.min.js"></script>
    <script src="vendor/particles/particles-custom.js"></script>
  </body>

  </html>
    <?php
}
?>
