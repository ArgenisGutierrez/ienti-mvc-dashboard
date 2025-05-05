<?php

/**
 * Modelo para la gestión de permisos de usuarios
 * 
 * Gestiona la relación entre roles y permisos en la tabla role_permiso
 * Proporciona operaciones CRUD para la asignación de permisos a roles
 */

namespace App\Models;

class Permiso extends Conexion
{
  /**
   * @var string $table Nombre de la tabla de relación roles-permisos
   */
  protected $table = 'role_permiso';

  /**
   * Obtiene todos los permisos disponibles
   *
   * @return array|null Listado de permisos o null en caso de error
   */
  public function getAllPermisos()
  {
    try {
      $stmt = $this->getConexion()->query("SELECT * FROM permisos");
      return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    } catch (\Throwable $th) {
      error_log('Error en getAllPermisos: ' . $th->getMessage());
      return null;
    }
  }

  /**
   * Asigna un nuevo permiso a un rol
   *
   * @param  array $datos Array con id_permiso e id_rol
   * @return bool True si éxito, False si falla
   */
  public function addPermiso(array $datos)
  {
    try {
      $sql = "INSERT INTO {$this->table} (id_permiso, id_rol) VALUES (:id_permiso, :id_rol)";
      $stmt = $this->getConexion()->prepare($sql);
      return $stmt->execute(
        [
          'id_permiso' => $datos['id_permiso'],
          'id_rol' => $datos['id_rol']
        ]
      );
    } catch (\Throwable $th) {
      error_log('Error en addPermiso: ' . $th->getMessage());
      return false;
    }
  }

  /**
   * Obtiene los IDs de permisos asignados a un rol
   *
   * @param  int $id_rol ID del rol
   * @return array|null Listado de IDs de permisos o null en error
   */
  public function getPermisosByRol($id_rol)
  {
    try {
      $sql = "SELECT id_permiso FROM {$this->table} WHERE id_rol = :id_rol";
      $stmt = $this->getConexion()->prepare($sql);
      $stmt->execute(['id_rol' => $id_rol]);
      return $stmt->fetchAll(\PDO::FETCH_COLUMN);
    } catch (\Throwable $th) {
      error_log('Error en getPermisosByRol: ' . $th->getMessage());
      return null;
    }
  }

  /**
   * Obtiene nombres de permisos asociados a un rol
   *
   * @param  int $id_rol ID del rol
   * @return array Listado de nombres de permisos
   */
  public function getNombrePermisoById($id_rol)
  {
    try {
      $sql = "SELECT p.nombre_permiso 
                    FROM permisos p
                    JOIN role_permiso rp ON p.id_permiso = rp.id_permiso
                    JOIN roles r ON rp.id_rol = r.id_rol
                    WHERE r.id_rol = :id_rol";

      $stmt = $this->getConexion()->prepare($sql);
      $stmt->execute(['id_rol' => $id_rol]);
      return $stmt->fetchAll(\PDO::FETCH_COLUMN);
    } catch (\Throwable $th) {
      error_log('Error en getNombrePermisoById: ' . $th->getMessage());
      return [];
    }
  }

  /**
   * Elimina un permiso específico de un rol
   *
   * @param  int $id_permiso ID del permiso
   * @param  int $id_rol     ID del rol
   * @return bool True si éxito, False si falla
   */
  public function deletePermiso($id_permiso, $id_rol)
  {
    try {
      $sql = "DELETE FROM {$this->table} 
                    WHERE id_permiso = :id_permiso 
                    AND id_rol = :id_rol";

      $stmt = $this->getConexion()->prepare($sql);
      return $stmt->execute(
        [
          'id_permiso' => $id_permiso,
          'id_rol' => $id_rol
        ]
      );
    } catch (\Throwable $th) {
      error_log('Error en deletePermiso: ' . $th->getMessage());
      return false;
    }
  }

  /**
   * Elimina todos los permisos de un rol
   *
   * @param  int $id_rol ID del rol
   * @return bool True si éxito, False si falla
   */
  public function deleteAllPermisos($id_rol)
  {
    try {
      $sql = "DELETE FROM {$this->table} WHERE id_rol = :id_rol";
      $stmt = $this->getConexion()->prepare($sql);
      return $stmt->execute(['id_rol' => $id_rol]);
    } catch (\Throwable $th) {
      error_log('Error en deleteAllPermisos: ' . $th->getMessage());
      return false;
    }
  }
}
