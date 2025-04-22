<?php
session_start();
if(!empty($_SESSION['usuario_id']) && !empty($_SESSION['nombre'])) {
    session_regenerate_id(true);
    ?>
<!DOCTYPE html>
<html lang="es-MX">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>
    <?php echo APP_NAME?>
  </title>

  <link rel="shortcut icon" href="<?php echo APP_URL;?>images/icon.ico" />

  <!-- *************
            ************ Common Css Files *************
        ************ -->
  <!-- Bootstrap css -->
  <link rel="stylesheet" href="<?php echo APP_URL;?>css/bootstrap.min.css" />

  <!-- Bootstrap font icons css -->
  <link rel="stylesheet" href="<?php echo APP_URL;?>fonts/bootstrap/bootstrap-icons.css" />

  <!-- Main css -->
  <link rel="stylesheet" href="<?php echo APP_URL;?>css/main.min.css" />

  <!-- *************
            ************ Vendor Css Files *************
        ************ -->

  <!-- Scrollbar CSS -->
  <link rel="stylesheet" href="<?php echo APP_URL;?>vendor/overlay-scroll/OverlayScrollbars.min.css" />
  <!-- Dropzone CSS -->
  <link rel="stylesheet" href="<?php echo APP_URL;?>vendor/dropzone/dropzone.min.css" />

</head>

<body>
  <!-- Page wrapper start -->
  <div class="page-wrapper">

    <!-- Page header starts -->
    <?php include_once "layouts/head.php";?>
    <!-- Page header ends -->

    <!-- Main container start -->
    <div class="main-container">

      <!-- Sidebar wrapper start -->
      <?php include_once "layouts/menu.php";?>
      <!-- Sidebar wrapper end -->

      <!-- Content wrapper scroll start -->
      <div class="content-wrapper">
        <div class="subscribe-header">
          <img src="images/bg.jpg" class="img-fluid w-100" alt="Header" />
        </div>
        <div class="subscriber-body">
          <!-- Row start -->
          <div class="row justify-content-center mt-4">
            <div class="col-lg-12">
              <!-- Row start -->
              <div class="row align-items-end">
                <div class="col-auto">
                  <img src="images/user7.png" class="img-7xx rounded-circle" />
                </div>
                <div class="col">
                  <h6>
                    <?php echo $usuario['nombre_rol']?>
                  </h6>
                  <h4 class="m-0">
                    <?php echo $usuario['nombre_usuario']?>
                  </h4>
                </div>
              </div>
              <!-- Row end -->
            </div>
          </div>
          <!-- Row end -->

          <!-- Row start -->
          <div class="row justify-content-center mt-4">
            <div class="col-lg-12">
              <div class="card light">
                <div class="card-body">
                  <div class="custom-tabs-container">
                    <ul class="nav nav-tabs" id="customTab2" role="tablist">
                      <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="tab-oneA" data-bs-toggle="tab" href="#oneA" role="tab"
                          aria-controls="oneA" aria-selected="true">Datos Generales</a>
                      </li>
                      <li class="nav-item" role="presentation">
                        <a class="nav-link" id="tab-twoA" data-bs-toggle="tab" href="#twoA" role="tab"
                          aria-controls="twoA" aria-selected="false">Cambiar Contraseña</a>
                      </li>
                    </ul>
                    <div class="tab-content h-350">
                      <div class="tab-pane fade show active" id="oneA" role="tabpanel">
                        <!-- Row start -->
                        <div class="row gx-3">
                          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                            <div id="update-profile" class="mb-3">
                            <form action="<?php echo APP_URL."usuario/". $usuario['id_usuario'];?>" 
                               method="POST" class="dropzone" id="profile-form" enctype="multipart/form-data"> 
                                <input hidden value="<?php echo $usuario['id_usuario']?>" name="id_usuario"></input>
                                <input hidden value="<?php echo $usuario['id_rol']?>" name="id_rol"></input>
                                <input hidden value="<?php echo $usuario['estado']?>" name="estado"></input>
                                <input type="hidden" name="_method" value="PUT">
                                <div class="dz-message needsclick">
                                  <button type="button" class="dz-button">
                                    Subir Imagen
                                  </button>
                                </div>
                            </div>
                          </div>
                          <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12">
                            <div class="row gx-3">
                              <div class="col-6">
                                <!-- Form Field Start -->
                                <div class="mb-3">
                                  <label for="fullName" class="form-label">Nombre</label>
                                  <input type="text" value="<?php echo $usuario['nombre_usuario']?>" name="nombre_usuario" class="form-control" id="fullName" placeholder="Nombre" />
                                </div>
                                <div class="mb-3">
                                  <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                              </div>
                              <div class="col-6">
                                <!-- Form Field Start -->
                                <div class="mb-3">
                                  <label for="emailId" class="form-label">Email</label>
                                  <input type="email" value="<?php echo $usuario['email_usuario']?>" name="email_usuario" class="form-control" id="emailId" placeholder="Email ID" />
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        </form>
                        <!-- Row end -->
                      </div>
                      <div class="tab-pane fade" id="twoA" role="tabpanel">
                        <div class="card-body">
                          <!-- Row start -->
                          <div class="row gx-3">
                            <div class="col-md-12 col-sm-12 xol-12">
                              <!-- Card start -->
                              <div class="card">
                                <div class="card-body">
                                <form action="<?php echo APP_URL;?>changePassword" id="registerForm" method="post" class="needs-validation" novalidate>
                                    <input type="hidden" name="token" value="<?php echo $usuario['verification_toke']?>">
                                    <div class="login-box rounded-2 p-5">
                                      <div class="login-form">
                                        <div class="mb-3">
                                          <label class="form-label">Contraseña</label>
                                          <div class="position-relative">
                                            <input name="password" id="password" type="password"
                                              class="form-control pe-5" placeholder="Ingresa tu contraseña" required />
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
                                            <input name="password_confirm" id="password_confirm" type="password"
                                              class="form-control pe-5" placeholder="Confirmar contraseña" required />
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
                            </div>
                            <!-- Card end -->
                          </div>
                        </div>
                        <!-- Row end -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Row end -->
      </div>
    </div>
    <!-- Content wrapper scroll end -->

    <!-- App Footer start -->
    <?php include_once "layouts/footer.php";?>
    <!-- App footer end -->

  </div>
  <!-- Main container end -->

  </div>
  <!-- Page wrapper end -->

  <!-- *************
            ************ Required JavaScript Files *************
        ************* -->
  <!-- Required jQuery first, then Bootstrap Bundle JS -->
  <script src="<?php echo APP_URL;?>js/jquery.min.js"></script>
  <script src="<?php echo APP_URL;?>js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo APP_URL;?>js/modernizr.js"></script>
  <script src="<?php echo APP_URL;?>js/moment.js"></script>

  <!-- *************
            ************ Vendor Js Files *************
        ************* -->

  <!-- Overlay Scroll JS -->
  <script src="<?php echo APP_URL;?>vendor/overlay-scroll/jquery.overlayScrollbars.min.js"></script>
  <script src="<?php echo APP_URL;?>vendor/overlay-scroll/custom-scrollbar.js"></script>

  <!-- News ticker -->
  <script src="<?php echo APP_URL;?>vendor/newsticker/newsTicker.min.js"></script>
  <script src="<?php echo APP_URL;?>vendor/newsticker/custom-newsTicker.js"></script>

  <!-- Apex Charts -->
  <script src="<?php echo APP_URL;?>vendor/apex/apexcharts.min.js"></script>
  <script src="<?php echo APP_URL;?>vendor/apex/custom/dash1/analytics.js"></script>
  <script src="<?php echo APP_URL;?>vendor/apex/custom/dash1/visitors.js"></script>
  <script src="<?php echo APP_URL;?>vendor/apex/custom/dash1/income.js"></script>
  <script src="<?php echo APP_URL;?>vendor/apex/custom/dash1/orders.js"></script>
  <script src="<?php echo APP_URL;?>vendor/apex/custom/dash1/sales.js"></script>
  <script src="<?php echo APP_URL;?>vendor/apex/custom/dash1/sparkline.js"></script>
  <script src="<?php echo APP_URL;?>vendor/apex/custom/dash1/conversion.js"></script>

  <!-- Dropzone JS -->
  <script src="<?php echo APP_URL;?>vendor/dropzone/dropzone.min.js"></script>
  <!-- validations -->
  <script src="<?php echo APP_URL;?>js/validations.js"></script>
  <!-- sweetalert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <?php Lib\Alert::display();?>

  <!-- Main Js Required -->
  <script src="<?php echo APP_URL;?>js/main.js"></script>
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
    <?php
}else{
    header('Location:'.APP_URL.'login');
    exit();
}
?>
