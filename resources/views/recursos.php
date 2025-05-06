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
                <i class="bi bi-boxes"></i>
              </div>
              <div class="page-title d-none d-md-block">
                <h5> Recursos
                </h5>
              </div>
            </div>
            <!-- Live updates start -->
            <!-- Live updates end -->
          </div>
          <!-- Main header ends -->

          <!-- Content wrapper scroll start -->
          <div class="content-wrapper">

            <!-- Row start -->
            <div class="row gx-3">
              <div class="col-xl-12">
                <div class="card">
                  <div class="card-header card-header-button">
                    <div class="card-title">Recursos</div>
                    <div class="card-title">
                      <?php if (isset($_SESSION['permisos']) && in_array("Crear Recursos", $_SESSION['permisos'])) : ?>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                          data-bs-target="#exampleModal">
                          + Recurso
                        </button>
                      <?php endif; ?>
                      <!--Modal-->
                      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">
                                Nuevo Recurso
                              </h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                            </div>
                            <script>
                              // Convertir subcategorías PHP a JavaScript
                              const subcategoriasData = <?php echo json_encode($subcategorias); ?>;
                            </script>
                            <div class="modal-body">
                              <form action="<?php echo APP_URL; ?>recursos" id="recurso_form" method="post"
                                autocomplete="off" class="row g-3 needs-validation" enctype="multipart/form-data"
                                novalidate>
                                <div class="col-md-12">
                                  <label for="descripcion_recurso" class="form-label">Descripción</label>
                                  <input type="text" class="form-control" id="descripcion_recurso"
                                    name="descripcion_recurso" required />
                                </div>
                                <div class="col-md-12">
                                  <label for="categoria_recurso" class="form-label">Categoría</label>
                                  <select class="form-select" id="categoria_recurso" name="id_categoria" required>
                                    <option selected disabled value="">...</option>
                                    <?php foreach ($categorias as $categoria): ?>
                                      <option value="<?php echo $categoria['id_categoria'] ?>"><?php echo $categoria['nombre_categoria'] ?></option>
                                    <?php endforeach ?>
                                  </select>
                                </div>
                                <div class="col-md-12">
                                  <label for="subcategoria_recurso" class="form-label">Subcategoría</label>
                                  <select class="form-select" id="subcategoria_recurso" name="id_subcategoria" required>
                                    <option selected disabled value="">...</option>
                                  </select>
                                </div>
                                <div class="col-md-12">
                                  <label for="tipo_recurso" class="form-label">Tipo</label>
                                  <select class="form-select" id="tipo_recurso" name="tipo_recurso" required>
                                    <option selected disabled value="">...</option>
                                    <option value="URL">URL</option>
                                    <option value="Archivo">Archivo</option>
                                    <option value="Video">Video</option>
                                  </select>
                                </div>
                                <div class="col-md-12" id="materialField" hidden>
                                  <label for="contenido_recurso" class="form-label" id="materialLabel"></label>
                                  <input type="text" class="form-control" id="contenido_recurso"
                                    name="contenido_recurso" required />
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

                  <div class="card-body"> <!-- Contenedor principal -->
                    <?php foreach ($categorias as $categoria) : ?>
                      <!-- Tarjeta por categoría -->
                      <div class="card-header">
                        <div class="card-title">
                          <?php echo $categoria['nombre_categoria'] ?>:
                        </div>
                      </div>
                      <div class="card-body p-0">
                        <div class="accordion" id="accordionCat<?php echo $categoria['id_categoria'] ?>">
                          <?php foreach ($subcategorias as $subcategoria): ?>
                                <?php if ($subcategoria['id_categoria'] == $categoria['id_categoria']) : ?>
                              <!-- Ítem del acordeón -->
                              <div class="accordion-item border-bottom"> <!-- Borde inferior -->
                                <h2 class="accordion-header">
                                  <button class="accordion-button collapsed py-3"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#collapse<?php echo $subcategoria['id_subcategoria'] ?>"
                                    aria-expanded="false"
                                    aria-controls="collapse<?php echo $subcategoria['id_subcategoria'] ?>">
                                    <i class="bi bi-folder me-3"></i> <!-- Ícono -->
                                    <?php echo $subcategoria['nombre_subcategoria'] ?>
                                  </button>
                                </h2>

                                <div id="collapse<?php echo $subcategoria['id_subcategoria'] ?>"
                                  class="accordion-collapse collapse"
                                  data-bs-parent="#accordionCat<?php echo $categoria['id_categoria'] ?>">
                                  <div class="accordion-body bg-light">
                                    <!-- Contenido Acordeon -->
                                    <div class="table-responsive">
                                      <table class="table custom-table" style="width: 100%;">
                                        <thead>
                                          <tr>
                                            <th>Descripción</th>
                                            <th>Publicación</th>
                                            <th>Descargar</th>
                                            <?php if (isset($_SESSION['permisos']) && in_array("Editar Recursos", $_SESSION['permisos'])) : ?>
                                              <th>Editar</th>
                                            <?php endif; ?>
                                            <?php if (isset($_SESSION['permisos']) && in_array("Eliminar Recursos", $_SESSION['permisos'])) : ?>
                                              <th>Eliminar</th>
                                            <?php endif; ?>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <?php foreach ($recursos as $recurso) {
                                                if ($recurso['id_subcategoria'] == $subcategoria['id_subcategoria']) {
                                                    ?>
                                              <tr>
                                                <td>
                                                    <?php echo $recurso['descripcion_recurso'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $recurso['fyh_creacion'] ?>
                                                </td>
                                                <td>
                                                    <?php
                                                      switch ($recurso['tipo_recurso']) {
                                                    case 'URL':
                                                        ?>
                                                      <a target="_blank" href="<?php echo $recurso['contenido_recurso']; ?>"
                                                        download="<?php echo $recurso['contenido_recurso'] ?>" type="button"
                                                        class="btn btn-info editar-btn">
                                                        <i class="bi bi-link-45deg"></i>
                                                      </a>
                                                        <?php
                                                        break;
                                                    case 'Archivo':
                                                        ?>
                                                      <a target="_blank" href="<?php echo APP_URL . 'files/' .
                                                                                  $recurso['contenido_recurso']; ?>"
                                                        type="button" class="btn
                                        btn-info editar-btn">
                                                        <i class="bi bi-cloud-arrow-down-fill"></i>
                                                      </a>
                                                        <?php
                                                        break;
                                                    default:
                                                        ?>
                                                      <a target="_blank" href="<?php echo $recurso['contenido_recurso'] ?>"
                                                        type="button" class="btn btn-info editar-btn">
                                                        <i class="bi bi-film"></i>
                                                      </a>
                                                        <?php
                                                        break;
                                                      }
                                                        ?>
                                                </td>
                                                    <?php if (isset($_SESSION['permisos']) && in_array("Editar Recursos", $_SESSION['permisos'])) : ?>
                                                  <td>
                                                    <!-- Botón que abre el modal específico para cada registro -->
                                                    <button type="button" class="btn btn-primary editar-btn" data-bs-toggle="modal"
                                                      data-bs-target="#editarRole<?php echo $recurso['id_recurso'] ?>">
                                                      <i class="bi bi-pencil-fill"></i>
                                                    </button>
                                                    <!-- Modal único para cada registro -->
                                                    <div class="modal fade" id="editarRole<?php echo $recurso['id_recurso'] ?>"
                                                      tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">
                                                              Editar Recurso -
                                                              <?php echo $recurso['descripcion_recurso'] ?>
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                              aria-label="Close"></button>
                                                          </div>
                                                          <div class="modal-body">
                                                            <form autocomplete="off"
                                                              id="form-editar-<?php echo $recurso['id_recurso'] ?>" method="POST"
                                                              action="<?php echo APP_URL; ?>recursos/<?php echo $recurso['id_recurso']; ?>"
                                                              enctype="multipart/form-data" class="row g-3 needs-validation"
                                                              novalidate>

                                                              <!-- Campos ocultos importantes -->
                                                              <input type="hidden" name="_method" value="PUT">
                                                              <input type="hidden"
                                                                id="tipo_original_<?php echo $recurso['id_recurso'] ?>"
                                                                value="<?php echo $recurso['tipo_recurso'] ?>">
                                                              <input type="hidden"
                                                                id="contenido_original_<?php echo $recurso['id_recurso'] ?>"
                                                                value="<?php echo $recurso['contenido_recurso'] ?>">

                                                              <!-- Resto de campos del formulario... -->
                                                              <div class="col-md-12">
                                                                <label for="editar_descripcion" class="form-label">Descripción</label>
                                                                <input type="text" name="descripcion_recurso" class="form-control"
                                                                  id="editar_descripcion" name="descripcion"
                                                                  value="<?php echo htmlspecialchars($recurso['descripcion_recurso']) ?>"
                                                                  required>
                                                              </div>

                                                              <div class="col-md-12">
                                                                <label for="editar_clasificacion"
                                                                  class="form-label">Clasificación</label>
                                                                <select class="form-select" id="editar_clasificacion"
                                                                  name="clasificacion_recurso" required>
                                                                  <?php
                                                                    $clasificaciones = [
                                                                    'Material Normativo',
                                                                    'Material Relativo a Capacitación',
                                                                    'Material Complementario'
                                                                    ];
                                                                    foreach ($clasificaciones as $clasif) {
                                                                        $selected = $recurso['clasificacion_recurso'] == $clasif ? 'selected' : '';
                                                                        echo "<option value='$clasif' $selected>$clasif</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                              </div>

                                                              <div class="col-md-12">
                                                                <label for="editar_tipo" class="form-label">Tipo</label>
                                                                <select class="form-select" id="editar_tipo" name="tipo_recurso"
                                                                  required data-id="<?php echo $recurso['id_recurso'] ?>">
                                                                  <?php
                                                                    $tipos = ['URL', 'Archivo', 'Video'];
                                                                    foreach ($tipos as $tipo) {
                                                                        $selected = $recurso['tipo_recurso'] == $tipo ? 'selected' : '';
                                                                        echo "<option value='$tipo' $selected>$tipo</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                              </div>

                                                              <div class="col-md-12"
                                                                id="campo-edicion-<?php echo $recurso['id_recurso'] ?>">
                                                                <?php if ($recurso['tipo_recurso'] == 'Archivo') : ?>
                                                                  <div class="mb-3">
                                                                    <label class="form-label">Archivo actual:</label>
                                                                    <div class="input-group">
                                                                      <a href="<?php echo " /files/" . $recurso['contenido_recurso'] ?>"
                                                                        class="form-control" target="_blank">
                                                                        <?php echo basename($recurso['contenido_recurso']) ?>
                                                                      </a>
                                                                      <button type="button" class="btn btn-outline-secondary"
                                                                        onclick="document.getElementById('nuevo_archivo_<?php echo $recurso['id_recurso'] ?>').click()">
                                                                        Cambiar archivo
                                                                      </button>
                                                                      <input type="file"
                                                                        id="nuevo_archivo_<?php echo $recurso['id_recurso'] ?>"
                                                                        name="contenido_recurso" class="d-none">
                                                                    </div>
                                                                    <small class="text-muted">
                                                                      <?php echo $recurso['contenido_recurso'] ?>
                                                                    </small>
                                                                  </div>
                                                                <?php else: ?>
                                                                  <div class="mb-3">
                                                                    <label class="form-label">
                                                                      <?php echo $recurso['tipo_recurso'] == 'URL' ? 'Enlace' : 'URL del Video' ?>
                                                                    </label>
                                                                    <input type="url" class="form-control" name="contenido_recurso"
                                                                      value="<?php echo $recurso['contenido_recurso'] ?>" required>
                                                                  </div>
                                                                <?php endif; ?>
                                                              </div>
                                                              <div class="modal-footer">
                                                                <button type="submit" class="btn btn-primary">
                                                                  Guardar
                                                                </button>
                                                              </div>
                                                            </form>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </td>
                                                    <?php endif; ?>
                                                    <?php if (isset($_SESSION['permisos']) && in_array("Eliminar Recursos", $_SESSION['permisos'])) : ?>
                                                  <td>
                                                    <!-- Formulario para eliminar -->
                                                    <form id="formEliminar<?php echo $recurso['id_recurso'] ?>" method="POST"
                                                      action="<?php echo APP_URL; ?>recursos/<?php echo $recurso['id_recurso'] ?>">
                                                      <input type="hidden" name="_method" value="DELETE">
                                                      <button type="submit" class="btn btn-danger">
                                                        <i class="bi bi-trash-fill"></i>
                                                      </button>
                                                    </form>
                                                  </td>
                                                    <?php endif; ?>
                                              </tr>
                                                    <?php
                                                }
                                          } ?>
                                        </tbody>
                                      </table>
                                    </div>
                                    <!--Fin Contenido Acordeon -->
                                  </div>
                                </div>
                              </div>
                                <?php endif; ?>
                          <?php endforeach; ?>
                        </div>
                      </div>
                    <?php endforeach; ?>
                  </div>

                </div>
              </div>
            </div>
            <!-- Row end -->
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
      <?php Lib\Alert::display(); ?>
      <script src="js/recursos.js"></script>

      <script>
        $(document).on('submit', 'form[id^="formEliminar"]', function(e) {
          console.log("Formulario enviado"); // ¿Aparece esto en la consola?
          e.preventDefault();
          const form = this;

          Swal.fire({
            title: "¿Eliminar recurso?",
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
        $(function() {
          // Configuración común para todas las tablas
          const dataTableConfig = {
            columnDefs: [{
                targets: 0,
                width: "70%",
                orderable: true,
                searchable: true,
                className: "columna-descripcion"
              },
              {
                targets: 1,
                width: "15%",
                orderable: true,
                searchable: true,
                className: "columna-publicacion"
              },
              {
                targets: 2,
                orderable: false,
                searchable: false,
                className: "columna-botones"
              }
              <?php if (isset($_SESSION['permisos']) && in_array("Editar Recursos", $_SESSION['permisos'])) : ?>,
                {
                  targets: 3,
                  orderable: false,
                  searchable: false,
                  className: "columna-botones"
                }
              <?php endif; ?>
              <?php if (isset($_SESSION['permisos']) && in_array("Eliminar Recursos", $_SESSION['permisos'])) : ?>,
                {
                  targets: <?php echo (in_array("Editar Recursos", $_SESSION['permisos'])) ? 4 : 3; ?>,
                  orderable: false,
                  searchable: false,
                  className: "columna-botones"
                }
              <?php endif; ?>
            ],
            autoWidth: false,
            language: {
              emptyTable: "No hay información",
              info: "Mostrando _START_ a _END_ de _TOTAL_ Recursos",
              infoEmpty: "Mostrando 0 a 0 de 0 Recursos",
              infoFiltered: "(Filtrado de _MAX_ total Recursos)",
              lengthMenu: "Mostrar _MENU_ Recursos",
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
      <script>
        document.addEventListener('DOMContentLoaded', function() {
          const categoriaSelect = document.getElementById('categoria_recurso');
          const subcategoriaSelect = document.getElementById('subcategoria_recurso');

          function actualizarSubcategorias() {
            const categoriaId = categoriaSelect.value;

            // Limpiar select
            subcategoriaSelect.innerHTML = '<option selected disabled value="">...</option>';

            // Filtrar subcategorías
            const subcategoriasFiltradas = subcategoriasData.filter(
              sub => sub.id_categoria == categoriaId
            );

            // Llenar opciones
            subcategoriasFiltradas.forEach(sub => {
              const option = new Option(sub.nombre_subcategoria, sub.id_subcategoria);
              subcategoriaSelect.add(option);
            });

            // Habilitar/validar
            subcategoriaSelect.disabled = !categoriaId;
            subcategoriaSelect.required = !!categoriaId;
          }

          // Event listeners
          categoriaSelect.addEventListener('change', actualizarSubcategorias);

          // Actualizar al cargar si ya hay un valor seleccionado (en caso de edición)
          actualizarSubcategorias();
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
