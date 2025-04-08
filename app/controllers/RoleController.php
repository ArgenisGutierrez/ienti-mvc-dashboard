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

    public function update($id_rol)
    {
        $rolesModel= new Role();
        $nombre_rol = $_POST['nombre_rol'];
        $nombre_rol = mb_strtoupper($nombre_rol, 'utf8');

        if (empty($nombre_rol)) {
            session_start();
            $_SESSION['mensaje'] = "El Rol Nombre de Rol no puede estar vacio.";
            $_SESSION['icono'] = "error";
            header("Location:" . APP_URL . "roles");
        } else {
            if($rolesModel->update(
                [
                        'id_rol' => $id_rol,
                        'nombre_rol' => $nombre_rol,
                        'fechaHora' => date('Y-m-d H:i:s'),
                        ]
            )
            ) {
                session_start();
                $_SESSION['mensaje'] = "Role Actualizado Con Exito";
                $_SESSION['icono'] = "success";
                header("Location:" . APP_URL . "roles");
            } else {
                session_start();
                $_SESSION['mensaje'] = "El Rol No Pudo Ser Actualizado";
                $_SESSION['icono'] = "error";
                header("Location:" . APP_URL . "roles");
            }

        }
    }

    public function delete($id_rol)
    {
        if (empty($id_rol)) {
            $_SESSION['mensaje'] = "Solicitud inválida";
            $_SESSION['icono'] = "error";
            header("Location:" . APP_URL . "roles");
            exit;
        }
        $rolesModel = new Role();
        $rolesModel->delete($id_rol);
        header("Location:" . APP_URL . "roles");
    }
}
