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
