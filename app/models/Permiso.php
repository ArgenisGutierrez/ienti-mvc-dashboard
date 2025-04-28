<?php
/*
 * Modelo para la gestión de permisos de los usuarios
 * 
 * Proporciona métodos para operaciones CRUD sobre la tabla de role_permiso
 */

namespace App\Models;

class Permiso extends Conexion
{
  /**
   * @var string Nombre de la tabla en la base de datos
   */
  protected $table = 'role_permiso';

  public function getAllPermisos()
  {
    try {
      $stmt = $this->getConexion()->query("SELECT * FROM permisos");
      return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    } catch (\Throwable $th) {
      return null;
    }
  }

  public function addPermiso($datos)
  {
    try {
      $stmt = $this->getConexion()->prepare("INSERT INTO {$this->table} (id_permiso,id_rol) VALUES (:id_permiso,:id_rol)");
      $stmt->execute(
        [
          'id_permiso' => $datos['id_permiso'],
          'id_rol' => $datos['id_rol']
        ]
      );
      return true;
    } catch (\Throwable $th) {
      return false;
    }
  }
  public function getPermisosByRol($id_rol)
  {
    try {
      $stmt = $this->getConexion()->prepare("SELECT id_permiso FROM {$this->table} WHERE id_rol = :id_rol");
      $stmt->execute(['id_rol' => $id_rol]);
      return $stmt->fetchAll(\PDO::FETCH_COLUMN);
    } catch (\Throwable $th) {
      return null;
    }
  }

  public function getNombrePermisoById($id_rol)
  {
    try {
      $sql = "SELECT nombre_permiso FROM permisos p JOIN role_permiso rp ON p.id_permiso = rp.id_permiso JOIN roles r ON rp.id_rol = r.id_rol WHERE r.id_rol = :id_rol";
      $stmt = $this->getConexion()->prepare($sql);
      $stmt->execute(['id_rol' => $id_rol]);
      return $stmt->fetchAll(\PDO::FETCH_COLUMN);
    } catch (\Throwable $th) {
      return [];
    }
  }

  public function deletePermiso($id_permiso, $id_rol)
  {
    try {
      $stmt = $this->getConexion()->prepare("DELETE FROM {$this->table} WHERE id_permiso = :id_permiso AND id_rol = :id_rol");
      $stmt->execute(['id_permiso' => $id_permiso, 'id_rol' => $id_rol]);
      return true;
    } catch (\Throwable $th) {
      return false;
    }
  }
  public function deleteAllPermisos($id_rol)
  {
    try {
      $stmt = $this->getConexion()->prepare("DELETE FROM {$this->table} WHERE id_rol = :id_rol");
      $stmt->execute(['id_rol' => $id_rol]);
      return true;
    } catch (\Throwable $th) {
      return false;
    }
  }
}
