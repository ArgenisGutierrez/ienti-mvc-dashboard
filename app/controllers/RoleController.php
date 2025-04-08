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
        $rolesModel = new Role();
        $nombre_rol = $_POST['nombre_rol'];
        $nombre_rol = mb_strtoupper($nombre_rol, 'utf8');
        if (empty($nombre_rol)) {
            session_start();
            $_SESSION['mensaje'] = "El Rol Nombre de Rol no puede estar vacio.";
            $_SESSION['icono'] = "error";
            header("Location:" . APP_URL . "roles");
        } else {
            if($rolesModel->createRole(
                [
                'nombre_rol' => $nombre_rol,
                'fechaHora' => date('Y-m-d H:i:s'),
                'estado' => '1'
                ]
            )
            ) {
                        session_start();
                        $_SESSION['mensaje'] = "Role Creado Con Exito";
                        $_SESSION['icono'] = "success";
                        header("Location:" . APP_URL . "roles");
            } else {
                session_start();
                $_SESSION['mensaje'] = "El Rol No Pude Ser Creado";
                $_SESSION['icono'] = "error";
                header("Location:" . APP_URL . "roles");
            }
        }
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['id_rol'])) {
            $_SESSION['mensaje'] = "Solicitud inválida";
            $_SESSION['icono'] = "error";
            header("Location:" . APP_URL . "roles");
            exit;
        }
        $rolesModel = new Role();
        $id_rol = $_POST['id_rol'];
        $rolesModel->deleteRole($id_rol);
        header("Location:" . APP_URL . "roles");
    }
}
