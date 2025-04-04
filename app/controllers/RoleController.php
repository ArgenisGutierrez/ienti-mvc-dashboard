<?php
/* ========================================================
 * ============ Home Controller ======================
 * ======================================================*/

namespace App\Controllers;

class RoleController extends Controller
{
    public function index()
    {
        return $this->view(
            'roles', [
            ]
        );
    }
}
