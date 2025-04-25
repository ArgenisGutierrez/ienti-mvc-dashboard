<?php

/**
 * Controlador para la gestión integral de usuarios
 * 
 * Maneja operaciones CRUD, gestión de perfiles y actualización de imágenes,
 * incluyendo validaciones de seguridad y flujos de trabajo específicos.
 */

namespace App\Controllers;

use App\Models\Usuario;
use App\Models\Role;
use Exception;
use Lib\Alert;

class UsuarioController extends Controller
{
    /**
     * @var Usuario Modelo de usuarios
     */
    protected $usuarioModel;

    /**
     * @var Role Modelo de roles
     */
    protected $roleModel;

    /**
     * @var string Directorio de subida de imágenes
     */
    protected $uploadDir;

    public function __construct()
    {
        $this->usuarioModel = new Usuario();
        $this->roleModel = new Role();
        $this->uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/files/';
        $this->ensureUploadDirExists();
    }

    /**
     * Muestra el listado de usuarios con sus roles
     *
     * @return Response Vista de usuarios
     */
    public function index()
    {
        return $this->view(
            'usuarios',
            [
            'usuarios' => $this->usuarioModel->getAllUsuarios(),
            'roles' => $this->roleModel->getAllRoles()
            ]
        );
    }

    /**
     * Muestra el perfil del usuario actual
     *
     * @return Response Vista de perfil
     */
    public function perfil()
    {
        $this->startSession();
        $usuario = $this->usuarioModel->getUsuario($_SESSION['usuario_id']);
        return $this->view('perfil', ['usuario' => $usuario]);
    }

    /**
     * Crea un nuevo usuario en el sistema
     *
     * @return Redirect Redirección con resultado
     */
    public function create()
    {
        try {
            $this->validateRequestMethod('POST');
            $data = $this->prepareUserData();

            if ($this->usuarioModel->create($data)) {
                Alert::success('Usuario creado', 'El usuario se creó correctamente');
            } else {
                Alert::error('Error', 'Error al crear el usuario');
            }
        } catch (Exception $e) {
            Alert::error('Error', $e->getMessage());
        }
        $this->redirectToUsuarios();
    }

    /**
     * Actualiza los datos de un usuario existente
     *
     * @param  int $id ID del usuario
     * @return Redirect Redirección con resultado
     */
    public function update($id)
    {
        try {
            $this->validateRequestMethod('POST');
            $data = $this->prepareUpdateData($id);

            if ($this->usuarioModel->update($data)) {
                Alert::success('Usuario actualizado', 'El usuario se actualizó correctamente');
            } else {
                Alert::error('Error', 'Error al actualizar el usuario');
            }
        } catch (Exception $e) {
            Alert::error('Error', $e->getMessage());
        }
        $this->redirectToUsuarios();
    }

    /**
     * Elimina un usuario del sistema
     *
     * @param  int $id ID del usuario
     * @return Redirect Redirección con resultado
     */
    public function delete($id)
    {
        try {
            $this->validateRequestMethod('POST');
            $this->validateAdminDeletion($id);
            $usuario = $this->usuarioModel->getUsuario($id);
            $this->deleteOldImage($usuario['imagen_usuario']);

            if ($this->usuarioModel->delete($id)) {
                Alert::success('Usuario eliminado', 'El usuario se eliminó correctamente');
            } else {
                Alert::error('Error', 'Error al eliminar el usuario');
            }
        } catch (Exception $e) {
            Alert::error('Error', $e->getMessage());
        }
        $this->redirectToUsuarios();
    }

    /**
     * Actualiza el perfil del usuario actual
     *
     * @param  int $id ID del usuario
     * @return Redirect Redirección con resultado
     */
    public function updatePerfil($id)
    {
        try {
            $this->validateRequestMethod('POST');
            $data = $this->prepareUpdateData($id);

            if ($this->usuarioModel->update($data)) {
                $this->updateSessionData($data);
                Alert::success('Perfil actualizado', 'Los datos se actualizaron correctamente');
            } else {
                Alert::error('Error', 'Error al actualizar el perfil');
            }
        } catch (Exception $e) {
            Alert::error('Error', $e->getMessage());
        }
        $this->redirectToUsuario();
    }

    /**
     * Actualiza la imagen de perfil del usuario
     *
     * @return Redirect Redirección con resultado
     */
    public function updateProfileImage()
    {
        try {
            $this->validateRequestMethod('POST');
            $id = $this->getValidatedUserId();
            $imagenData = $this->validateImageUpload();

            // Obtener imagen anterior
            $oldImage = $this->usuarioModel->getUsuario($id)['imagen_usuario'] ?? '';

            // Subir nueva imagen
            $newFileName = $this->uploadImageFile($imagenData);

            // Actualizar base de datos
            if ($this->usuarioModel->updateImage($id, $newFileName)) {
                // Eliminar imagen anterior si existe
                $this->deleteOldImage($oldImage);

                // Actualizar sesión
                $this->updateSessionImage($newFileName);

                Alert::success('Éxito', 'Imagen actualizada correctamente');
            } else {
                throw new Exception('Error al actualizar en base de datos');
            }
        } catch (Exception $e) {
            Alert::error('Error', $e->getMessage());

            // Eliminar archivo subido si hubo error
            if (isset($newFileName) && file_exists($this->uploadDir . $newFileName)) {
                unlink($this->uploadDir . $newFileName);
            }
        }
        $this->redirectToUsuario();
    }

    /************************************
     * Métodos auxiliares protegidos *
     ************************************/

    /**
     * Prepara los datos para creación de usuario
     */
    protected function prepareUserData(): array
    {

        if ($_POST['password_usuario'] !== $_POST['password_usuario2']) {
            throw new Exception('Las contraseñas no coinciden');
        }

        return [
        'nombre_usuario' => $this->sanitizeInput($_POST['nombre_usuario']),
        'password_usuario' => password_hash($_POST['password_usuario'], PASSWORD_DEFAULT),
        'verification_token' => bin2hex(random_bytes(25)),
        'email_usuario' => $this->sanitizeEmail($_POST['email_usuario']),
        'id_rol' => (int)$_POST['id_rol'],
        'fyh_creacion' => date('Y-m-d H:i:s'),
        'estado' => 1
        ];
    }

    /**
     * Prepara los datos para actualización de usuario
     */
    protected function prepareUpdateData(int $id): array
    {

        return [
        'id_usuario' => $id,
        'nombre_usuario' => $this->sanitizeInput($_POST['nombre_usuario']),
        'email_usuario' => $this->sanitizeEmail($_POST['email_usuario']),
        'id_rol' => (int)$_POST['id_rol'],
        'fyh_modificacion' => date('Y-m-d H:i:s'),
        'estado' => (int)($_POST['estado'] ?? 1)
        ];
    }

    /**
     * Valida la eliminación de administradores
     */
    protected function validateAdminDeletion(int $id): void
    {
        $usuario = $this->usuarioModel->getUsuario($id);
        $adminCount = $this->usuarioModel->countAdmins();

        if ($usuario['id_rol'] === 1 && $adminCount === 1) {
            throw new Exception("No se puede eliminar al último administrador");
        }
    }

    /**
     * Valida y procesa la subida de imagen
     */
    protected function validateImageUpload(): array
    {
        if (!isset($_FILES['imagen_usuario']) || $_FILES['imagen_usuario']['error'] !== UPLOAD_ERR_OK) {
            throw new Exception('Debe seleccionar una imagen válida');
        }

        $file = $_FILES['imagen_usuario'];

        // Validar tipo de archivo
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($file['type'], $allowedTypes)) {
            throw new Exception('Formato de imagen no permitido (solo JPG, PNG o GIF)');
        }

        // Validar tamaño máximo (10MB)
        if ($file['size'] > 10 * 1024 * 1024) {
            throw new Exception('El tamaño máximo permitido es 10MB');
        }

        return $file;
    }

    /**
     * Sube el archivo al servidor
     */
    protected function uploadImageFile(array $fileData): string
    {
        $extension = pathinfo($fileData['name'], PATHINFO_EXTENSION);
        $newFileName = uniqid('user_') . '.' . $extension;
        $targetPath = $this->uploadDir . $newFileName;

        if (!move_uploaded_file($fileData['tmp_name'], $targetPath)) {
            throw new Exception('Error al subir el archivo al servidor');
        }

        return $newFileName;
    }

    /**
     * Elimina la imagen anterior de forma segura
     */
    protected function deleteOldImage(string $filename): void
    {
        if (!empty($filename)) {
            $filePath = $this->uploadDir . basename($filename);

            if (file_exists($filePath) && is_file($filePath)) {
                // Verificar que el archivo está dentro del directorio permitido
                $realPath = realpath($filePath);
                $realUploadDir = realpath($this->uploadDir);

                if (strpos($realPath, $realUploadDir) === 0) {
                    unlink($filePath);
                }
            }
        }
    }

    /**
     * Valida y obtiene el ID de usuario
     */
    protected function getValidatedUserId(): int
    {
        $id = (int)($_POST['id_usuario'] ?? 0);

        if ($id <= 0) {
            throw new Exception('ID de usuario inválido');
        }

        // Verificar que el usuario existe
        if (!$this->usuarioModel->getUsuario($id)) {
            throw new Exception('Usuario no encontrado');
        }

        return $id;
    }

    /**
     * Actualiza los datos de sesión del usuario
     */
    protected function updateSessionData(array $data): void
    {
        $this->startSession();
        $_SESSION['nombre'] = $data['nombre_usuario'];
        $_SESSION['email'] = $data['email_usuario'];
    }

    /**
     * Actualiza la imagen de perfil en sesión
     */
    protected function updateSessionImage(string $filename): void
    {
        $this->startSession();
        $_SESSION['imagen'] = $filename;
    }

    /**
     * Sanitiza entradas de texto
     */
    protected function sanitizeInput(string $input): string
    {
        return trim(htmlspecialchars($input, ENT_QUOTES, 'UTF-8'));
    }

    /**
     * Sanitiza direcciones de email
     */
    protected function sanitizeEmail(string $email): string
    {
        $cleanEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
        if (!filter_var($cleanEmail, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('El email no es válido');
        }
        return $cleanEmail;
    }

    /**
     * Valida el método de solicitud HTTP
     */
    protected function validateRequestMethod(string $expectedMethod): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== strtoupper($expectedMethod)) {
            throw new Exception('Método no permitido');
        }
    }

    /**
     * Asegura la existencia del directorio de uploads
     */
    protected function ensureUploadDirExists(): void
    {
        if (!file_exists($this->uploadDir)) {
            mkdir($this->uploadDir, 0755, true);
        }
    }

    /**
     * Inicia la sesión si no está activa
     */
    protected function startSession(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Redirección a lista de usuarios
     */
    protected function redirectToUsuarios(): void
    {
        header("Location: " . APP_URL . "usuarios");
        exit;
    }

    /**
     * Redirección a perfil de usuario
     */
    protected function redirectToUsuario(): void
    {
        header("Location: " . APP_URL . "usuario");
        exit;
    }
}
