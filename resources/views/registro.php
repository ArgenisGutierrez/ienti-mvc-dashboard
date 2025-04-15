<!DOCTYPE html>
<html lang="es-MX">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!-- Meta -->
  <link rel="shortcut icon" href="images/favicon.svg" />

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
    <form action="<?php echo APP_URL;?>registro" id="registerForm" method="post" class="needs-validation" novalidate>
      <div class="login-box rounded-2 p-5">
        <div class="login-form">
          <a href="<?php echo APP_URL;?>" class="login-logo mb-3">
            <img src="images/logo.webp" alt="ienti & manwere" />
          </a>
          <h5 class="fw-light mb-5">Registrate para acceder a nuestra plataforma</h5>
          <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input name="nombre" type="email" class="form-control" placeholder="Ingresa tu nombre" required />
          </div>
          <div class="mb-3">
            <label class="form-label">Correo</label>
            <input name="email" type="email" class="form-control" placeholder="Ingresa tu correo" required />
          </div>
          <div class="mb-3">
            <label class="form-label">Contraseña</label>
            <input name="password" id="password" type="password" class="form-control"
              placeholder="Ingresa tu contraseña" required />
          </div>
          <div class="mb-3">
            <label class="form-label">Confirmar contraseña</label>
            <input name="password_confirm" id="password_confirm" type="password" class="form-control"
              placeholder="Confirmar contraseña" required />
            <div class="invalid-feedback" id="password-feedback" style="display: none;">
              Las contraseñas no coinciden
            </div>
          </div>
          <div class="d-flex align-items-center justify-content-between">
            <div class="form-check m-0">
              <input name="terms" class="form-check-input" type="checkbox" value="true" id="termsConditions" required />
              <label class="form-check-label" for="rememberPassword">Estoy de acuerdo con los términos y
                condiciones</label>
            </div>
          </div>
          <div class="d-grid py-3">
            <button type="submit" class="btn btn-lg btn-primary">
              Registrarme
            </button>
          </div>
          <div class="text-center pt-3">
            <span>Ya tienes una cuenta?</span>
            <a href="<?php echo APP_URL;?>login" class="text-blue text-decoration-underline ms-2">Iniciar sesión</a>
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
  <script src="js/registro.js"></script>
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
</body>

</html>
