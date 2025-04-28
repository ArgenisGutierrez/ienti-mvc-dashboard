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
          <?php include_once "layouts/header.php"; ?>
          <!-- Main header ends -->

          <!-- Content wrapper scroll start -->
          <div class="content-wrapper">

            <!-- Row start -->
            <div class="row gx-3">
              <div class="col-xl-12">
                <div class="card">
                  <div class="card-header card-header-button">
                    <div class="card-title">Recursos</div>
                    <div class="card-header">
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
                                    <label for="clasificacion_recurso" class="form-label">Clasificación</label>
                                    <select class="form-select" id="clasificacion_recurso" name="clasificacion_recurso"
                                      required>
                                      <option selected disabled value="">...</option>
                                      <option value="Material Normativo">Material Normativo</option>
                                      <option value="Material Relativo a Capacitación">Material Relativo a Capacitación
                                      </option>
                                      <option value="Material Complementario">Material Complementario</option>
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
                  </div>
                  <div class="card-body">
                    <div class="accordion" id="accordionExample2">
                      <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOneLight">
                          <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOneLight" aria-expanded="true" aria-controls="collapseOneLight">
                            Material Normativo
                          </button>
                        </h2>
                        <div id="collapseOneLight" class="accordion-collapse collapse" aria-labelledby="headingOneLight"
                          data-bs-parent="#accordionExample2">
                          <div class="accordion-body">
                            <div class="card-body">
                              <div class="table-responsive">
                                <table id="material_normativo_table" class="table custom-table" style="width: 100%;">
                                  <thead>
                                    <tr>
                                      <th>Descripción</th>
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
                                        if ($recurso['clasificacion_recurso'] == "Material Normativo") {
                                            ?>
                                        <tr>
                                          <td>
                                            <?php echo $recurso['descripcion_recurso'] ?>
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
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwoLight">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwoLight" aria-expanded="false" aria-controls="collapseTwoLight">
                            Material Relativo a Capacitación
                          </button>
                        </h2>
                        <div id="collapseTwoLight" class="accordion-collapse collapse" aria-labelledby="headingTwoLight"
                          data-bs-parent="#accordionExample2">
                          <div class="accordion-body">
                            <div class="card-body">
                              <div class="table-responsive">
                                <table id="material_capacitacion_table" class="table custom-table" style="width: 100%;">
                                  <thead>
                                    <tr>
                                      <th>Descripción</th>
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
                                        if ($recurso['clasificacion_recurso'] == "Material Relativo a Capacitación") {
                                            ?>
                                        <tr>
                                          <td>
                                            <?php echo $recurso['descripcion_recurso'] ?>
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
                                                <a target="_blank" href="<?php echo APP_URL .
                                                                          'files/' . $recurso['contenido_recurso'];
                                                ?>" type="button" class="btn
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
                                            <?php if (isset($_SESSION['permisos']) && in_array("Editar Recursos", $_SESSION['permisos'])) : ?>
                                            <td>
                                              <!-- Formulario para eliminar -->
                                              <form id="formEliminar<?php echo $recurso['id_recurso'] ?>" method="POST"
                                                action="<?php echo APP_URL; ?>recursos/<?php echo $recurso['id_recurso'] ?>">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="id_recurso"
                                                  value="<?php echo $recurso['id_recurso'] ?>">
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
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThreeLight">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseThreeLight" aria-expanded="false" aria-controls="collapseThreeLight">
                            Material Complementario
                          </button>
                        </h2>
                        <div id="collapseThreeLight" class="accordion-collapse collapse"
                          aria-labelledby="headingThreeLight" data-bs-parent="#accordionExample2">
                          <div class="accordion-body">
                            <div class="card-body">
                              <div class="table-responsive">
                                <table id="material_complementario_table" class="table custom-table" style="width: 100%;">
                                  <thead>
                                    <tr>
                                      <th>Descripción</th>
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
                                        if ($recurso['clasificacion_recurso'] == "Material Complementario") {
                                            ?>
                                        <tr>
                                          <td>
                                            <?php echo $recurso['descripcion_recurso'] ?>
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
                                                <a target="_blank" href="<?php echo APP_URL .
                                                                          'files/' . $recurso['contenido_recurso'];
                                                ?>" type="button" class="btn
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
                                                <input type="hidden" name="id_recurso"
                                                  value="<?php echo $recurso['id_recurso'] ?>">
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
                            </div>
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
  </body>

  </html>
    <?php
} else {
    header('Location:' . APP_URL . 'login');
    exit();
}
?>
