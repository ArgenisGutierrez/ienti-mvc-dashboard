<?php

/**
 * Controlador para la gestión de roles de usuarios
 * 
 * Maneja las operaciones CRUD para los roles del sistema incluyendo:
 * - Listado de roles
 * - Creación de nuevos roles
 * - Actualización de roles existentes
 * - Eliminación de roles
 */

namespace App\Controllers;

use App\Models\Role;
use App\Models\Permiso;
use Lib\Alert;

class RoleController extends Controller
{
    /**
     * @var Role Modelo de roles
     */
    private $roleModel;
    private $permisoModel;

    /**
     * Constructor: Inicializa el modelo de roles
     */
    public function __construct()
    {
        $this->roleModel = new Role();
        $this->permisoModel = new Permiso();
    }

    /**
     * Muestra el listado de todos los roles
     *
     * @return Response Vista de listado de roles
     */
    public function index()
    {
        $roles = $this->roleModel->getAllRoles();
        foreach ($roles as &$rol) {
            $rol['permisos'] = $this->permisoModel->getPermisosByRol($rol['id_rol']);
        }
        return $this->view(
            'roles',
            [
            'roles' => $roles,
            'permisos' => $this->permisoModel->getAllPermisos()
            ]
        );
    }

    /**
     * Crea un nuevo rol en el sistema
     *
     * @return Redirect Redirección al listado de roles con notificación
     */
    public function create()
    {
        $nombreRol = $this->sanitizeInput($_POST['nombre_rol'] ?? '');

        if (!$this->validateRoleName($nombreRol)) {
            $this->redirectWithAlert('error', 'Error', 'El nombre del rol no puede estar vacío', 'roles');
        }

        $result = $this->roleModel->createRole(
            [
            'nombre_rol' => $nombreRol,
            'fechaHora' => date('Y-m-d H:i:s'),
            'estado' => '1'
            ]
        );
        if ($result) {
            $idRol = $this->roleModel->getIdByName($nombreRol);
            foreach ($_POST['permisos'] as $permiso) {
                $this->permisoModel->addPermiso(
                    [
                    'id_permiso' => $permiso,
                    'id_rol' => $idRol
                    ]
                );
            }
        }

        $this->handleOperationResult(
            $result,
            'Role Creado Con Éxito',
            'El Rol No Pudo Ser Creado',
            'roles'
        );
    }

    /**
     * Actualiza un rol existente
     *
     * @param  int|string $id_rol ID del rol a actualizar
     * @return Redirect Redirección al listado de roles con notificación
     */
    public function update($id_rol)
    {
        $idRol = (int)$id_rol;
        $nombreRol = $this->sanitizeInput($_POST['nombre_rol'] ?? '');

        if (!$this->validateRoleName($nombreRol)) {
            $this->redirectWithAlert('error', 'Error', 'El nombre del rol no puede estar vacío', 'roles');
        }

        $result = $this->roleModel->update(
            [
            'id_rol' => $idRol,
            'nombre_rol' => $nombreRol,
            'fechaHora' => date('Y-m-d H:i:s')
            ]
        );

        $this->handleOperationResult(
            $result,
            'Role Actualizado Con Éxito',
            'El Rol No Pudo Ser Actualizado',
            'roles'
        );
    }

    /**
     * Elimina un rol del sistema
     *
     * @param  int|string $id_rol ID del rol a eliminar
     * @return Redirect Redirección al listado de roles con notificación
     */
    public function delete($id_rol)
    {
        $idRol = (int)$id_rol;

        if ($idRol <= 0) {
            $this->redirectWithAlert('error', 'Error', 'ID de rol inválido', 'roles');
        }

        $result = $this->roleModel->delete($idRol);

        $this->handleOperationResult(
            $result,
            'Role Eliminado Con Éxito',
            'El Rol No Pudo Ser Eliminado',
            'roles'
        );
    }

    /**
     * Valida el nombre del rol
     *
     * @param  string $name Nombre a validar
     * @return bool Resultado de la validación
     */
    private function validateRoleName(string $name): bool
    {
        return !empty(trim($name));
    }

    /**
     * Sanitiza el input del usuario
     *
     * @param  string $input Entrada a sanitizar
     * @return string Texto sanitizado en mayúsculas
     */
    private function sanitizeInput(string $input): string
    {
        return mb_strtoupper(trim($input), 'UTF-8');
    }

    /**
     * Maneja el resultado de las operaciones CRUD
     *
     * @param bool   $result         Resultado de la
     *                               operación
     * @param string $successMessage Mensaje de éxito
     * @param string $errorMessage   Mensaje de error
     * @param string $redirectPath   Ruta para
     *                               redirección
     */
    private function handleOperationResult(
        bool $result,
        string $successMessage,
        string $errorMessage,
        string $redirectPath
    ) {
        if ($result) {
            $this->redirectWithAlert('success', 'Éxito', $successMessage, $redirectPath);
        }

        $this->redirectWithAlert('error', 'Error', $errorMessage, $redirectPath);
    }

    /**
     * Redirecciona con notificación flash
     *
     * @param string $type    Tipo de alerta (success/error)
     * @param string $title   Título de la
     *                        alerta
     * @param string $message Contenido de la alerta
     * @param string $path    Ruta destino
     */
    private function redirectWithAlert(
        string $type,
        string $title,
        string $message,
        string $path
    ) {
        Alert::$type($title, $message);
        header("Location: " . APP_URL . $path);
        exit();
    }
}
