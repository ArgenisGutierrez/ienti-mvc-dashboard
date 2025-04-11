<?php
/* ========================================================
 * ============ Home Controller ======================
 * ======================================================*/

namespace App\Controllers;
use App\Models\Usuario;
use App\Models\Role;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarioModel = new Usuario();
        $roleModel = new Role();
        return $this->view(
            'usuarios', ['usuarios'=>$usuarioModel->getAllUsuarios(),'roles'=>$roleModel->getAllRoles()]
        );
    }
}
