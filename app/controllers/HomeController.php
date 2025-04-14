<?php
/* ========================================================
 * ============ Home Controller ======================
 * ======================================================*/

namespace App\Controllers;
use App\Models\Recurso;
use App\Models\Usuario;

class HomeController extends Controller
{
    public function index()
    {
        $usuario = new Usuario();
        $recurso = new Recurso();
        return $this->view(
            'home', [
              'usuarios' => count($usuario->getAllUsuarios()),
              'recursos' => count($recurso->getAllRecursos())
            ]
        );
    }

    public function error404()
    {
        return $this->view('/errors/404');
    }
}
