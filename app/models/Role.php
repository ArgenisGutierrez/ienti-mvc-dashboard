<?php

/**
 * Modelo para la gestión de roles de usuario
 * 
 * Proporciona operaciones CRUD para la tabla de roles y gestión de permisos
 */

namespace App\Models;

use PDO;
use Throwable;

class Role extends Conexion
{
  /**
   * @var string $table Nombre de la tabla en la base de datos
   */
  protected $table = 'roles';

  /**
   * Obtiene todos los roles registrados
   * 
   * @return array Listado de roles con todos sus campos
   */
  public function getAllRoles(): array
  {
    try {
      $sql = "SELECT 
                        id_rol,
                        nombre_rol,
                        fyh_creacion,
                        fyh_modificacion,
                        estado
                    FROM {$this->table}";

      $stmt = $this->getConexion()->query($sql);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Throwable $e) {
      error_log('Error en getAllRoles: ' . $e->getMessage());
      return [];
    }
  }

  /**
   * Obtiene el ID de un rol por su nombre
   * 
   * @param  string $name Nombre del rol a buscar
   * @return int|null ID del rol o null si no existe
   */
  public function getIdByName(string $name): ?int
  {
    try {
      $sql = "SELECT id_rol FROM {$this->table} WHERE nombre_rol = :name";
      $stmt = $this->getConexion()->prepare($sql);
      $stmt->execute([':name' => $name]);

      return $stmt->fetchColumn() ?: null;
    } catch (Throwable $e) {
      error_log("Error en getIdByName(Name: {$name}): " . $e->getMessage());
      return null;
    }
  }

  /**
   * Crea un nuevo rol en el sistema
   * 
   * @param  array $data Datos del nuevo rol
   *                     Requiere: nombre_rol, fechaHora, estado
   * @return bool True si la creación fue exitosa
   */
  public function createRole(array $data): bool
  {
    try {
      $sql = "INSERT INTO {$this->table} (
                        nombre_rol,
                        fyh_creacion,
                        estado
                    ) VALUES (
                        :nombre_rol,
                        :fyh_creacion,
                        :estado
                    )";

      $stmt = $this->getConexion()->prepare($sql);

      return $stmt->execute(
        [
          ':nombre_rol'    => $data['nombre_rol'],
          ':fyh_creacion'  => $data['fechaHora'],
          ':estado'        => $data['estado']
        ]
      );
    } catch (Throwable $e) {
      error_log('Error en createRole: ' . $e->getMessage());
      return false;
    }
  }

  /**
   * Actualiza los datos de un rol existente
   * 
   * @param  array $data Datos actualizados del rol
   *                     Requiere: id_rol, nombre_rol, fechaHora
   * @return bool True si la actualización fue exitosa
   */
  public function update(array $data): bool
  {
    try {
      $sql = "UPDATE {$this->table}
                    SET
                        nombre_rol = :nombre_rol,
                        fyh_modificacion = :fyh_modificacion
                    WHERE id_rol = :id_rol";

      $stmt = $this->getConexion()->prepare($sql);

      return $stmt->execute(
        [
          ':id_rol'            => $data['id_rol'],
          ':nombre_rol'        => $data['nombre_rol'],
          ':fyh_modificacion' => $data['fechaHora']
        ]
      );
    } catch (Throwable $e) {
      error_log("Error en updateRole(ID: {$data['id_rol']}): " . $e->getMessage());
      return false;
    }
  }

  /**
   * Elimina un rol del sistema
   * 
   * @param  int $id_rol ID del rol a eliminar
   * @return bool True si la eliminación fue exitosa
   */
  public function delete(int $id_rol): bool
  {
    try {
      $sql = "DELETE FROM {$this->table} 
                    WHERE id_rol = :id_rol 
                    LIMIT 1";

      $stmt = $this->getConexion()->prepare($sql);
      $stmt->bindValue(':id_rol', $id_rol, PDO::PARAM_INT);

      return $stmt->execute();
    } catch (Throwable $e) {
      error_log("Error en deleteRole(ID: {$id_rol}): " . $e->getMessage());
      return false;
    }
  }
}
