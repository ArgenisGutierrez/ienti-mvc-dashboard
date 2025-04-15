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
    <?php echo APP_NAME;?>
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
    <?php include_once "layouts/head.php";?>
    <!-- Page header ends -->

    <!-- Main container start -->
    <div class="main-container">

      <!-- Sidebar wrapper start -->
      <?php include_once "layouts/menu.php";?>
      <!-- Sidebar wrapper end -->

      <!-- Content wrapper scroll start -->
      <div class="content-wrapper-scroll">

        <!-- Main header starts -->
      <?php include_once "layouts/header.php";?>
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
                      <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#agregarRole">
                        + Role
                      </button>
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
                              <form action="<?php echo APP_URL;?>roles" id="role_form" method="post" autocomplete="off"
                                class="row g-3 needs-validation" novalidate>
                                <div class="col-md-12">
                                  <label for="nombre_rol" class="form-label">Nombre</label>
                                  <input type="text" class="form-control" id="nombre_rol" name="nombre_rol" required />
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
                    <table id="role_table" class="table table-hover custom-table">
                      <thead>
                        <tr>
                          <th>Nombre</th>
                          <th>Editar</th>
                          <th>Eliminar</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($roles as $rol) { ?>
                        <tr>
                          <td>
                            <?php echo $rol['nombre_rol'] ?>
                          </td>
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
                                      id="role_form" method="post" autocomplete="off" class="row g-3 needs-validation"
                                      novalidate>
                                      <input type="hidden" name="_method" value="PUT">
                                      <div class="col-md-12">
                                        <label for="nombre_rol" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" name="nombre_rol"
                                          value="<?php echo htmlspecialchars($rol['nombre_rol']) ?>" required>
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
                            <form id="formEliminar<?php echo $rol['id_rol'] ?>" method="POST"
                              action="<?php echo APP_URL; ?>roles/<?php echo $rol['id_rol']?>">
                              <input type="hidden" name="_method" value="DELETE">
                              <input type="hidden" name="id_rol" value="<?php echo $rol['id_rol'] ?>">
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

  <script src="js/roles.js"></script>
  <script>
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
    <?php Lib\Alert::display();?>
</body>

</html>
    <?php
}else{
    header('Location:'.APP_URL.'login');
    exit();
}
