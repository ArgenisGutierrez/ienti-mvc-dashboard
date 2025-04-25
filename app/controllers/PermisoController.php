<?php
/**
 * Controlador para la comprobacion de permisos
 * 
 * Maneja las operaciones de control de permisos
 * - Verificar si el usuario tiene permiso para una accion
 */

namespace App\Controllers;
use App\Models\Permiso;
use Lib\Alert;

class PermisoController extends Controller
{
    protected $permisoModel;

    public function __construct()
    {
        $this->permisoModel = new Permiso();
    }
}
