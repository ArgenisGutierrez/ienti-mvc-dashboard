<?php

/**
 * Controlador para la gestión de roles de usuarios
 * 
 * Maneja todas las operaciones CRUD para los roles del sistema incluyendo:
 * - Creación, lectura, actualización y eliminación de roles
 * - Gestión de permisos asociados a cada rol
 * - Validación y sanitización de datos
 * - Control de acceso basado en permisos
 * 
 * @package App\Controllers
 */

namespace App\Controllers;

use App\Models\Role;
use App\Models\Permiso;
use Lib\Alert;

class RoleController extends Controller
{
  /**
   * @var Role Instancia del modelo de Roles
   */
  private $roleModel;

  /**
   * @var Permiso Instancia del modelo de Permisos
   */
  private $permisoModel;

  /**
   * Constructor - Inicializa las dependencias del modelo
   */
  public function __construct()
  {
    $this->roleModel = new Role();
    $this->permisoModel = new Permiso();
  }

  /**
   * Muestra el listado completo de roles con sus permisos asociados
   *
   * @return View Vista de roles con datos estructurados
   */
  public function index()
  {
    // Obtener todos los roles con sus permisos
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
   * Crea un nuevo rol en el sistema con sus permisos asociados
   *
   * @return void Redirección con notificación de resultado
   */
  public function create()
  {
    session_start();
    // Validación de permisos de usuario
    if (!in_array("Crear Roles", $_SESSION["permisos"])) {
      $this->handleOperationResult(false, "", "No tienes permisos para crear roles", "roles");
    }

    // Sanitización y validación de datos
    $nombreRol = $this->sanitizeInput($_POST['nombre_rol'] ?? '');
    if (!$this->validateRoleName($nombreRol)) {
      $this->redirectWithAlert('error', 'Error', 'El nombre del rol no puede estar vacío', 'roles');
    }

    // Creación del rol en base de datos
    $result = $this->roleModel->createRole(
      [
        'nombre_rol' => $nombreRol,
        'fechaHora' => date('Y-m-d H:i:s'),
        'estado' => '1'
      ]
    );

    // Asignación de permisos si la creación fue exitosa
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
   * Actualiza un rol existente y sus permisos asociados
   *
   * @param  int|string $id_rol ID del rol a actualizar
   * @return void Redirección con notificación de resultado
   */
  public function update($id_rol)
  {
    session_start();
    // Validación de permisos de usuario
    if (!in_array("Editar Roles", $_SESSION["permisos"])) {
      $this->handleOperationResult(false, "", "No tienes permisos para editar roles", "roles");
    }

    // Procesamiento de datos
    $idRol = (int)$id_rol;
    $nombreRol = $this->sanitizeInput($_POST['nombre_rol'] ?? '');
    if (!$this->validateRoleName($nombreRol)) {
      $this->redirectWithAlert('error', 'Error', 'El nombre del rol no puede estar vacío', 'roles');
    }

    // Actualización del rol
    $result = $this->roleModel->update(
      [
        'id_rol' => $idRol,
        'nombre_rol' => $nombreRol,
        'fechaHora' => date('Y-m-d H:i:s')
      ]
    );

    // Sincronización de permisos
    $permisosAnteriores = $this->permisoModel->getPermisosByRol($id_rol);
    $permisosActualizados = $_POST['permisos'];

    // Eliminar permisos removidos
    foreach ($permisosAnteriores as $permisoAnterior) {
      if (!in_array($permisoAnterior, $permisosActualizados)) {
        $this->permisoModel->deletePermiso($permisoAnterior, $id_rol);
      }
    }

    // Agregar nuevos permisos
    foreach ($permisosActualizados as $permisoActualizado) {
      if (!in_array($permisoActualizado, $permisosAnteriores)) {
        $this->permisoModel->addPermiso(
          [
            'id_permiso' => $permisoActualizado,
            'id_rol' => $idRol
          ]
        );
      }
    }

    $this->handleOperationResult(
      $result,
      'Role Actualizado Con Éxito',
      'El Rol No Pudo Ser Actualizado',
      'roles'
    );
  }

  /**
   * Elimina un rol y todos sus permisos asociados
   *
   * @param  int|string $id_rol ID del rol a eliminar
   * @return void Redirección con notificación de resultado
   */
  public function delete($id_rol)
  {
    session_start();
    // Validación de permisos de usuario
    if (!in_array("Eliminar Roles", $_SESSION["permisos"])) {
      $this->handleOperationResult(false, "", "No tienes permisos para eliminar roles", "roles");
    }

    // Validación de ID
    $idRol = (int)$id_rol;
    if ($idRol <= 0) {
      $this->redirectWithAlert('error', 'Error', 'ID de rol inválido', 'roles');
    }

    // Eliminación en cascada de permisos primero
    if ($this->permisoModel->deleteAllPermisos($idRol)) {
      $result = $this->roleModel->delete($idRol);
    }

    $this->handleOperationResult(
      $result,
      'Role Eliminado Con Éxito',
      'El Rol No Pudo Ser Eliminado',
      'roles'
    );
  }

  /************************************
   * Métodos auxiliares privados *
   ************************************/

  /**
   * Valida que el nombre del rol no esté vacío
   *
   * @param  string $name Nombre del rol a validar
   * @return bool Resultado de la validación
   */
  private function validateRoleName(string $name): bool
  {
    return !empty(trim($name));
  }

  /**
   * Sanitiza el texto de entrada convirtiendo a mayúsculas
   *
   * @param  string $input Texto a sanitizar
   * @return string Texto sanitizado
   */
  private function sanitizeInput(string $input): string
  {
    return mb_strtoupper(trim($input), 'UTF-8');
  }

  /**
   * Centraliza el manejo de resultados de operaciones
   *
   * @param bool   $result         Resultado de la
   *                               operación
   * @param string $successMessage Mensaje de éxito
   * @param string $errorMessage   Mensaje de error
   * @param string $redirectPath   Ruta de
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
   * Maneja redirecciones con notificaciones flash
   *
   * @param string $type    Tipo de alerta (success/error/info)
   * @param string $title   Título de la
   *                        alerta
   * @param string $message Contenido del mensaje
   * @param string $path    Ruta de destino
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
