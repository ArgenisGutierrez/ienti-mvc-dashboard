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
                <i class="bi bi-tags"></i>
              </div>
              <div class="page-title d-none d-md-block">
                <h5>Categorias
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
                    <div class="card-title">Categorias:</div>
                    <div class="card-header">
                      <div class="card-title">
                        <?php if (isset($_SESSION['permisos']) && in_array("Crear Categorias", $_SESSION['permisos'])) : ?>
                          <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#agregarCategoria">
                            + Categoria
                          </button>
                        <?php endif; ?>
                        <!--Modal-->
                        <div class="modal fade" id="agregarCategoria" tabindex="-1" aria-labelledby="exampleModalLabel"
                          aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">
                                  Nueva Categoria
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                  aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <form action="<?php echo APP_URL; ?>categorias" id="categoria_form" method="post" autocomplete="off"
                                  class="needs-validation" novalidate>
                                  <div class="modal-body">
                                    <!-- Campo Nombre -->
                                    <div class="mb-4">
                                      <label for="nombre_categoria" class="form-label">Nombre de la Categoria</label>
                                      <input type="text" class="form-control form-control-lg" id="nombre_categoria"
                                        name="nombre_categoria" required>
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
                      <table id="categoria_table" class="table table-hover custom-table">
                        <thead>
                          <tr>
                            <th>Nombre</th>
                            <?php if (isset($_SESSION['permisos']) && in_array("Editar Categorias", $_SESSION['permisos'])) : ?>
                              <th>Editar</th>
                            <?php endif; ?>
                            <?php if (isset($_SESSION['permisos']) && in_array("Eliminar Categorias", $_SESSION['permisos'])) : ?>
                              <th>Eliminar</th>
                            <?php endif; ?>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($categorias as $categoria) { ?>
                            <tr>
                              <td>
                                <?php echo $categoria['nombre_categoria'] ?>
                              </td>
                                <?php if (isset($_SESSION['permisos']) && in_array("Editar Categorias", $_SESSION['permisos'])) : ?>
                                <td>
                                  <!-- Botón que abre el modal específico para cada registro -->
                                  <button type="button" class="btn btn-primary editar-btn" data-bs-toggle="modal"
                                    data-bs-target="#editarCategoria<?php echo $categoria['id_categoria'] ?>">
                                    <i class="bi bi-pencil-fill"></i>
                                  </button>
                                  <!-- Modal único para cada registro -->
                                  <div class="modal fade" id="editarCategoria<?php echo $categoria['id_categoria'] ?>" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">
                                            Editar
                                            <?php echo $categoria['nombre_categoria'] ?>
                                          </h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                          <form action="<?php echo APP_URL; ?>categorias/<?php echo $categoria['id_categoria'] ?>"
                                            id="categoria_form" method="post" autocomplete="off" class="needs-validation"
                                            novalidate>
                                            <input type="hidden" name="_method" value="PUT">

                                            <div class="modal-body">
                                              <!-- Campo Nombre -->
                                              <div class="mb-4">
                                                <label for="nombre_categoria" class="form-label">Nombre de la categoria</label>
                                                <input type="text" class="form-control form-control-lg" name="nombre_categoria"
                                                  value="<?php echo htmlspecialchars($categoria['nombre_categoria']) ?>" required>
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
                                <?php if (isset($_SESSION['permisos']) && in_array("Eliminar Categorias", $_SESSION['permisos'])) : ?>
                                <td>
                                  <!-- Formulario para eliminar -->
                                  <form id="formEliminar<?php echo $categoria['id_categoria'] ?>" method="POST"
                                    action="<?php echo APP_URL; ?>categorias/<?php echo $categoria['id_categoria'] ?>">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="id_categoria" value="<?php echo $categoria['id_categoria'] ?>">
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

            <!--Subcategorias-->
            <div class="row gx-3">
              <div class="col-xl-12">
                <div class="card">
                  <div class="card-header card-header-button">
                    <div class="card-title">Subcategorias:</div>
                    <div class="card-header">
                      <div class="card-title">
                        <?php if (isset($_SESSION['permisos']) && in_array("Crear Categorias", $_SESSION['permisos'])) : ?>
                          <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#agregarSubcategoria">
                            + Subcategoria
                          </button>
                        <?php endif; ?>
                        <!--Modal-->
                        <div class="modal fade" id="agregarSubcategoria" tabindex="-1" aria-labelledby="exampleModalLabel"
                          aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">
                                  Nueva Subcategoria
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                  aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <form action="<?php echo APP_URL; ?>subcategorias" id="subcategoria_form" method="post" autocomplete="off"
                                  class="needs-validation" novalidate>
                                  <div class="modal-body">
                                    <!-- Campo Categoria -->
                                    <div class="mb-4">
                                      <label for="nombre_categoria" class="form-label">Nombre de la Categoria</label>
                                      <select class="form-select" id="nombre_categoria" name="id_categoria"
                                        required>
                                        <option selected disabled value="">...</option>
                                        <?php foreach ($categorias as $categoria) : ?>
                                          <option value="<?php echo $categoria['id_categoria'] ?>"><?php echo $categoria['nombre_categoria'] ?></option>
                                        <?php endforeach; ?>
                                      </select>
                                    </div>
                                    <!-- Campo Nombre -->
                                    <div class="mb-4">
                                      <label for="nombre_categoria" class="form-label">Nombre de la Subcategoria</label>
                                      <input type="text" class="form-control form-control-lg" id="nombre_categoria"
                                        name="nombre_categoria" required>
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
                      <table id="categoria_table" class="table table-hover custom-table">
                        <thead>
                          <tr>
                            <th>Categoria</th>
                            <th>Subcategoria</th>
                            <?php if (isset($_SESSION['permisos']) && in_array("Editar Categorias", $_SESSION['permisos'])) : ?>
                              <th>Editar</th>
                            <?php endif; ?>
                            <?php if (isset($_SESSION['permisos']) && in_array("Eliminar Categorias", $_SESSION['permisos'])) : ?>
                              <th>Eliminar</th>
                            <?php endif; ?>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($categorias as $categoria) { ?>
                            <tr>
                              <td>
                                <?php echo $categoria['nombre_categoria'] ?>
                              </td>
                              <td>
                                <?php echo $categoria['nombre_subcategoria'] ?>
                              </td>
                                <?php if (isset($_SESSION['permisos']) && in_array("Editar Categorias", $_SESSION['permisos'])) : ?>
                                <td>
                                  <!-- Botón que abre el modal específico para cada registro -->
                                  <button type="button" class="btn btn-primary editar-btn" data-bs-toggle="modal"
                                    data-bs-target="#editarCategoria<?php echo $categoria['id_categoria'] ?>">
                                    <i class="bi bi-pencil-fill"></i>
                                  </button>
                                  <!-- Modal único para cada registro -->
                                  <div class="modal fade" id="editarCategoria<?php echo $categoria['id_categoria'] ?>" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">
                                            Editar
                                            <?php echo $categoria['nombre_categoria'] ?>
                                          </h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                          <form action="<?php echo APP_URL; ?>categorias/<?php echo $categoria['id_categoria'] ?>"
                                            id="categoria_form" method="post" autocomplete="off" class="needs-validation"
                                            novalidate>
                                            <input type="hidden" name="_method" value="PUT">

                                            <div class="modal-body">
                                              <!-- Campo Nombre -->
                                              <div class="mb-4">
                                                <label for="nombre_categoria" class="form-label">Nombre de la categoria</label>
                                                <input type="text" class="form-control form-control-lg" name="nombre_categoria"
                                                  value="<?php echo htmlspecialchars($categoria['nombre_categoria']) ?>" required>
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
                                <?php if (isset($_SESSION['permisos']) && in_array("Eliminar Categorias", $_SESSION['permisos'])) : ?>
                                <td>
                                  <!-- Formulario para eliminar -->
                                  <form id="formEliminar<?php echo $categoria['id_categoria'] ?>" method="POST"
                                    action="<?php echo APP_URL; ?>categorias/<?php echo $categoria['id_categoria'] ?>">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="id_categoria" value="<?php echo $categoria['id_categoria'] ?>">
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

    <script>
      $(document).on('submit', 'form[id^="formEliminar"]', function(e) {
        console.log("Formulario enviado"); // ¿Aparece esto en la consola?
        e.preventDefault();
        const form = this;

        Swal.fire({
          title: "¿Eliminar Categoria?",
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
        const dataTableConfig = {
          columnDefs: [{
              targets: [0],
              width: "50%",
              orderable: true,
              searchable: true,
              className: "columna-descripcion"
            }
            <?php if (isset($_SESSION['permisos']) && in_array("Editar Categorias", $_SESSION['permisos'])) : ?>, {
                targets: [1],
                orderable: false,
                searchable: false,
                className: "columna-botones"
              }
            <?php endif; ?>
            <?php if (isset($_SESSION['permisos']) && in_array("Eliminar Categorias", $_SESSION['permisos'])) : ?>, {
                targets: [<?php echo (in_array("Editar Categorias", $_SESSION["permisos"])) ? 2 : 1; ?>],
                orderable: false,
                searchable: false,
                className: "columna-botones"
              }
            <?php endif; ?>
          ],
          autoWidth: false,
          language: {
            emptyTable: "No hay información",
            info: "Mostrando _START_ a _END_ de _TOTAL_ Categorias",
            infoEmpty: "Mostrando 0 a 0 de 0 Categorias",
            infoFiltered: "(Filtrado de _MAX_ total Categorias)",
            infoPostFix: "",
            thousands: ",",
            lengthMenu: "Mostrar _MENU_ Categorias",
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
        };
        // Aplicar a todas las tablas con clase .table
        $('.table').each(function() {
          const table = $(this);

          // Destruir si ya existe
          if ($.fn.dataTable.isDataTable(table)) {
            table.DataTable().destroy();
          }

          // Inicializar con la configuración
          table.DataTable(dataTableConfig);
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
