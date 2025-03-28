<?php
/* ========================================================
 * ============ Home Controller ======================
 * ======================================================*/

namespace App\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        return $this->view('home');
    }
}
