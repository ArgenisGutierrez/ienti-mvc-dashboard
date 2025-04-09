<!DOCTYPE html>
<html lang="es-MX">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>
    <?php echo APP_NAME;?>
  </title>

  <!-- Meta -->
  <meta name="description" content="Marketplace for Bootstrap Admin Dashboards" />
  <meta name="author" content="Bootstrap Gallery" />
  <link rel="canonical" href="https://www.bootstrap.gallery/">
  <meta property="og:url" content="https://www.bootstrap.gallery">
  <meta property="og:title" content="Admin Templates - Dashboard Templates | Bootstrap Gallery">
  <meta property="og:description" content="Marketplace for Bootstrap Admin Dashboards">
  <meta property="og:type" content="Website">
  <meta property="og:site_name" content="Bootstrap Gallery">
  <link rel="shortcut icon" href="images/favicon.svg" />

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
    <div class="page-header">

      <!-- Sidebar brand starts -->
      <div class="brand">
        <a href="<?php echo APP_URL;?>" class="logo">
          <img src="images/logo.webp" class="d-none d-md-block me-4" alt="Bloom Admin Dashboard" />
          <img src="images/logo.webp" class="d-block d-md-none me-4" alt="Bloom Admin Dashboard" />
        </a>
      </div>
      <!-- Sidebar brand ends -->

      <div class="toggle-sidebar" id="toggle-sidebar">
        <i class="bi bi-list"></i>
      </div>

      <!-- Header actions ccontainer start -->
      <div class="header-actions-container">

        <!-- Search container start -->
        <div class="search-container me-4 d-xl-block d-lg-none">

          <!-- Search input group start -->
          <input type="text" class="form-control" placeholder="Search" />
          <!-- Search input group end -->

        </div>
        <!-- Search container end -->

        <!-- Header actions start -->
        <div class="header-actions d-xl-flex d-lg-none gap-4">
          <div class="dropdown">
            <a class="dropdown-toggle" href="#!" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-envelope-open fs-5 lh-1"></i>
              <span class="count-label"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-end shadow-lg">
              <div class="dropdown-item">
                <div class="d-flex py-2 border-bottom">
                  <img src="images/user.png" class="img-3x me-3 rounded-3" alt="Admin Dashboards" />
                  <div class="m-0">
                    <h6 class="mb-1 fw-semibold">Sophie Michiels</h6>
                    <p class="mb-1">Membership has been ended.</p>
                    <p class="small m-0 text-secondary">Today, 07:30pm</p>
                  </div>
                </div>
              </div>
              <div class="dropdown-item">
                <div class="d-flex py-2 border-bottom">
                  <img src="images/user2.png" class="img-3x me-3 rounded-3" alt="Admin Dashboards" />
                  <div class="m-0">
                    <h6 class="mb-1 fw-semibold">Benjamin Michiels</h6>
                    <p class="mb-1">Congratulate, James for new job.</p>
                    <p class="small m-0 text-secondary">Today, 08:00pm</p>
                  </div>
                </div>
              </div>
              <div class="dropdown-item">
                <div class="d-flex py-2">
                  <img src="images/user1.png" class="img-3x me-3 rounded-3" alt="Admin Dashboards" />
                  <div class="m-0">
                    <h6 class="mb-1 fw-semibold">Jehovah Roy</h6>
                    <p class="mb-1">Lewis added new schedule release.</p>
                    <p class="small m-0 text-secondary">Today, 09:30pm</p>
                  </div>
                </div>
              </div>
              <div class="d-grid mx-3 my-1">
                <a href="javascript:void(0)" class="btn btn-primary">View all</a>
              </div>
            </div>
          </div>
          <a href="account-settings.html" data-bs-toggle="tooltip" data-bs-placement="bottom"
            data-bs-custom-class="custom-tooltip-blue" data-bs-title="Settings">
            <i class="bi bi-gear fs-5"></i>
          </a>
        </div>
        <!-- Header actions start -->

        <!-- Header profile start -->
        <div class="header-profile d-flex align-items-center">
          <div class="dropdown">
            <a href="#" id="userSettings" class="user-settings" data-toggle="dropdown" aria-haspopup="true">
              <span class="user-name d-none d-md-block">Michelle White</span>
              <span class="avatar">
                <img src="images/user7.png" alt="User Avatar" />
                <span class="status online"></span>
              </span>
            </a>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userSettings">
              <div class="header-profile-actions">
                <a href="profile.html">Profile</a>
                <a href="account-settings.html">Settings</a>
                <a href="login.html">Logout</a>
              </div>
            </div>
          </div>
        </div>
        <!-- Header profile end -->

      </div>
      <!-- Header actions ccontainer end -->

    </div>
    <!-- Page header ends -->

    <!-- Main container start -->
    <div class="main-container">

      <!-- Sidebar wrapper start -->
      <nav class="sidebar-wrapper">

        <!-- Sidebar menu starts -->
        <div class="sidebar-menu">
          <div class="sidebarMenuScroll">
            <ul>
              <li>
                <a href="<?php echo APP_URL;?>">
                  <i class="bi bi-house"></i>
                  <span class="menu-text">Home</span>
                </a>
              </li>
              <li>
                <a href="">
                  <i class="bi bi-person-video2"></i>
                  <span class="menu-text">Usuarios</span>
                </a>
              </li>
              <li>
                <a href="<?php echo APP_URL;?>recursos">
                  <i class="bi bi-boxes"></i>
                  <span class="menu-text">Recursos</span>
                </a>
              </li>
              <li>
                <a href="<?php echo APP_URL;?>roles">
                  <i class="bi bi-file-earmark-lock2-fill"></i>
                  <span class="menu-text">Roles</span>
                </a>
              </li>
            </ul>
          </div>
        </div>
        <!-- Sidebar menu ends -->
      </nav>
      <!-- Sidebar wrapper end -->

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
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                      + Recurso
                    </button>
                    <!--Modal-->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                      aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                              Nuevo Recurso
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <form action="<?php echo APP_URL;?>app/controllers/recursos/crear_recurso.php"
                              id="recurso_form" method="post" autocomplete="off" class="row g-3 needs-validation"
                              enctype="multipart/form-data" novalidate>
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
                                <input type="text" class="form-control" id="contenido_recurso" name="contenido_recurso"
                                  required />
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
                                  <th>Editar</th>
                                  <th>Eliminar</th>
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
                                    <a target="_blank" href="<?php echo $recurso['contenido_recurso'];?>"
                                      download="<?php echo $recurso['contenido_recurso']?>" type="button"
                                      class="btn btn-info editar-btn">
                                      <i class="bi bi-link-45deg"></i>
                                    </a>
                                            <?php
                                            break;
                                        case 'Archivo':
                                            ?>
                                    <a target="_blank" href="<?php echo APP_URL."
                                      public/recursos/".$recurso['contenido_recurso'];?>" type="button" class="btn
                                      btn-info editar-btn">
                                      <i class="bi bi-cloud-arrow-down-fill"></i>
                                    </a>
                                            <?php
                                            break;
                                        default:
                                            ?>
                                    <a target="_blank" href="<?php echo $recurso['contenido_recurso']?>" type="button"
                                      class="btn btn-info editar-btn">
                                      <i class="bi bi-film"></i>
                                    </a>
                                            <?php
                                            break;
                                        }
                                        ?>
                                  </td>
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
                                              action="<?php echo APP_URL ?>app/controllers/recursos/actualizar_recurso.php"
                                              enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>

                                              <!-- Campos ocultos importantes -->
                                              <input type="hidden" name="id_recurso"
                                                value="<?php echo $recurso['id_recurso'] ?>">
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
                                                    <a href="<?php echo $recurso['contenido_recurso'] ?>"
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
                                  <td>
                                    <!-- Formulario para eliminar -->
                                    <button type="button" class="btn btn-danger"
                                      onclick="confirmarEliminacion(<?php echo $recurso['id_recurso'] ?>)">
                                      <i class="bi bi-trash-fill"></i>
                                    </button>
                                  </td>
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
                                  <th>Editar</th>
                                  <th>Eliminar</th>
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
                                    <a target="_blank" href="<?php echo $recurso['contenido_recurso'];?>"
                                      download="<?php echo $recurso['contenido_recurso']?>" type="button"
                                      class="btn btn-info editar-btn">
                                      <i class="bi bi-link-45deg"></i>
                                    </a>
                                            <?php
                                            break;
                                        case 'Archivo':
                                            ?>
                                    <a target="_blank" href="<?php echo APP_URL."
                                      public/recursos/".$recurso['contenido_recurso'];?>" type="button" class="btn
                                      btn-info editar-btn">
                                      <i class="bi bi-cloud-arrow-down-fill"></i>
                                    </a>
                                            <?php
                                            break;
                                        default:
                                            ?>
                                    <a target="_blank" href="<?php echo $recurso['contenido_recurso']?>" type="button"
                                      class="btn btn-info editar-btn">
                                      <i class="bi bi-film"></i>
                                    </a>
                                            <?php
                                            break;
                                        }
                                        ?>
                                  </td>
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
                                              action="<?php echo APP_URL ?>app/controllers/recursos/actualizar_recurso.php"
                                              enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>

                                              <!-- Campos ocultos importantes -->
                                              <input type="hidden" name="id_recurso"
                                                value="<?php echo $recurso['id_recurso'] ?>">
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
                                                    <a href="<?php echo $recurso['contenido_recurso'] ?>"
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
                                  <td>
                                    <!-- Formulario para eliminar -->
                                    <button type="button" class="btn btn-danger"
                                      onclick="confirmarEliminacion(<?php echo $recurso['id_recurso'] ?>)">
                                      <i class="bi bi-trash-fill"></i>
                                    </button>
                                  </td>
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
                    <div id="collapseThreeLight" class="accordion-collapse collapse" aria-labelledby="headingThreeLight"
                      data-bs-parent="#accordionExample2">
                      <div class="accordion-body">
                        <div class="card-body">
                          <div class="table-responsive">
                            <table id="material_complementario_table" class="table custom-table" style="width: 100%;">
                              <thead>
                                <tr>
                                  <th>Descripción</th>
                                  <th>Descargar</th>
                                  <th>Editar</th>
                                  <th>Eliminar</th>
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
                                    <a target="_blank" href="<?php echo $recurso['contenido_recurso'];?>"
                                      download="<?php echo $recurso['contenido_recurso']?>" type="button"
                                      class="btn btn-info editar-btn">
                                      <i class="bi bi-link-45deg"></i>
                                    </a>
                                            <?php
                                            break;
                                        case 'Archivo':
                                            ?>
                                    <a target="_blank" href="<?php echo APP_URL."
                                      public/recursos/".$recurso['contenido_recurso'];?>" type="button" class="btn
                                      btn-info editar-btn">
                                      <i class="bi bi-cloud-arrow-down-fill"></i>
                                    </a>
                                            <?php
                                            break;
                                        default:
                                            ?>
                                    <a target="_blank" href="<?php echo $recurso['contenido_recurso']?>" type="button"
                                      class="btn btn-info editar-btn">
                                      <i class="bi bi-film"></i>
                                    </a>
                                            <?php
                                            break;
                                        }
                                        ?>
                                  </td>
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
                                              action="<?php echo APP_URL ?>app/controllers/recursos/actualizar_recurso.php"
                                              enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>

                                              <!-- Campos ocultos importantes -->
                                              <input type="hidden" name="id_recurso"
                                                value="<?php echo $recurso['id_recurso'] ?>">
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
                                                    <a href="<?php echo $recurso['contenido_recurso'] ?>"
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
                                  <td>
                                    <!-- Formulario para eliminar -->
                                    <button type="button" class="btn btn-danger"
                                      onclick="confirmarEliminacion(<?php echo $recurso['id_recurso'] ?>)">
                                      <i class="bi bi-trash-fill"></i>
                                    </button>
                                  </td>
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

  <script src="js/recursos.js"></script>
  <?php Lib\Alert::display();?>
</body>

</html>
