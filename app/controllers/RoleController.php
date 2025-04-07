<?php
/* ========================================================
 * ============ Home Controller ======================
 * ======================================================*/

namespace App\Controllers;
use App\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $rolesModel = new Role();
        return $this->view(
            'roles', ['roles'=>$rolesModel->getAllRoles()]
        );
    }
    public function create()
    {
    }
}
