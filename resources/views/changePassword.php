<?php

/**
 * Vista para restablecimiento de contraseña mediante token
 * 
 * @category Vistas
 * @package  Auth
 * 
 * @uses \Lib\Alert Para mostrar notificaciones
 * @see  \App\Controllers\AuthController Controlador asociado
 * 
 * @var string $token Token de verificación para el restablecimiento
 */
?>
<!DOCTYPE html>
<html lang="es-MX">

<head>
  <!-- Metadatos esenciales -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!-- Favicon -->
  <link rel="shortcut icon" href="<?php echo APP_URL; ?>images/icon.ico" />

  <!-- Título dinámico -->
  <title><?php echo APP_NAME ?></title>

  <!-- *************
         Hojas de estilo 
         ************* -->
  <!-- Bootstrap core -->
  <link rel="stylesheet" href="<?php echo APP_URL; ?>css/bootstrap.min.css" />

  <!-- Iconos Bootstrap -->
  <link rel="stylesheet" href="<?php echo APP_URL; ?>fonts/bootstrap/bootstrap-icons.css" />

  <!-- Estilos principales -->
  <link rel="stylesheet" href="<?php echo APP_URL; ?>css/main.min.css" />

  <!-- Efectos de partículas -->
  <link rel="stylesheet" href="<?php echo APP_URL; ?>vendor/particles/particles.css" />
</head>

<body class="login-container">
  <!-- Efecto de partículas background -->
  <div id="particles-js"></div>
  <div class="countdown-bg"></div>

  <!-- Contenedor principal del formulario -->
  <div class="container" style="z-index: 1;">
    <form action="<?php echo APP_URL; ?>changePassword"
      id="registerForm"
      method="post"
      class="needs-validation"
      novalidate
      autocomplete="off">

      <div class="login-box rounded-2 p-5">
        <!-- Cabecera del formulario -->
        <div class="login-form">
          <a href="<?php echo APP_URL; ?>" class="login-logo mb-3">
            <img src="<?php echo APP_URL; ?>images/logo.webp" alt="Logo de la aplicación" />
          </a>
          <h5 class="fw-light mb-5">Restablecer Contraseña</h5>

          <!-- Campo: Nueva Contraseña -->
          <div class="mb-3">
            <label class="form-label">Nueva Contraseña</label>
            <div class="position-relative">
              <input name="password"
                id="password"
                type="password"
                class="form-control pe-5"
                placeholder="Mínimo 8 caracteres"
                required
                minlength="8"
                pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$"
                title="Debe contener al menos una mayúscula, una minúscula y un número">
              <button type="button"
                class="btn btn-link text-decoration-none position-absolute end-0 top-50 translate-middle-y"
                onclick="togglePasswordVisibility('password', 'eyeIconPassword')"
                aria-label="Mostrar/ocultar contraseña">
                <i id="eyeIconPassword" class="bi bi-eye-slash"></i>
              </button>
            </div>
          </div>

          <!-- Campo: Confirmar Contraseña -->
          <div class="mb-3">
            <label class="form-label">Confirmar Contraseña</label>
            <div class="position-relative">
              <input name="password_confirm"
                id="password_confirm"
                type="password"
                class="form-control pe-5"
                placeholder="Repite tu contraseña"
                required>
              <button type="button"
                class="btn btn-link text-decoration-none position-absolute end-0 top-50 translate-middle-y"
                onclick="togglePasswordVisibility('password_confirm', 'eyeIconConfirm')"
                aria-label="Mostrar/ocultar confirmación">
                <i id="eyeIconConfirm" class="bi bi-eye-slash"></i>
              </button>
            </div>
            <input type="hidden" name="token" value="<?php echo $token; ?>">
            <div class="invalid-feedback" id="password-feedback" style="display: none;">
              Las contraseñas no coinciden
            </div>
          </div>

          <!-- Botón de submit -->
          <div class="d-grid py-3">
            <button type="submit" class="btn btn-lg btn-primary">
              Actualizar Contraseña
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
  <script src="<?php echo APP_URL; ?>js/validations.js"></script>

  <!-- SweetAlert2 para notificaciones -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Efectos de partículas -->
  <script src="<?php echo APP_URL; ?>vendor/particles/particles.min.js"></script>
  <script src="<?php echo APP_URL; ?>vendor/particles/particles-custom.js"></script>

  <!-- Scripts personalizados -->
  <script>
    /**
     * Valida coincidencia de contraseñas antes de enviar
     * @listens submit
     */
    document.getElementById('registerForm').addEventListener('submit', function(e) {
      const [pass1, pass2] = ['password', 'password_confirm'].map(id =>
        document.getElementById(id).value
      );

      if (pass1 !== pass2) {
        e.preventDefault();
        Swal.fire({
          icon: 'error',
          title: 'Error de validación',
          text: 'Las contraseñas deben coincidir',
          timer: 2000
        });
        document.getElementById('password_confirm').focus();
      }
    });

    /**
     * Validación en tiempo real de contraseñas
     * @listens input
     */
    document.getElementById('password_confirm').addEventListener('input', function() {
      const pass1 = document.getElementById('password').value;
      const pass2 = this.value;
      const feedback = document.getElementById('password-feedback');

      this.classList.toggle('is-invalid', pass1 !== pass2);
      feedback.style.display = pass1 !== pass2 ? 'block' : 'none';
    });

    /**
     * Alterna la visibilidad de los campos de contraseña
     * @function togglePasswordVisibility
     * @param {string} fieldId - ID del campo
     * @param {string} iconId - ID del icono
     */
    function togglePasswordVisibility(fieldId, iconId) {
      const field = document.getElementById(fieldId);
      const icon = document.getElementById(iconId);

      field.type = field.type === 'password' ? 'text' : 'password';
      icon.classList.toggle('bi-eye-slash');
      icon.classList.toggle('bi-eye');
    }
  </script>
</body>

</html>
