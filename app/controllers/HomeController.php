<?php

namespace App\Controllers;

use App\Models\Recurso;
use App\Models\Usuario;

/**
 * Controlador principal para la página de inicio y manejo de errores 404
 * 
 * @package App\Controllers
 * @extends Controller
 * 
 * @example
 * // Ejemplo de uso en rutas:
 * Route::get('/', [HomeController::class, 'index']);
 * Route::get('/404', [HomeController::class, 'error404']);
 */
class HomeController extends Controller
{
    /**
     * Muestra la página principal con estadísticas
     * 
     * Obtiene recuentos de usuarios y recursos para mostrar en el dashboard
     * 
     * @return string Vista renderizada 'home' con:
     *               - usuarios: Total de usuarios registrados
     *               - recursos: Total de recursos disponibles
     */
    public function index()
    {
        $usuario = new Usuario();
        $recurso = new Recurso();
        return $this->view(
            'home',
            [
            'usuarios' => count($usuario->getAllUsuarios()),
            'recursos' => count($recurso->getAllRecursos())
            ]
        );
    }

    /**
     * Muestra la página de error 404
     * 
     * @return string Vista renderizada '/errors/404'
     */
    public function error404()
    {
        return $this->view('/errors/404');
    }
}
