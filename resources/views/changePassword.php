<!DOCTYPE html>
<html lang="es-MX">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!-- Meta -->
  <link rel="shortcut icon" href="images/icon.ico" />

  <!-- Title -->
  <title>
    <?php echo APP_NAME?>
  </title>

  <!-- *************
            ************ Common Css Files *************
        ************ -->
  <!-- Bootstrap css -->
  <link rel="stylesheet" href="css/bootstrap.min.css" />

  <!-- Bootstrap font icons css -->
  <link rel="stylesheet" href="fonts/bootstrap/bootstrap-icons.css" />

  <!-- Main css -->
  <link rel="stylesheet" href="css/main.min.css" />

  <!-- Login css -->
  <link rel="stylesheet" href="css/login.css" />
  <!-- Particles CSS -->
  <link rel="stylesheet" href="vendor/particles/particles.css" />
</head>

<body class="login-container">
  <div id="particles-js"></div>
  <div class="countdown-bg"></div>
  <!-- Login box start -->
  <div class="container" style="z-index: 1;">
    <form action="<?php echo APP_URL;?>changePassword" id="registerForm" method="post" class="needs-validation" novalidate>
      <div class="login-box rounded-2 p-5">
        <div class="login-form">
          <a href="<?php echo APP_URL;?>" class="login-logo mb-3">
            <img src="images/logo.webp" alt="ienti & manwere" />
          </a>
          <h5 class="fw-light mb-5">Introduce tu nueva contraseña</h5>
          <div class="mb-3">
            <label class="form-label">Contraseña</label>
            <div class="position-relative">
              <input name="password" id="password" type="password" class="form-control pe-5"
                placeholder="Ingresa tu contraseña" required />
              <button type="button"
                class="btn btn-link text-decoration-none position-absolute end-0 top-50 translate-middle-y"
                onclick="togglePasswordVisibility('password', 'eyeIconPassword')"
                style="transform: translateY(-50%) !important;">
                <i id="eyeIconPassword" class="bi bi-eye-slash"></i>
              </button>
            </div>
          </div>

          <!-- Campo de confirmación modificado -->
          <div class="mb-3">
            <label class="form-label">Confirmar contraseña</label>
            <div class="position-relative">
              <input name="password_confirm" id="password_confirm" type="password" class="form-control pe-5"
                placeholder="Confirmar contraseña" required />
              <button type="button"
                class="btn btn-link text-decoration-none position-absolute end-0 top-50 translate-middle-y"
                onclick="togglePasswordVisibility('password_confirm', 'eyeIconConfirm')"
                style="transform: translateY(-50%) !important;">
                <i id="eyeIconConfirm" class="bi bi-eye-slash"></i>
              </button>
            </div>
            <input type="hidden" name="token" value="<?php echo $token; ?>">
            <div class="invalid-feedback" id="password-feedback" style="display: none;">
              Las contraseñas no coinciden
            </div>
          </div>
        </div>
        <div class="d-grid py-3">
          <button type="submit" class="btn btn-lg btn-primary">
            Cambiar Contraseña
          </button>
        </div>
      </div>
  </div>
  </form>
  </div>
  <!-- Login box end -->
  <!-- validations -->
  <script src="js/validations.js"></script>
  <!-- sweetalert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Particles JS -->
  <script src="vendor/particles/particles.min.js"></script>
  <script src="vendor/particles/particles-custom.js"></script>
  <script>
    document.getElementById('registerForm').addEventListener('submit', function (e) {
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

    // Validación en tiempo real
    document.getElementById('password_confirm').addEventListener('input', function () {
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
  </script>
  <script>
    function togglePasswordVisibility(fieldId, iconId) {
      const passwordInput = document.getElementById(fieldId);
      const eyeIcon = document.getElementById(iconId);

      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.classList.remove('bi-eye-slash');
        eyeIcon.classList.add('bi-eye');
      } else {
        passwordInput.type = 'password';
        eyeIcon.classList.remove('bi-eye');
        eyeIcon.classList.add('bi-eye-slash');
      }
    }
  </script>
  <style>
    /* Estilos mejorados */
    .bi-eye-slash,
    .bi-eye {
      font-size: 1.2rem;
      color: #6c757d;
      cursor: pointer;
      padding-right: 12px;
    }

    .position-absolute {
      right: 5px;
      z-index: 2;
    }

    .form-control.pe-5 {
      padding-right: 2.5rem !important;
    }
  </style>
</body>

</html>
