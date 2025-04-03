<?php
/* ========================================================
 * ============ Home Controller ======================
 * ======================================================*/

namespace App\Controllers;
use App\Models\Role;

class HomeController extends Controller
{
    public function index()
    {
        $roleModel = new Role();
        return $this->view(
            'home', [
            'title' => 'Home',
            'name' => 'John'
            ]
        );
    }
}
