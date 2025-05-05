<?php
/* ========================================================
 * ============ Controlador General ======================
 * ======================================================*/

namespace App\Controllers;

class Controller
{
  /*------ Retorna las vistas ------*/
  public function view($route, $data = [])
  {
    extract($data);
    if (file_exists("../resources/views/{$route}.php")) {
      ob_start();
      include "../resources/views/{$route}.php";
      $content = ob_get_clean();
      return $content;
    } else {
      return '404';
    }
  }
}
