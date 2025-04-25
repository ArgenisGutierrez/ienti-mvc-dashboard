<?php

/**
 * Modelo para la gestión de roles en la base de datos
 * 
 * Proporciona métodos para realizar operaciones CRUD sobre la tabla de roles
 */

namespace App\Models;

use PDO;
use Throwable;

class Role extends Conexion
{
  /**
   * @var string Nombre de la tabla en la base de datos
   */
  protected $table = 'roles';

  /**
   * Obtiene todos los registros de roles
   *
   * @return array Listado de roles o array vacío en caso de error
   */
  public function getAllRoles(): array
  {
    try {
      $query = "SELECT * FROM {$this->table}";
      $stmt = $this->getConexion()->query($query);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Throwable $e) {
      return [];
    }
  }

  /**
   * Obtener el ID de un rol por su nombre
   *
   * @return Int ID del rol
   */
  public function getIdByName($name): int
  {
    try {
      $stmt = "SELECT id_rol FROM {$this->table} WHERE nombre_rol = :name";
      $stmt = $this->getConexion()->prepare($stmt);
      $stmt->execute([':name' => $name]);
      return $stmt->fetchColumn();
    } catch (\Throwable $th) {
      return null;
    }
  }

  /**
   * Crea un nuevo rol en la base de datos
   *
   * @param  array $data Datos del rol a crear
   * @return bool Resultado de la operación
   */
  public function createRole(array $data): bool
  {
    try {
      $sql = "INSERT INTO {$this->table} 
                    (nombre_rol, fyh_creacion, estado) 
                    VALUES (:nombre_rol, :fyh_creacion, :estado)";

      $pdo = $this->getConexion();
      $stmt = $pdo->prepare($sql);

      $stmt->bindParam(':nombre_rol', $data['nombre_rol']);
      $stmt->bindParam(':fyh_creacion', $data['fechaHora']);
      $stmt->bindParam(':estado', $data['estado']);

      return $stmt->execute();
    } catch (Throwable $e) {
      return false;
    }
  }

  /**
   * Actualiza un rol existente
   *
   * @param  array $data Datos a actualizar
   * @return bool Resultado de la operación
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

      $stmt->bindParam(':id_rol', $data['id_rol']);
      $stmt->bindParam(':nombre_rol', $data['nombre_rol']);
      $stmt->bindParam(':fyh_modificacion', $data['fechaHora']);

      return $stmt->execute();
    } catch (Throwable $e) {
      return false;
    }
  }

  /**
   * Elimina un rol de la base de datos
   *
   * @param  int $id_rol ID del rol a eliminar
   * @return bool Resultado de la operación
   */
  public function delete(int $id_rol): bool
  {
    try {
      $sql = "DELETE FROM {$this->table} WHERE id_rol = :id_rol";
      $stmt = $this->getConexion()->prepare($sql);
      $stmt->bindParam(':id_rol', $id_rol);
      return $stmt->execute();
    } catch (Throwable $e) {
      return false;
    }
  }
}
