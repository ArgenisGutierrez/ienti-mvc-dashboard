<?php
/**
 * Controlador para la gestión de usuarios
 * 
 * Maneja las operaciones CRUD para los usuarios del sistema incluyendo:
 * - Listado de usuarios
 * - Obtención de datos de un usuario
 * - Creación de nuevos usuarios
 * - Actualización de usuarios existentes
 * - Eliminación de usuarios
 */

namespace App\Controllers;
use App\Models\Usuario;
use App\Models\Role;
use Exception;

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
        $verification_token = bin2hex(random_bytes(50));
        if($usuarioModel->create(
            [
              'nombre_usuario' => $nombre,
              'password_usuario' => $passwordHash,
              'verification_token' => $verification_token,
              'email_usuario' => $email,
              'id_rol' => $id_rol,
              'fyh_creacion' => date('Y-m-d H:i:s'),
              'estado'=>'1'
            ]
        )
        ) {
            \Lib\Alert::success('Usuario creado', 'El usuario se creo correctamente');
            header("Location:" . APP_URL . "usuarios");
            exit();
        }else{
            \Lib\Alert::error('Error', 'El usuario no se pudo crear en la base de datos');
            header("Location:" . APP_URL . "usuarios");
            exit();
        }
    }

    public function update($id)
    {
        $usuarioModel = new Usuario();
        // Verificar método POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            \Lib\Alert::info('Error', 'Acceso Denegado');
            header("Location:" . APP_URL . "usuarios");
            exit();
        }

        // Obtener datos
        $id_usuario = $id ?? null;
        $nombre_usuario = trim($_POST['nombre_usuario'] ?? '');
        $email_usuario = trim($_POST['email_usuario'] ?? '');
        $id_rol = $_POST['id_rol'] ?? null;
        $estado = $_POST['estado'] ?? null;

        // Validaciones
        if(empty($id_usuario) || empty($nombre_usuario) || empty($email_usuario) || empty($id_rol)) {
            \Lib\Alert::error('Error', 'Todos los campos son obligatorios');
            header("Location:" . APP_URL . "usuarios");
            exit();
        }

        //Actualicar en la base de datos
        if($usuarioModel->update(
            [
              'id_usuario' => $id_usuario,
              'nombre_usuario' => $nombre_usuario,
              'email_usuario' => $email_usuario,
              'id_rol' => $id_rol,
              'fyh_modificacion' => date('Y-m-d H:i:s'),
              'estado' => $estado
            ]
        )
        ) {
            \Lib\Alert::success('Usuario actualizado', 'El usuario se actualizo correctamente');
        }else {
            \Lib\Alert::error('Error', 'El usuario no se pudo actualizar en la base de datos');
        }
        header("Location:" . APP_URL . "usuarios");
        exit();
    }

    public function delete($id)
    {
        $usuarioModel = new Usuario();
        // Verificar método POST y existencia de ID
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($id)) {
            \Lib\Alert::error('Error', 'Acceso Denegado');
            header("Location:" . APP_URL . "ususarios");
            exit();
        }

        try {
            if (!$id || $id <= 0) {
                throw new Exception("ID de usuario inválido");
            }

            // Verificar si es el último administrador
            $adminCount = $usuarioModel->countAdmins();

            $rolUsuario = $usuarioModel->getUsuario($id);

            if ($rolUsuario['nombre_rol'] === 'Administrador' && $adminCount === 1) {
                throw new Exception("No se puede eliminar al último administrador");
            }

            // Eliminar usuario
            if($usuarioModel->delete($id)) {
                \Lib\Alert::success('Usuario eliminado', 'El usuario se elimino correctamente');
            }else {
                \Lib\Alert::error('Error', 'El usuario no se pudo eliminar en la base de datos');
            }
        } catch (Exception $e) {
            \Lib\Alert::error('Error', $e->getMessage());
        }
        header("Location:" . APP_URL . "usuarios");
        exit();
    }
}
