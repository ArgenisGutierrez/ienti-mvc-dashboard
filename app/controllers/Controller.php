<?php

namespace App\Controllers;

/**
 * Controlador base para manejo de vistas
 * 
 * Proporciona funcionalidad común para la renderización de vistas
 * a través de todos los controladores heredados.
 * 
 * @package App\Controllers
 * 
 * @example
 * class MiController extends Controller {
 *     public function index() {
 *         return $this->view('mi-vista', ['titulo' => 'Ejemplo']);
 *     }
 * }
 */
class Controller
{
  /**
   * Renderiza una vista PHP con datos
   * 
   * @param string $route Ruta relativa del archivo de vista (sin extensión)
   * @param array  $data  Array asociativo de variables para la vista
   * 
   * @return string Contenido HTML renderizado o '404' si no encuentra la vista
   * 
   * @example
   * $this->view('contactos', ['contactos' => $listaContactos]);
   */
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
