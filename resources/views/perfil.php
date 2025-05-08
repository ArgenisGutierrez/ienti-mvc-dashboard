<?php

/**
 * Vista de perfil de usuario con gestión de datos, contraseña e imagen
 * 
 * @category Vistas
 * @package  User
 * 
 * @uses \Lib\Alert Para mostrar notificaciones
 * @see  \App\Controllers\UserController Controlador asociado
 * @uses \Layouts\head.php Header común
 * @uses \Layouts\menu.php Menú lateral
 * @uses \Layouts\footer.php Footer común
 * 
 * @var array $usuario Datos del usuario desde controlador
 */
session_start();

// Verificación de sesión activa
if (!empty($_SESSION['usuario_id']) && !empty($_SESSION['nombre'])) {
  session_regenerate_id(true); // Seguridad contra fixation attacks
?>
  <!DOCTYPE html>
  <html lang="es-MX">

  <head>
    <!-- Metadatos comunes -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Título dinámico -->
    <title><?php echo APP_NAME ?></title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo APP_URL; ?>images/icon.ico" />

    <!-- *************
         Hojas de estilo 
         ************* -->
    <!-- Bootstrap core -->
    <link rel="stylesheet" href="<?php echo APP_URL; ?>css/bootstrap.min.css" />

    <!-- Iconos Bootstrap -->
    <link rel="stylesheet" href="<?php echo APP_URL; ?>fonts/bootstrap/bootstrap-icons.css" />

    <!-- Estilos principales -->
    <link rel="stylesheet" href="<?php echo APP_URL; ?>css/main.min.css" />

    <!-- Scrollbar personalizada -->
    <link rel="stylesheet" href="<?php echo APP_URL; ?>vendor/overlay-scroll/OverlayScrollbars.min.css" />

    <!-- Dropzone para uploads -->
    <link rel="stylesheet" href="<?php echo APP_URL; ?>vendor/dropzone/dropzone.min.css" />
  </head>

  <body>
    <!-- Contenedor principal -->
    <div class="page-wrapper">
      <!-- Header -->
      <?php include_once "layouts/head.php"; ?>

      <!-- Contenedor del contenido -->
      <div class="main-container">
        <!-- Menú lateral -->
        <?php include_once "layouts/menu.php"; ?>

        <!-- Sección de perfil -->
        <div class="content-wrapper">
          <div class="subscribe-header">
            <img src="images/bg.png" class="img-fluid w-100" alt="Header" style="max-height: 285px; object-fit: fill;" />
          </div>
          <div class="subscriber-body">
            <!-- Header del perfil -->
            <div class="row align-items-end">
              <div class="col-auto">
                <img src="<?php echo !empty($_SESSION['imagen']) ? 'files/' . $_SESSION['imagen'] : 'images/escudo.png'; ?>"
                  class="img-7xx rounded-circle"
                  alt="Imagen de perfil de <?php echo $usuario['nombre_usuario'] ?>" />
              </div>
              <div class="col">
                <h6><?php echo $usuario['nombre_rol'] ?></h6>
                <h4 class="m-0"><?php echo $usuario['nombre_usuario'] ?></h4>
              </div>
            </div>

            <!-- Sistema de tabs -->
            <div class="custom-tabs-container">
              <ul class="nav nav-tabs" id="customTab2" role="tablist">
                <!-- Tabs -->
                <li class="nav-item" role="presentation">
                  <a class="nav-link active" id="tab-oneA" data-bs-toggle="tab" href="#oneA">Datos Generales</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="tab-twoA" data-bs-toggle="tab" href="#twoA">Cambiar Contraseña</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="tab-threeA" data-bs-toggle="tab" href="#threeA">Cambiar Imagen</a>
                </li>
              </ul>

              <!-- Contenido de los tabs -->
              <div class="tab-content h-350">
                <!-- Tab 1: Datos generales -->
                <div class="tab-pane fade show active" id="oneA" role="tabpanel">
                  <form action="<?php echo APP_URL . 'usuario/' . $usuario['id_usuario']; ?>" method="POST">
                    <!-- Campos ocultos para método PUT -->
                    <input type="hidden" name="_method" value="PUT">
                    <input hidden name="id_usuario" value="<?php echo $usuario['id_usuario'] ?>">

                    <!-- Campos editables -->
                    <div class="row g-3">
                      <div class="col-12 col-sm-6">
                        <div class="mb-3">
                          <label for="fullName" class="form-label">Nombre</label>
                          <input type="text" value="<?php echo $usuario['nombre_usuario'] ?>"
                            name="nombre_usuario" class="form-control" required>
                        </div>
                      </div>
                      <div class="col-12 col-sm-6">
                        <div class="mb-3">
                          <label for="emailId" class="form-label">Email</label>
                          <input type="email" value="<?php echo $usuario['email_usuario'] ?>"
                            name="email_usuario" class="form-control" required>
                        </div>
                      </div>
                      <div class="col-12">
                        <button type="submit" class="btn btn-primary px-4">Guardar</button>
                      </div>
                    </div>
                  </form>
                </div>

                <!-- Tab 2: Cambio de contraseña -->
                <div class="tab-pane fade" id="twoA" role="tabpanel">
                  <form action="<?php echo APP_URL; ?>changePassword" method="post">
                    <input type="hidden" name="token" value="<?php echo $usuario['verification_token'] ?>">

                    <!-- Campos de contraseña -->
                    <div class="mb-3">
                      <label class="form-label">Nueva Contraseña</label>
                      <div class="position-relative">
                        <input name="password" id="password" type="password"
                          class="form-control pe-5" required>
                        <button type="button" class="btn btn-link"
                          onclick="togglePasswordVisibility('password', 'eyeIconPassword')">
                          <i id="eyeIconPassword" class="bi bi-eye-slash"></i>
                        </button>
                      </div>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Confirmar Contraseña</label>
                      <div class="position-relative">
                        <input name="password_confirm" id="password_confirm" type="password"
                          class="form-control pe-5" required>
                        <button type="button" class="btn btn-link"
                          onclick="togglePasswordVisibility('password_confirm', 'eyeIconConfirm')">
                          <i id="eyeIconConfirm" class="bi bi-eye-slash"></i>
                        </button>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Cambiar Contraseña</button>
                  </form>
                </div>

                <!-- Tab 3: Cambio de imagen -->
                <div class="tab-pane fade" id="threeA" role="tabpanel">
                  <form action="<?php echo APP_URL; ?>updateProfileImage" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_usuario" value="<?php echo $usuario['id_usuario'] ?>">
                    <input type="hidden" name="_method" value="PUT">

                    <!-- Upload de imagen -->
                    <div class="text-center">
                      <img id="imagePreview"
                        src="<?php echo !empty($_SESSION['imagen']) ? 'files/' . $_SESSION['imagen'] : 'images/escudo.png'; ?>"
                        class="img-fluid rounded-circle shadow-lg preview-image">
                      <input type="file" name="imagen_usuario" id="profile_image"
                        accept="image/*" hidden onchange="previewImage(this)">
                      <label for="profile_image" class="btn btn-outline-primary mt-3">
                        <i class="bi bi-cloud-upload me-2"></i>Seleccionar imagen
                      </label>
                      <button type="submit" class="btn btn-primary mt-3" id="submitBtn" disabled>
                        Guardar cambios
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Footer -->
        <?php include_once "layouts/footer.php"; ?>
      </div>
    </div>

    <!-- *************
         Scripts 
         ************* -->
    <!-- Dependencias principales -->
    <script src="<?php echo APP_URL; ?>js/jquery.min.js"></script>
    <script src="<?php echo APP_URL; ?>js/bootstrap.bundle.min.js"></script>

    <!-- Validaciones -->
    <script src="<?php echo APP_URL; ?>js/validations.js"></script>

    <!-- Scripts personalizados -->
    <script>
      /**
       * Valida coincidencia de contraseñas antes de enviar formulario
       * @listens submit
       */
      document.getElementById('registerForm').addEventListener('submit', function(e) {
        const [pass1, pass2] = ['password', 'password_confirm'].map(id => document.getElementById(id).value);
        if (pass1 !== pass2) {
          e.preventDefault();
          Swal.fire('Error', 'Las contraseñas no coinciden', 'error');
        }
      });

      /**
       * Previsualiza imagen seleccionada
       * @param {HTMLInputElement} input - Campo de tipo file
       */
      function previewImage(input) {
        const reader = new FileReader();
        reader.onload = function(e) {
          document.getElementById('imagePreview').src = e.target.result;
          document.getElementById('submitBtn').disabled = false;
        }
        if (input.files[0]) reader.readAsDataURL(input.files[0]);
      }

      /**
       * Alterna visibilidad de campos de contraseña
       * @param {string} fieldId - ID del campo de contraseña
       * @param {string} iconId - ID del icono ocular
       */
      function togglePasswordVisibility(fieldId, iconId) {
        const [field, icon] = [document.getElementById(fieldId), document.getElementById(iconId)];
        field.type = field.type === 'password' ? 'text' : 'password';
        icon.classList.toggle('bi-eye-slash');
        icon.classList.toggle('bi-eye');
      }
    </script>
  </body>

  </html>
<?php
} else {
  header('Location:' . APP_URL . 'login');
  exit();
}
?>
