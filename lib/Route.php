<?php

namespace Lib;

/**
 * Sistema de enrutamiento HTTP para aplicaciones web
 * 
 * Maneja la definición y ejecución de rutas para diferentes métodos HTTP,
 * incluyendo parámetros dinámicos y spoofing de métodos.
 * 
 * @package Lib
 * 
 * @example
 * // Definir ruta GET
 * Route::get('/usuarios', function() { return 'Lista de usuarios'; });
 * 
 * @example
 * // Definir ruta con controlador
 * Route::post('/login', [AuthController::class, 'login']);
 */
class Route
{
  /**
   * Almacena todas las rutas registradas
   * 
   * @var    array Array multidimensional con rutas organizadas por método HTTP
   * @static
   */
  private static $routes = [];

  /**
   * Registra una ruta GET
   * 
   * @param  string         $uri      Patrón de la URI (puede contener parámetros dinámicos
   *                                  con :)
   * @param  callable|array $callback Función anónima o array [Clase, método]
   * @static
   */
  public static function get($uri, $callback)
  {
    $uri = trim($uri, '/');
    self::$routes['GET'][$uri] = $callback;
  }

  /**
   * Registra una ruta POST
   * 
   * @param  string         $uri      Patrón de
   *                                  la URI       
   * @param  callable|array $callback 
   * @static
   */
  public static function post($uri, $callback)
  {
    $uri = trim($uri, '/');
    self::$routes['POST'][$uri] = $callback;
  }

  /**
   * Registra una ruta PUT
   * 
   * @param  string         $uri      Patrón de
   *                                  la URI      
   * @param  callable|array $callback 
   * @static
   */
  public static function put($uri, $callback)
  {
    $uri = trim($uri, '/');
    self::$routes['PUT'][$uri] = $callback;
  }


  /**
   * Registra una ruta DELETE
   * 
   * @param  string         $uri      Patrón de
   *                                  la URI
   * @param  callable|array $callback 
   * @static
   */
  public static function delete($uri, $callback)
  {
    $uri = trim($uri, '/');
    self::$routes['DELETE'][$uri] = $callback;
  }

  /**
   * Ejecuta el enrutamiento para la solicitud actual
   * 
   * Maneja:
   * - Detección de archivos estáticos
   * - Spoofing de métodos HTTP via POST
   * - Parámetros dinámicos en rutas
   * - Respuestas JSON automáticas
   * - Redirección a 404 si no encuentra ruta
   * 
   * @static
   * @return void|false Retorna false si es archivo estático
   * @throws \Exception Si el controlador no existe
   */
  public static function dispatch()
  {
    // Obtener la URI sin query strings
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri = trim($uri, '/');

    $method = $_SERVER['REQUEST_METHOD'];

    // Verificar si es un archivo estático
    if (preg_match('/\.(css|js|png|jpg|jpeg|gif|ico)$/', $uri)) {
      return false;
    }

    // Verificar si la URI es un archivo físico (usando la ruta limpia)
    $publicPath = realpath($_SERVER['DOCUMENT_ROOT'] . '/' . $uri);
    if ($publicPath !== false && is_file($publicPath)) {
      return false;
    }
    $uri = trim($_SERVER['REQUEST_URI'], '/');
    $method = $_SERVER['REQUEST_METHOD'];

    // Verificar si es un archivo estático
    if (preg_match('/\.(css|js|png|jpg|jpeg|gif|ico)$/', $uri)) {
      return false;
    }

    // Verificar si la URI es un archivo físico
    $publicPath = realpath($_SERVER['DOCUMENT_ROOT'] . '/' . $uri);
    if ($publicPath !== false && is_file($publicPath)) {
      return false;
    }

    // Soporte para método spoofing
    if ($method === 'POST' && isset($_POST['_method'])) {
      $method = strtoupper($_POST['_method']);
    }

    // Validar si el método existe en las rutas
    if (!isset(self::$routes[$method])) {
      header("Location: " . APP_URL . "404");
      return;
    }

    foreach (self::$routes[$method] as $route => $callback) {
      if (strpos($route, ':') !== false) {
        $route = preg_replace('#:([\w-]+)#', '([^/]+)', $route);
      }

      if (preg_match("#^$route$#", $uri, $matches)) {
        $params = array_slice($matches, 1);

        if (is_callable($callback)) {
          $response = $callback(...$params);
        } elseif (is_array($callback)) {
          $controller = new $callback[0];
          $response = $controller->{$callback[1]}(...$params);
        }

        // Respuesta corregida (condición completa)
        if (is_array($response) || is_object($response)) {
          header('Content-Type: application/json');
          echo json_encode($response);
        } else {
          echo $response;
        }
        return;
      }
    }
    header("Location: " . APP_URL . "404");
  }
}
