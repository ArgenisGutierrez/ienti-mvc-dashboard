<?php
session_start();
if (!empty($_SESSION['usuario_id']) && !empty($_SESSION['nombre'])) {
    session_regenerate_id(true);
    ?>
  <!DOCTYPE html>
  <html lang="es-MX">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>
      <?php echo APP_NAME; ?>
    </title>

    <!-- Meta -->
    <link rel="shortcut icon" href="images/icon.ico" />

    <!-- *************
            ************ Common Css Files *************
        ************ -->
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />

    <!-- Bootstrap font icons css -->
    <link rel="stylesheet" href="fonts/bootstrap/bootstrap-icons.css" />

    <!-- Main css -->
    <link rel="stylesheet" href="css/main.min.css" />

    <!-- *************
            ************ Vendor Css Files *************
        ************ -->

    <!-- Scrollbar CSS -->
    <link rel="stylesheet" href="vendor/overlay-scroll/OverlayScrollbars.min.css" />
    <!-- Data Tables -->
    <link rel="stylesheet" href="vendor/datatables/dataTables.bs5.css" />
    <link rel="stylesheet" href="vendor/datatables/dataTables.bs5-custom.css" />
  </head>

  <body>


    <!-- Page wrapper start -->
    <div class="page-wrapper">

      <!-- Page header starts -->
      <?php include_once 'layouts/head.php'; ?>
      <!-- Page header ends -->

      <!-- Main container start -->

      <div class="main-container">

        <!-- Sidebar wrapper start -->
        <?php include_once 'layouts/menu.php'; ?>
        <!-- Sidebar wrapper end -->
        <!-- Content wrapper scroll start -->
        <div class="content-wrapper-scroll">

          <!-- Main header starts -->
          <div class="main-header d-flex align-items-center justify-content-between position-relative">
            <div class="d-flex align-items-center justify-content-center">
              <div class="page-icon">
                <i class="bi bi-person-video2"></i>
              </div>
              <div class="page-title d-none d-md-block">
                <h5>Usuarios
                </h5>
              </div>
            </div>
            <!-- Live updates start -->
            <!-- Live updates end -->
          </div>

          <!-- Main header ends -->

          <!-- Main container start -->
          <div class="content-wrapper">

            <!-- Row start -->
            <div class="row gx-3">
              <div class="col-xl-12">
                <div class="card">
                  <div class="card-header card-header-button">
                    <div class="card-title">Usuarios:</div>
                    <div class="card-header">
                      <div class="card-title">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarRole">
                          + Usuario
                        </button>
                        <!--Modal-->
                        <div class="modal fade" id="agregarRole" tabindex="-1" aria-labelledby="exampleModalLabel"
                          aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">
                                  Nuevo Usuario
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <form action="<?php echo APP_URL; ?>usuarios" id="usuario_form" method="post"
                                  autocomplete="off" class="row g-3 needs-validation" novalidate>
                                  <div class="col-md-12">
                                    <label for="nombre_usuario" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario"
                                      required />
                                  </div>
                                  <div class="col-md-12">
                                    <label for="password_usuario" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password_usuario"
                                      name="password_usuario" required />
                                  </div>
                                  <div class="col-md-12">
                                    <label for="password_usuario2" class="form-label">Repetir Password</label>
                                    <input type="password" class="form-control" id="password_usuario2"
                                      name="password_usuario2" required />
                                    <div class="invalid-feedback" id="password-feedback" style="display: none;">
                                      Las contraseñas no coinciden
                                    </div>
                                  </div>
                                  <div class="col-md-12">
                                    <label for="email_usuario" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email_usuario" name="email_usuario"
                                      required />
                                  </div>
                                  <div class="col-md-12">
                                    <label for="validationCustom04" class="form-label">Role</label>
                                    <!-- Agrega el atributo name -->
                                    <select class="form-select" id="validationCustom04" name="id_rol" required>
                                      <option selected disabled value="">Asignar...</option>
                                      <?php foreach ($roles as $role) { ?>
                                        <option value="<?php echo $role['id_rol'] ?>">
                                            <?php echo $role['nombre_rol'] ?>
                                        </option>
                                      <?php } ?>
                                    </select>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" value="add" name="action">
                                      Guardar
                                    </button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="usuarios_table" class="table table-hover custom-table">
                        <thead>
                          <tr>
                            <th>Nombre</th>
                            <th>Role</th>
                            <th>Email</th>
                            <th>Feacha de Creación</th>
                            <th>Estado</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($usuarios as $usuario) { ?>
                            <tr>
                              <td>
                                <?php echo $usuario['nombre_usuario'] ?>
                              </td>
                              <td>
                                <?php echo $usuario['nombre_rol'] ?>
                              </td>
                              <td>
                                <?php echo $usuario['email_usuario'] ?>
                              </td>
                              <td>
                                <?php echo $usuario['fyh_creacion'] ?>
                              </td>
                              <td>
                                <?php if ($usuario['estado'] == 1) {
                                    echo "Activo";
                                } else {
                                    echo "Desactivado";
                                } ?>
                              </td>
                              <td>
                                <!-- Botón que abre el modal específico para cada registro -->
                                <button type="button" class="btn btn-primary editar-btn" data-bs-toggle="modal"
                                  data-bs-target="#editarRole<?php echo $usuario['id_usuario'] ?>">
                                  <i class="bi bi-pencil-fill"></i>
                                </button>
                                <!-- Modal único para cada registro -->
                                <div class="modal fade" id="editarRole<?php echo $usuario['id_usuario'] ?>" tabindex="-1"
                                  aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">
                                          Editar
                                          <?php echo $usuario['nombre_usuario'] ?>
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                          aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                        <form action="<?php echo APP_URL; ?>usuarios/<?php echo $usuario['id_usuario'] ?>"
                                          method="post" autocomplete="off" class="row g-3 needs-validation" novalidate>
                                          <!-- Campo oculto para el ID -->
                                          <input type="hidden" name="_method" value="PUT">

                                          <div class="col-md-12">
                                            <label for="nombre_usuario" class="form-label">Nombre</label>
                                            <input value="<?php echo $usuario['nombre_usuario']; ?>" type="text"
                                              class="form-control" id="nombre_usuario" name="nombre_usuario" required />
                                          </div>
                                          <div class="col-md-12">
                                            <label for="email_usuario" class="form-label">Email</label>
                                            <input value="<?php echo $usuario['email_usuario']; ?>" type="email"
                                              class="form-control" id="email_usuario" name="email_usuario" required />
                                          </div>
                                          <div class="col-md-12">
                                            <label for="validationCustom04" class="form-label">Role</label>
                                            <select name="id_rol" class="form-select" id="validationCustom04" required>
                                              <option disabled value="">Asignar...</option>
                                              <?php foreach ($roles as $role): ?>
                                                <option value="<?php echo $role['id_rol'] ?>" <?php echo ($role['id_rol'] == $usuario['id_rol']) ? 'selected' : '' ?>>
                                                    <?php echo $role['nombre_rol'] ?>
                                                </option>
                                              <?php endforeach; ?>
                                            </select>
                                          </div>

                                          <div class="col-md-12">
                                            <label for="validationCustom04" class="form-label">Estado</label>
                                            <select name="estado" class="form-select" id="validationCustom04" required>
                                              <option disabled value="">Asignar...</option>
                                              <option value="1" <?php echo ($usuario['estado'] == 1) ? 'selected' : '' ?>>Activo
                                              </option>
                                              <option value="0" <?php echo ($usuario['estado'] == 0) ? 'selected' : '' ?>>Desactivado</option>
                                            </select>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                          </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </td>
                              <td>
                                <!-- Formulario para eliminar -->
                                <form id="formEliminar<?php echo $usuario['id_usuario'] ?>" method="POST"
                                  action="<?php echo APP_URL; ?>usuarios/<?php echo $usuario['id_usuario'] ?>">
                                  <input type="hidden" name="_method" value="DELETE">
                                  <button type="submit" class="btn btn-danger">
                                    <i class="bi bi-trash-fill"></i>
                                  </button>
                                </form>
                              </td>
                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Row end -->

          </div>
          <!-- Main container end -->

        </div>
        <!-- Page wrapper end -->

        <!-- *************
            ************ Required JavaScript Files *************
        ************* -->
        <!-- Required jQuery first, then Bootstrap Bundle JS -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/modernizr.js"></script>
        <script src="js/moment.js"></script>

        <!-- *************
            ************ Vendor Js Files *************
        ************* -->

        <!-- Overlay Scroll JS -->
        <script src="vendor/overlay-scroll/jquery.overlayScrollbars.min.js"></script>
        <script src="vendor/overlay-scroll/custom-scrollbar.js"></script>

        <!-- News ticker -->
        <script src="vendor/newsticker/newsTicker.min.js"></script>
        <script src="vendor/newsticker/custom-newsTicker.js"></script>

        <!-- Data Tables -->
        <script src="vendor/datatables/dataTables.min.js"></script>
        <script src="vendor/datatables/dataTables.bootstrap.min.js"></script>
        <script src="vendor/datatables/custom/custom-datatables.js"></script>

        <!-- validations -->
        <script src="js/validations.js"></script>
        <!-- Main Js Required -->
        <script src="js/main.js"></script>

        <!-- sweetalert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script src="js/usuarios.js"></script>
        <script>
          $(document).on('submit', 'form[id^="formEliminar"]', function(e) {
            console.log("Formulario enviado"); // ¿Aparece esto en la consola?
            e.preventDefault();
            const form = this;

            Swal.fire({
              title: "¿Eliminar Usuario?",
              text: "¡Esta acción no se puede deshacer!",
              icon: "warning",
              showCancelButton: true,
              confirmButtonColor: "#d33",
              cancelButtonColor: "#3085d6",
              confirmButtonText: "Sí, eliminar",
              cancelButtonText: "Cancelar"
            }).then((result) => {
              if (result.isConfirmed) {
                form.submit();
              }
            });
          });
        </script>
        <?php Lib\Alert::display(); ?>
        <script>
          $(function() {
            // Destruir instancia previa si existe
            if ($.fn.DataTable.isDataTable('#usuarios_table')) {
              $('#usuarios_table').DataTable().destroy();
            }

            // Configuración de columnas
            var columnDefs = [{
              targets: [0, 1, 2, 3, 4],
              width: "19%", // Corregido: "width" en vez de "with"
              orderable: true,
              searchable: true,
              className: "columna-descripcion"
            }];

            // Condicionales para columnas adicionales
            <?php if (isset($_SESSION['permisos']) && in_array("Editar Usuarios", $_SESSION['permisos'])) : ?>
              columnDefs.push({
                targets: 5,
                orderable: false,
                searchable: false,
                className: "columna-botones"
              });
            <?php endif; ?>

            <?php if (isset($_SESSION['permisos']) && in_array("Eliminar Usuarios", $_SESSION['permisos'])) : ?>
              columnDefs.push({
                targets: <?php echo (in_array("Editar Usuarios", $_SESSION['permisos'])) ? 6 : 5; ?>,
                orderable: false,
                searchable: false,
                className: "columna-botones"
              });
            <?php endif; ?>

            // Inicialización de DataTable
            $('#usuarios_table').DataTable({
              columnDefs: columnDefs,
              autoWidth: false,
              language: {
                emptyTable: "No hay información",
                info: "Mostrando _START_ a _END_ de _TOTAL_ Usuarios",
                infoEmpty: "Mostrando 0 a 0 de 0 Usuarios",
                infoFiltered: "(Filtrado de _MAX_ total Usuarios)",
                lengthMenu: "Mostrar _MENU_ Usuarios",
                loadingRecords: "Cargando...",
                processing: "Procesando...",
                search: "Buscador:",
                zeroRecords: "Sin resultados encontrados",
                paginate: {
                  first: "Primero",
                  last: "Último",
                  next: "Siguiente",
                  previous: "Anterior"
                }
              }
            });
          });
        </script>
  </body>

  </html>

    <?php
} else {
    header('Location:' . APP_URL . 'login');
    exit();
}
?>
