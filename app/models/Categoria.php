<?php

namespace App\Models;

class Categoria extends Conexion
{
  protected $table = 'categorias';

  public function getAllCategorias(): array
  {
    try {
      $sql = "SELECT * FROM {$this->table}";
      $stmt = $this->getConexion()->query($sql);
      return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    } catch (Throwable $e) {
      return [];
    }
  }

  public function getAllSubcategorias(): array
  {
    try {
      $sql = "SELECT id_subcategoria,nombre_subcategoria ,c.id_categoria ,nombre_categoria FROM subcategorias s JOIN categorias c ON s.id_categoria = c.id_categoria";
      $stmt = $this->getConexion()->query($sql);
      return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    } catch (Throwable $e) {
      return [];
    }
  }

  public function createCategoria($categoria): bool
  {
    try {
      $sql = "INSERT INTO {$this->table} (nombre_categoria) VALUES (:nombre_categoria)";
      $stmt = $this->getConexion()->prepare($sql);
      $stmt->bindValue('nombre_categoria', $categoria);
      $stmt->execute();
      return true;
    } catch (Throwable $e) {
      return false;
    }
  }

  public function createSubcategoria($datos): bool
  {
    try {
      $sql = "INSERT INTO subcategorias (id_categoria, nombre_subcategoria) VALUES (:id_categoria, :nombre_subcategoria)";
      $stmt = $this->getConexion()->prepare($sql);
      $stmt->bindValue('id_categoria', $datos['id_categoria']);
      $stmt->bindValue('nombre_subcategoria', $datos['nombre_subcategoria']);
      $stmt->execute();
      return true;
    } catch (\Throwable $th) {
      return false;
    }
  }

  public function updateCategoria($datos): bool
  {
    try {
      $sql = "UPDATE {$this->table} SET nombre_categoria = :nombre_categoria WHERE id_categoria = :id_categoria";
      $stmt = $this->getConexion()->prepare($sql);
      $stmt->bindValue('id_categoria', $datos['id_categoria']);
      $stmt->bindValue('nombre_categoria', $datos['nombre_categoria']);
      $stmt->execute();
      return true;
    } catch (\Throwable $th) {
      return false;
    }
  }

  public function updateSubcategoria($datos): bool
  {
    try {
      $sql = "UPDATE subcategorias SET nombre_subcategoria =:nombre_subcategoria, id_categoria = :id_categoria WHERE id_subcategoria = :id_subcategoria";
      $stmt = $this->getConexion()->prepare($sql);
      $stmt->bindValue('id_categoria', $datos['id_categoria']);
      $stmt->bindValue('nombre_subcategoria', $datos['nombre_subcategoria']);
      $stmt->bindValue('id_subcategoria', $datos['id_subcategoria']);
      $stmt->execute();
      return true;
    } catch (\Throwable $th) {
      return false;
    }
  }

  public function deleteCategoria($id_categoria): bool
  {
    try {
      $sql =  "DELETE FROM {$this->table} WHERE id_categoria = :id_categoria";
      $stmt = $this->getConexion()->prepare($sql);
      $stmt->bindValue('id_categoria', $id_categoria);
      $stmt->execute();
      return true;
    } catch (\Throwable $th) {
      return false;
    }
  }

  public function deleteSubcategoria($id_subcategoria): bool
  {
    try {
      $sql =  "DELETE FROM subcategorias WHERE id_subcategoria = :id_subcategoria";
      $stmt = $this->getConexion()->prepare($sql);
      $stmt->bindValue('id_subcategoria', $id_subcategoria);
      $stmt->execute();
      return true;
    } catch (\Throwable $th) {
      return false;
    }
  }

  public function getSubcategoriasByCategoria($id_categoria): array
  {
    try {
      $sql = "SELECT * FROM categorias c JOIN subcategorias s ON c.id_categoria = s.id_categoria WHERE c.id_categoria = :id_categoria";
      $stmt = $this->getConexion()->prepare($sql);
      $stmt->bindValue('id_categoria', $id_categoria);
      $stmt->execute();
      return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    } catch (\Throwable $e) {
      return null;
    }
  }

  public function getRecursosBySubcategoria($id_subcategoria): array
  {
    try {
      $sql = "SELECT r.descripcion_recurso FROM recursos r JOIN subcategorias s ON r.id_subcategoria = s.id_subcategoria WHERE s.id_subcategoria = :id_subcategoria";
      $stmt = $this->getConexion()->prepare($sql);
      $stmt->bindValue('id_subcategoria', $id_subcategoria);
      $stmt->execute();
      return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    } catch (\Throwable $th) {
      return null;
    }
  }
}
