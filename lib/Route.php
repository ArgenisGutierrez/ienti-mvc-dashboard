<?php
/* ========================================================
 * ========== Clase para el manejo de rutas ===============
 * ======================================================*/

namespace Lib;

class Route
{
    /*------ Definicion de rutas ------*/
    private static $routes = [];
  
    public static function get($uri,$callback)
    {
        $uri=trim($uri, '/');
        self::$routes['GET'][$uri]=$callback;
    }

    public static function post($uri,$callback)
    {
        $uri=trim($uri, '/');
        self::$routes['POST'][$uri]=$callback;
    }

    public static function put($uri, $callback)
    {
        $uri = trim($uri, '/');
        self::$routes['PUT'][$uri] = $callback;
    }

    public static function delete($uri, $callback)
    {
        $uri = trim($uri, '/');
        self::$routes['DELETE'][$uri] = $callback;
    }

    /*------ Ejecucion de rutas ------*/
    public static function dispatch()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $uri = trim($uri, '/');
        $method = $_SERVER['REQUEST_METHOD'];

        // Soporte para método spoofing (PUT/DELETE desde formularios)
        if ($method === 'POST' && isset($_POST['_method'])) {
            $method = strtoupper($_POST['_method']);
        }

        foreach (self::$routes[$method] as $route => $callback) {

            // Mejora la expresión regular para capturar números y otros caracteres
            if (strpos($route, ':') !== false) {
                $route = preg_replace('#:([\w-]+)#', '([^/]+)', $route);
            }

            if (preg_match("#^$route$#", $uri, $matches)) {
                $params = array_slice($matches, 1);
                if(is_callable($callback)) {
                    $response = $callback(...$params);
                }
                if(is_array($callback)) {
                    $controller = new $callback[0];
                    $response = $controller->{$callback[1]}(...$params);
                }
                if (is_array($response || is_object($response))) {
                    header('Content-Type: application/json');
                    echo json_encode($response);
                }else{
                    echo $response;
                }
                return;
            }
        }
        echo '404 Not Found';
    }
}
