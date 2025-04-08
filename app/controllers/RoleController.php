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
            \Lib\Alert::error('Error', 'El Rol Nombre de Rol no puede estar vacio.');
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
                \Lib\Alert::success('Exito', 'Role Creado Con Exito');
                header("Location:" . APP_URL . "roles");
            } else {
                \Lib\Alert::error('Error', 'El Rol No Pudo Ser Creado');
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
            \Lib\Alert::error('Error', 'El Rol Nombre de Rol no puede estar vacio.');
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
                \Lib\Alert::success('Exito', 'Role Actualizado Con Exito');
                header("Location:" . APP_URL . "roles");
            } else {
                \Lib\Alert::error('Error', 'El Rol No Pudo Ser Actualizado');
                header("Location:" . APP_URL . "roles");
            }

        }
    }

    public function delete($id_rol)
    {
        if (empty($id_rol)) {
            \Lib\Alert::error('Error', 'El Rol Id no puede estar vacio.');
            header("Location:" . APP_URL . "roles");
            exit;
        }
        $rolesModel = new Role();
        if($rolesModel->delete($id_rol)) {
            \Lib\Alert::success('Exito', 'Role Eliminado Con Exito');
            header("Location:" . APP_URL . "roles");
        }else{
            \Lib\Alert::error('Error', 'El Rol No Pudo Ser Eliminado');
            header("Location:" . APP_URL . "roles");
        }
    }
}
