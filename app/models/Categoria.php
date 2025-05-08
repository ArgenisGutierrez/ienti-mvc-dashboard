<?php

namespace App\Models;

/**
 * Modelo para gestión de categorías y subcategorías en la base de datos
 * 
 * @package App\Models
 * @extends Conexion
 * 
 * @example
 * $categoria = new Categoria();
 * $todasCategorias = $categoria->getAllCategorias();
 */
class Categoria extends Conexion
{
    /**
     * Nombre de la tabla principal de categorías
     *
     * @var string
     */
    protected $table = 'categorias';

    /**
     * Obtiene todas las categorías registradas
     * 
     * @return array Listado de categorías con todos sus campos
     */
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

    /**
     * Obtiene todas las subcategorías con información de su categoría padre
     * 
     * @return array Listado de subcategorías con campos:
     *               id_subcategoria, nombre_subcategoria, id_categoria, nombre_categoria
     */
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

    /**
     * Crea una nueva categoría
     * 
     * @param  string $categoria Nombre de la nueva categoría
     * @return bool True si la operación fue exitosa
     */
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

    /**
     * Crea una nueva subcategoría
     * 
     * @param  array $datos Datos requeridos para la subcategoría:
     *                      - id_categoria (int) ID de la categoría padre
     *                      - nombre_subcategoria (string) Nombre de la subcategoría
     * @return bool True si la operación fue exitosa
     */
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

    /**
     * Actualiza una categoría existente
     * 
     * @param  array $datos Datos para actualizar:
     *                      - id_categoria (int) ID de la categoría a modificar
     *                      - nombre_categoria (string) Nuevo nombre para la categoría
     * @return bool True si la actualización fue exitosa
     */
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


    /**
     * Actualiza una subcategoría existente
     * 
     * @param  array $datos Datos para actualizar:
     *                      - id_subcategoria (int) ID de la subcategoría
     *                      - id_categoria (int) Nuevo ID de categoría padre
     *                      - nombre_subcategoria (string) Nuevo nombre
     * @return bool True si la actualización fue exitosa
     */
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

    /**
     * Elimina una categoría
     * 
     * @param  int $id_categoria ID de la categoría a eliminar
     * @return bool True si la eliminación fue exitosa
     */
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

    /**
     * Elimina una subcategoría
     * 
     * @param  int $id_subcategoria ID de la subcategoría a eliminar
     * @return bool True si la eliminación fue exitosa
     */
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

    /**
     * Obtiene subcategorías relacionadas a una categoría específica
     * 
     * @param  int $id_categoria ID de la categoría padre
     * @return array|null Listado de subcategorías o null en caso de error
     */
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

    /**
     * Obtiene recursos asociados a una subcategoría
     * 
     * @param  int $id_subcategoria ID de la subcategoría
     * @return array|null Listado de recursos con descripción o null en caso de error
     */
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
