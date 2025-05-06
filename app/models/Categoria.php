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
      $sql = "SELECT * FROM subcategorias s JOIN categorias c ON s.id_categoria = c.id_categoria";
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
}
