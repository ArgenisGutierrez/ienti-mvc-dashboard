<?php

/**
 * Vista de registro de nuevos usuarios
 * 
 * @category Vistas
 * @package  Auth
 * 
 * @uses \Lib\Alert Para mostrar notificaciones
 * @see  \App\Controllers\AuthController Controlador asociado
 * 
 * @var string $APP_NAME Nombre de la aplicación desde configuración
 * @var string $APP_URL URL base de la aplicación
 */
?>
<!DOCTYPE html>
<html lang="es-MX">

<head>
  <!-- Metadatos esenciales -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!-- Favicon -->
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
    <form action="<?php echo APP_URL; ?>registro"
      id="registerForm"
      method="post"
      class="needs-validation"
      novalidate
      autocomplete="off">

      <div class="login-box rounded-2 p-5">
        <!-- Cabecera del formulario -->
        <div class="login-form">
          <a href="<?php echo APP_URL; ?>" class="login-logo mb-3">
            <img src="images/logo.webp" alt="Logo ienti & manwere" />
          </a>
          <h5 class="fw-light mb-5">Regístrate para acceder a nuestra plataforma</h5>

          <!-- Campo: Nombre -->
          <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input name="nombre"
              type="text"
              class="form-control"
              placeholder="Ingresa tu nombre"
              required
              pattern="[A-Za-zá-úÁ-ÚñÑ\s]{3,50}"
              title="Solo letras y espacios (3-50 caracteres)">
          </div>

          <!-- Campo: Email -->
          <div class="mb-3">
            <label class="form-label">Correo</label>
            <input name="email"
              type="email"
              class="form-control"
              placeholder="Ingresa tu correo"
              required
              pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
          </div>

          <!-- Campo: Contraseña con toggle -->
          <div class="mb-3">
            <label class="form-label">Contraseña</label>
            <div class="position-relative">
              <input name="password"
                id="password"
                type="password"
                class="form-control pe-5"
                placeholder="Ingresa tu contraseña"
                required
                minlength="8"
                pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$"
                title="Mínimo 8 caracteres, 1 mayúscula, 1 minúscula y 1 número">
              <button type="button"
                class="btn btn-link text-decoration-none position-absolute end-0 top-50 translate-middle-y"
                onclick="togglePasswordVisibility('password', 'eyeIconPassword')"
                aria-label="Mostrar/ocultar contraseña">
                <i id="eyeIconPassword" class="bi bi-eye-slash"></i>
              </button>
            </div>
          </div>

          <!-- Campo: Confirmación de contraseña -->
          <div class="mb-3">
            <label class="form-label">Confirmar contraseña</label>
            <div class="position-relative">
              <input name="password_confirm"
                id="password_confirm"
                type="password"
                class="form-control pe-5"
                placeholder="Confirmar contraseña"
                required>
              <button type="button"
                class="btn btn-link text-decoration-none position-absolute end-0 top-50 translate-middle-y"
                onclick="togglePasswordVisibility('password_confirm', 'eyeIconConfirm')"
                aria-label="Mostrar/ocultar confirmación">
                <i id="eyeIconConfirm" class="bi bi-eye-slash"></i>
              </button>
            </div>
            <div class="invalid-feedback" id="password-feedback" style="display: none;">
              Las contraseñas no coinciden
            </div>
          </div>

          <!-- Términos y condiciones -->
          <div class="d-flex align-items-center justify-content-between">
            <div class="form-check m-0">
              <input name="terms"
                class="form-check-input"
                type="checkbox"
                value="true"
                id="termsConditions"
                required />
              <label class="form-check-label" for="termsConditions">
                Acepto los <a href="<?php echo APP_URL; ?>terminos" class="text-primary">términos y condiciones</a>
              </label>
            </div>
          </div>

          <!-- Botón de submit -->
          <div class="d-grid py-3">
            <button type="submit" class="btn btn-lg btn-primary">
              Registrarme
            </button>
          </div>

          <!-- Enlace a login -->
          <div class="text-center pt-3">
            <span>¿Ya tienes cuenta?</span>
            <a href="<?php echo APP_URL; ?>login" class="text-blue text-decoration-underline ms-2">
              Iniciar sesión
            </a>
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

  <!-- Efectos de partículas -->
  <script src="vendor/particles/particles.min.js"></script>
  <script src="vendor/particles/particles-custom.js"></script>

  <!-- Scripts personalizados -->
  <script>
    /**
     * Valida coincidencia de contraseñas antes de enviar formulario
     * @listens submit
     */
    document.getElementById('registerForm').addEventListener('submit', function(e) {
      const pass1 = document.getElementById('password').value;
      const pass2 = document.getElementById('password_confirm').value;

      if (pass1 !== pass2) {
        e.preventDefault();
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Las contraseñas no coinciden',
          timer: 1500
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

      if (pass1 !== pass2) {
        this.classList.add('is-invalid');
        feedback.style.display = 'block';
      } else {
        this.classList.remove('is-invalid');
        feedback.style.display = 'none';
      }
    });

    /**
     * Alterna la visibilidad del campo de contraseña
     * @function togglePasswordVisibility
     * @param {string} fieldId - ID del campo de contraseña
     * @param {string} iconId - ID del icono ocular
     */
    function togglePasswordVisibility(fieldId, iconId) {
      const passwordInput = document.getElementById(fieldId);
      const eyeIcon = document.getElementById(iconId);

      passwordInput.type = passwordInput.type === 'password' ? 'text' : 'password';
      eyeIcon.classList.toggle('bi-eye-slash');
      eyeIcon.classList.toggle('bi-eye');
    }
  </script>
</body>

</html>
