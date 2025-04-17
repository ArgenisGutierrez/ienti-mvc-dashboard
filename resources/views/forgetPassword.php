<?php
session_start();
if(!empty($_SESSION['usuario_id']) && !empty($_SESSION['nombre'])) {
    session_regenerate_id(true);
    header('Location:'.APP_URL);
    exit();
}else{
    $old_email = $_SESSION['email'] ?? '';
    ?>
<!DOCTYPE html>
<html lang="es-MX">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!-- Meta -->
  <meta name="description" content="Bloom - Responsive Bootstrap 5 Dashboard Template" />
  <meta name="author" content="Bootstrap Gallery" />
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
    <form action="<?php echo APP_URL;?>forgetPassword" autocomplete="off" class="needs-validation" method="post" novalidate>
      <div class="login-box rounded-2 p-5">
        <div class="login-form">
          <a href="https://www.ienti.com.mx" class="login-logo mb-3">
            <img src="images/logo.webp" alt="Logo ienti & manwere" />
          </a>
          <h5 class="fw-light mb-5">Recuperación de contraseña</h5>
          <div class="mb-3">
            <label class="form-label">Correo</label>
            <input id="email_usuario" name="email_usuario" type="email" class="form-control"
              placeholder="Ingresa tu correo" required />
          </div>
          <div class="d-grid py-3">
            <button type="submit" class="btn btn-primary" value="add" name="action">
              Recuperar mi contraseña
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
    <?php Lib\Alert::display();?>
  <!-- Particles JS -->
  <script src="vendor/particles/particles.min.js"></script>
  <script src="vendor/particles/particles-custom.js"></script>
</body>

</html>
    <?php
}
?>
