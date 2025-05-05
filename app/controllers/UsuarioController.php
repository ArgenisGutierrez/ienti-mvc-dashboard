<?php

/**
 * Controlador para la gestión integral de usuarios
 * 
 * Maneja todas las operaciones relacionadas con usuarios incluyendo:
 * - Creación, lectura, actualización y eliminación (CRUD) de usuarios
 * - Gestión de perfiles y actualización de imágenes
 * - Validaciones de seguridad y controles de acceso
 * - Manejo de sesiones y permisos
 * 
 * @package App\Controllers
 */

namespace App\Controllers;

use App\Models\Usuario;
use App\Models\Role;
use Exception;
use Lib\Alert;

class UsuarioController extends Controller
{
    /**
     * @var Usuario Modelo para operaciones con usuarios
     */
    protected $usuarioModel;

    /**
     * @var Role Modelo para gestión de roles
     */
    protected $roleModel;

    /**
     * @var string Ruta absoluta del directorio para subida de archivos
     */
    protected $uploadDir;

    /**
     * Constructor - Inicializa dependencias y configuración
     */
    public function __construct()
    {
        $this->usuarioModel = new Usuario();
        $this->roleModel = new Role();
        $this->uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/files/';
        $this->ensureUploadDirExists();
    }

    /**
     * Muestra el listado completo de usuarios con sus roles asociados
     *
     * @return View Vista de usuarios con datos necesarios
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
     * Muestra el perfil del usuario actualmente autenticado
     *
     * @return View Vista de perfil con datos del usuario
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
     * @return void Redirección con notificación de resultado
     */
    public function create()
    {
        try {
            session_start();
            // Validación de permisos
            if (!in_array("Crear Usuarios", $_SESSION["permisos"])) {
                throw new Exception("No tienes permiso para crear usuarios");
            }

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
     * Actualiza la información de un usuario existente
     *
     * @param  int $id ID del usuario a actualizar
     * @return void Redirección con notificación de resultado
     */
    public function update($id)
    {
        try {
            session_start();
            // Validación de permisos
            if (!in_array("Editar Usuarios", $_SESSION["permisos"])) {
                throw new Exception("No tienes permiso para editar usuarios");
            }
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
     * @param  int $id ID del usuario a eliminar
     * @return void Redirección con notificación de resultado
     */
    public function delete($id)
    {
        try {
            session_start();
            // Validación de permisos
            if (!in_array("Eliminar Usuarios", $_SESSION["permisos"])) {
                throw new Exception("No tienes permiso para eliminar usuarios");
            }

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
     * Actualiza el perfil del usuario autenticado
     *
     * @param  int $id ID del usuario
     * @return void Redirección con notificación de resultado
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
     * @return void Redirección con notificación de resultado
     */
    public function updateProfileImage()
    {
        try {
            $this->validateRequestMethod('POST');
            $id = $this->getValidatedUserId();
            $imagenData = $this->validateImageUpload();

            // Manejo de imagen anterior
            $oldImage = $this->usuarioModel->getUsuario($id)['imagen_usuario'] ?? '';

            // Subir nueva imagen
            $newFileName = $this->uploadImageFile($imagenData);

            // Actualizar base de datos
            if ($this->usuarioModel->updateImage($id, $newFileName)) {
                // Eliminar imagen anterior de forma segura
                $this->deleteOldImage($oldImage);

                // Actualizar sesión
                $this->updateSessionImage($newFileName);

                Alert::success('Éxito', 'Imagen actualizada correctamente');
            } else {
                throw new Exception('Error al actualizar en base de datos');
            }
        } catch (Exception $e) {
            Alert::error('Error', $e->getMessage());

            // Limpieza de archivos en caso de error
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
     * Prepara los datos para creación de usuarios
     *
     * @return array Datos sanitizados y validados
     * @throws Exception Si las contraseñas no coinciden
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
     * Prepara los datos para actualización de usuarios
     *
     * @param  int $id ID del usuario
     * @return array Datos actualizados
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
     * Valida que no se elimine el último administrador
     *
     * @param  int $id ID del usuario a eliminar
     * @throws Exception Si se intenta eliminar el último admin
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
     * Valida la imagen subida
     *
     * @return array Datos del archivo validado
     * @throws Exception Si la imagen no cumple requisitos
     */
    protected function validateImageUpload(): array
    {
        if (!isset($_FILES['imagen_usuario']) || $_FILES['imagen_usuario']['error'] !== UPLOAD_ERR_OK) {
            throw new Exception('Debe seleccionar una imagen válida');
        }

        $file = $_FILES['imagen_usuario'];

        // Validar tipo MIME
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($file['type'], $allowedTypes)) {
            throw new Exception('Formato de imagen no permitido (solo JPG, PNG o GIF)');
        }

        // Validar tamaño máximo
        if ($file['size'] > 10 * 1024 * 1024) {
            throw new Exception('El tamaño máximo permitido es 10MB');
        }

        return $file;
    }

    /**
     * Sube el archivo al servidor
     *
     * @param  array $fileData Datos del archivo
     * @return string Nombre único del archivo
     * @throws Exception Si falla la subida
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
     * Elimina de forma segura la imagen anterior
     *
     * @param string $filename Nombre del archivo a eliminar
     */
    protected function deleteOldImage(string $filename): void
    {
        if (!empty($filename)) {
            $filePath = $this->uploadDir . basename($filename);

            if (file_exists($filePath) && is_file($filePath)) {
                // Prevenir directory traversal
                $realPath = realpath($filePath);
                $realUploadDir = realpath($this->uploadDir);

                if (strpos($realPath, $realUploadDir) === 0) {
                    unlink($filePath);
                }
            }
        }
    }

    /**
     * Obtiene y valida el ID de usuario
     *
     * @return int ID validado
     * @throws Exception Si el ID es inválido
     */
    protected function getValidatedUserId(): int
    {
        $id = (int)($_POST['id_usuario'] ?? 0);

        if ($id <= 0) {
            throw new Exception('ID de usuario inválido');
        }

        if (!$this->usuarioModel->getUsuario($id)) {
            throw new Exception('Usuario no encontrado');
        }

        return $id;
    }

    /**
     * Actualiza los datos de sesión
     *
     * @param array $data Nuevos datos del usuario
     */
    protected function updateSessionData(array $data): void
    {
        $this->startSession();
        $_SESSION['nombre'] = $data['nombre_usuario'];
        $_SESSION['email'] = $data['email_usuario'];
    }

    /**
     * Actualiza la imagen en la sesión
     *
     * @param string $filename Nuevo nombre de archivo
     */
    protected function updateSessionImage(string $filename): void
    {
        $this->startSession();
        $_SESSION['imagen'] = $filename;
    }

    /**
     * Sanitiza entradas de texto
     *
     * @param  string $input Entrada a sanitizar
     * @return string Texto sanitizado
     */
    protected function sanitizeInput(string $input): string
    {
        return trim(htmlspecialchars($input, ENT_QUOTES, 'UTF-8'));
    }

    /**
     * Sanitiza y valida direcciones de email
     *
     * @param  string $email Email a validar
     * @return string Email validado
     * @throws Exception Si el email es inválido
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
     * Valida el método HTTP utilizado
     *
     * @param  string $expectedMethod Método esperado
     * @throws Exception Si el método no coincide
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
     * Redirecciona al listado de usuarios
     */
    protected function redirectToUsuarios(): void
    {
        header("Location: " . APP_URL . "usuarios");
        exit;
    }

    /**
     * Redirecciona al perfil de usuario
     */
    protected function redirectToUsuario(): void
    {
        header("Location: " . APP_URL . "usuario");
        exit;
    }
}
