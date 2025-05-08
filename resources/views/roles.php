<?php

/**
 * Vista de administración de roles y permisos
 * 
 * @category Vistas
 * @package  Auth
 * 
 * @uses \Lib\Alert Para mostrar notificaciones
 * @see  \App\Controllers\RoleController Controlador asociado
 * 
 * @var array $roles Listado de roles desde controlador
 * @var array $permisos Listado completo de permisos disponibles
 */
session_start();
if (!empty($_SESSION['usuario_id']) && !empty($_SESSION['nombre'])) {
  session_regenerate_id(true);
?>
  <!DOCTYPE html>
  <html lang="es-MX">

  <head>
    <!-- Meta -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Titulo Dinamico -->
    <title>
      <?php echo APP_NAME; ?>
    </title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="images/icon.ico" />

    <!-- *************
         Hojas de estilo 
         ************* -->
    <!-- Bootstrap core -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />

    <!-- Bootstrap font icons css -->
    <link rel="stylesheet" href="fonts/bootstrap/bootstrap-icons.css" />

    <!-- Main css -->
    <link rel="stylesheet" href="css/main.min.css" />

    <!-- *************
        Vendor Css Files 
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
      <?php include_once "layouts/head.php"; ?>
      <!-- Page header ends -->

      <!-- Main container start -->
      <div class="main-container">

        <!-- Sidebar wrapper start -->
        <?php include_once "layouts/menu.php"; ?>
        <!-- Sidebar wrapper end -->

        <!-- Content wrapper scroll start -->
        <div class="content-wrapper-scroll">

          <!-- Main header starts -->
          <div class="main-header d-flex align-items-center justify-content-between position-relative">
            <div class="d-flex align-items-center justify-content-center">
              <div class="page-icon">
                <i class="bi bi-file-earmark-lock2-fill"></i>
              </div>
              <div class="page-title d-none d-md-block">
                <h5>Roles
                </h5>
              </div>
            </div>
            <!-- Live updates start -->
            <!-- Live updates end -->
          </div>
          <!-- Main header ends -->

          <!-- Content wrapper start -->
          <div class="content-wrapper">


            <!-- Row start -->
            <div class="row gx-3">
              <div class="col-xl-12">
                <div class="card">
                  <div class="card-header card-header-button">
                    <div class="card-title">Roles:</div>
                    <div class="card-header">
                      <div class="card-title">
                        <?php if (isset($_SESSION['permisos']) && in_array("Crear Roles", $_SESSION['permisos'])) : ?>
                          <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#agregarRole">
                            + Role
                          </button>
                        <?php endif; ?>
                        <!--Modal-->
                        <div class="modal fade" id="agregarRole" tabindex="-1" aria-labelledby="exampleModalLabel"
                          aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">
                                  Nuevo Role
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                  aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <form action="<?php echo APP_URL; ?>roles" id="role_form" method="post" autocomplete="off"
                                  class="needs-validation" novalidate>
                                  <div class="modal-body">
                                    <!-- Campo Nombre -->
                                    <div class="mb-4">
                                      <label for="nombre_rol" class="form-label">Nombre del Rol</label>
                                      <input type="text" class="form-control form-control-lg" id="nombre_rol"
                                        name="nombre_rol" required>
                                    </div>

                                    <!-- Sección de Permisos -->
                                    <div class="border-top pt-3">
                                      <h6 class="mb-3">Seleccionar permisos:</h6>

                                      <div class="row g-3 overflow-auto" style="max-height: 300px;">
                                        <?php foreach ($permisos as $permiso): ?>
                                          <div class="col-md-6">
                                            <div class="card shadow-sm h-100">
                                              <div class="card-body p-3 d-flex align-items-start">
                                                <div class="form-check flex-shrink-0 mt-1">
                                                  <input class="form-check-input" type="checkbox" name="permisos[]"
                                                    value="<?php echo $permiso['id_permiso']; ?>"
                                                    id="permiso_<?php echo $permiso['id_permiso']; ?>">
                                                </div>

                                                <label class="form-check-label ms-2 w-100"
                                                  for="permiso_<?php echo $permiso['id_permiso']; ?>">
                                                  <span class="d-block fw-bold">
                                                    <?php echo htmlspecialchars($permiso['nombre_permiso']); ?>
                                                  </span>
                                                  <small class="text-muted d-block">
                                                    <?php echo htmlspecialchars($permiso['descripcion_permiso']); ?>
                                                  </small>
                                                </label>
                                              </div>
                                            </div>
                                          </div>
                                        <?php endforeach; ?>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                      data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary">Guardar</button>
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
                      <table id="role_table" class="table table-hover custom-table">
                        <thead>
                          <tr>
                            <th>Nombre</th>
                            <?php if (isset($_SESSION['permisos']) && in_array("Editar Roles", $_SESSION['permisos'])) : ?>
                              <th>Editar</th>
                            <?php endif; ?>
                            <?php if (isset($_SESSION['permisos']) && in_array("Eliminar Roles", $_SESSION['permisos'])) : ?>
                              <th>Eliminar</th>
                            <?php endif; ?>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($roles as $rol) { ?>
                            <tr>
                              <td>
                                <?php echo $rol['nombre_rol'] ?>
                              </td>
                              <?php if (isset($_SESSION['permisos']) && in_array("Editar Roles", $_SESSION['permisos'])) : ?>
                                <td>
                                  <!-- Botón que abre el modal específico para cada registro -->
                                  <button type="button" class="btn btn-primary editar-btn" data-bs-toggle="modal"
                                    data-bs-target="#editarRole<?php echo $rol['id_rol'] ?>">
                                    <i class="bi bi-pencil-fill"></i>
                                  </button>
                                  <!-- Modal único para cada registro -->
                                  <div class="modal fade" id="editarRole<?php echo $rol['id_rol'] ?>" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">
                                            Editar
                                            <?php echo $rol['nombre_rol'] ?>
                                          </h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                          <form action="<?php echo APP_URL; ?>roles/<?php echo $rol['id_rol'] ?>"
                                            id="role_form" method="post" autocomplete="off" class="needs-validation"
                                            novalidate>
                                            <input type="hidden" name="_method" value="PUT">

                                            <div class="modal-body">
                                              <!-- Campo Nombre -->
                                              <div class="mb-4">
                                                <label for="nombre_rol" class="form-label">Nombre del Rol</label>
                                                <input type="text" class="form-control form-control-lg" name="nombre_rol"
                                                  value="<?php echo htmlspecialchars($rol['nombre_rol']) ?>" required>
                                              </div>

                                              <!-- Sección de Permisos -->
                                              <div class="border-top pt-3">
                                                <h6 class="mb-3">Permisos asignados:</h6>

                                                <div class="row g-3 overflow-auto" style="max-height: 300px;">
                                                  <?php foreach ($permisos as $permiso): ?>
                                                    <div class="col-md-6">
                                                      <div class="card shadow-sm h-100">
                                                        <div class="card-body p-3 d-flex align-items-start">
                                                          <div class="form-check flex-shrink-0 mt-1">
                                                            <input class="form-check-input" type="checkbox" name="permisos[]"
                                                              value="<?php echo $permiso['id_permiso']; ?>" <?php if (
                                                                                                              isset($rol['permisos']) && in_array(
                                                                                                                $permiso['id_permiso'],
                                                                                                                $rol['permisos']
                                                                                                              )
                                                                                                            ) {
                                                                                                              echo 'checked';
                                                                                                            } ?>
                                                              id="permiso_
                                                        <?php echo $permiso['id_permiso']; ?>">
                                                          </div>

                                                          <label class="form-check-label ms-2 w-100"
                                                            for="permiso_<?php echo $permiso['id_permiso']; ?>">
                                                            <span class="d-block fw-bold">
                                                              <?php echo htmlspecialchars($permiso['nombre_permiso']); ?>
                                                            </span>
                                                            <small class="text-muted d-block">
                                                              <?php echo htmlspecialchars($permiso['descripcion_permiso']); ?>
                                                            </small>
                                                          </label>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  <?php endforeach; ?>
                                                </div>
                                              </div>
                                            </div>

                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cerrar</button>
                                              <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                            </div>
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </td>
                              <?php endif; ?>
                              <?php if (isset($_SESSION['permisos']) && in_array("Eliminar Roles", $_SESSION['permisos'])) : ?>
                                <td>
                                  <!-- Formulario para eliminar -->
                                  <form id="formEliminar<?php echo $rol['id_rol'] ?>" method="POST"
                                    action="<?php echo APP_URL; ?>roles/<?php echo $rol['id_rol'] ?>">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="id_rol" value="<?php echo $rol['id_rol'] ?>">
                                    <button type="submit" class="btn btn-danger">
                                      <i class="bi bi-trash-fill"></i>
                                    </button>
                                  </form>
                                </td>
                              <?php endif; ?>
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
          <!-- Content wrapper end -->

        </div>
        <!-- Content wrapper scroll end -->

        <!-- App Footer start -->
        <div class="app-footer">
          <span>© ienti & manwere</span>
        </div>
        <!-- App footer end -->

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

    <!-- Lib Alert -->
    <?php Lib\Alert::display(); ?>

    <!-- *************
         Scripts 
         ************* -->
    <script>
      /**
       * Confirmación de eliminación con SweetAlert2
       * @listens submit
       */
      $(document).on('submit', 'form[id^="formEliminar"]', function(e) {
        console.log("Formulario enviado"); // ¿Aparece esto en la consola?
        e.preventDefault();
        const form = this;

        Swal.fire({
          title: "¿Eliminar rol?",
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
    <script>
      /**
       * Configuración de DataTable para roles
       * @function
       */
      $(function() {
        $('#role_table').DataTable({
          columnDefs: [{
              targets: [0],
              width: "80%",
              orderable: true,
              searchable: true,
              className: "columna-descripcion"
            }
            <?php if (isset($_SESSION['permisos']) && in_array("Editar Roles", $_SESSION['permisos'])) : ?>, {
                targets: [1],
                orderable: false,
                searchable: false,
                className: "columna-botones"
              }
            <?php endif; ?>
            <?php if (isset($_SESSION['permisos']) && in_array("Eliminar Roles", $_SESSION['permisos'])) : ?>, {
                targets: [<?php echo (in_array("Editar Roles", $_SESSION["permisos"])) ? 2 : 1; ?>],
                orderable: false,
                searchable: false,
                className: "columna-botones"
              }
            <?php endif; ?>
          ],
          autoWidth: false,
          language: {
            emptyTable: "No hay información",
            info: "Mostrando _START_ a _END_ de _TOTAL_ Roles",
            infoEmpty: "Mostrando 0 a 0 de 0 Roles",
            infoFiltered: "(Filtrado de _MAX_ total Roles)",
            infoPostFix: "",
            thousands: ",",
            lengthMenu: "Mostrar _MENU_ Roles",
            loadingRecords: "Cargando...",
            processing: "Procesando...",
            search: "Buscador:",
            zeroRecords: "Sin resultados encontrados",
            paginate: {
              first: "Primero",
              last: "Ultimo",
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
