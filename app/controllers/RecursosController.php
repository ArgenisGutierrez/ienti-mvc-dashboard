<?php
/* ========================================================
 * ============ Recursos Controller ======================
 * ======================================================*/

namespace App\Controllers;
use App\Models\Recurso;

class RecursosController extends Controller
{
    public function index()
    {
        $recursoModel = new Recurso();
        return $this->view(
            'recursos', ['recursos'=>$recursoModel->getAllRecursos()]
        );
    }

}
