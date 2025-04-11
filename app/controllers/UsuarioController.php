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

    public function create()
    {
        $usuarioModel= new Usuario();
        // Verificar método POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            \Lib\Alert::info('Acceso Denegado', 'No tienes permiso para acceder a esta ruta');
            header("Location:" . APP_URL . "usuarios");
            exit;
        }

        // Obtener y sanitizar datos
        $nombre = trim($_POST['nombre_usuario'] ?? '');
        $password = $_POST['password_usuario'] ?? '';
        $email = trim($_POST['email_usuario'] ?? '');
        $id_rol = $_POST['id_rol'] ?? null;

        // Validaciones básicas
        if (empty($nombre) || empty($password) || empty($email) || empty($id_rol)) {
            \Lib\Alert::error('Error', 'Todos los campos son obligatorios');
            header("Location:" . APP_URL . "usuarios");
            exit;
        }

        // Validar que las contraseñas coincidan (si aplica)
        if ($_POST['password_usuario'] !== $_POST['password_usuario2']) {
            \Lib\Alert::error('Error', 'Las contraseñas no coinciden');
            header("Location:" . APP_URL . "ususarios");
            exit;
        }

        // Hash de contraseña
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        if($usuarioModel->create(
            [
              'nombre_usuario' => $nombre,
              'password_usuario' => $passwordHash,
              'email_usuario' => $email,
              'id_rol' => $id_rol,
              'fyh_creacion' => date('Y-m-d H:i:s'),
              'estado'=>'1'
            ]
        )
        ) {
            \Lib\Alert::success('Usuario creado', 'El usuario se creo correctamente');
            header("Location:" . APP_URL . "usuarios");
            exit;
        }else{
            \Lib\Alert::error('Error', 'El usuario no se pudo crear en la base de datos');
            header("Location:" . APP_URL . "usuarios");
            exit;
        }
    }
}
