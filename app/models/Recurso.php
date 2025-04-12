<?php
/**
 * Modelo para la gestión de recursos en el sistema
 * 
 * Proporciona métodos para operaciones CRUD sobre la tabla de recursos
 */
namespace App\Models;

use PDO;
use Throwable;

class Recurso extends Conexion
{
    /**
     * @var string Nombre de la tabla en la base de datos
     */
    protected $table = 'recursos';

    /**
     * Obtiene todos los recursos registrados
     *
     * @return array Listado de recursos o array vacío en caso de error
     */
    public function getAllRecursos(): array
    {
        try {
            $stmt = $this->getConexion()->query("SELECT * FROM {$this->table}");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Throwable $e) {
            return [];
        }
    }

    /**
     * Obtiene un recurso específico por su ID
     *
     * @param  int $id ID del recurso a buscar
     * @return array Datos del recurso o array vacío en caso de error
     */
    public function getRecurso(int $id): array
    {
        try {
            $sql = "SELECT * FROM {$this->table} WHERE id_recurso = :id";
            $stmt = $this->getConexion()->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetch(PDO::FETCH_ASSOC) ?: [];
        } catch (Throwable $e) {
            return [];
        }
    }

    /**
     * Crea un nuevo recurso en la base de datos
     *
     * @param  array $data Datos del recurso a crear
     * @return bool Resultado de la operación
     */
    public function create(array $data): bool
    {
        try {
            $sql = "INSERT INTO {$this->table} 
                    (descripcion_recurso, clasificacion_recurso, tipo_recurso, 
                     contenido_recurso, fyh_creacion, estado)
                    VALUES 
                    (:descripcion, :clasificacion, :tipo, :contenido, :fyh_creacion, :estado)";

            $stmt = $this->getConexion()->prepare($sql);
            
            return $stmt->execute(
                [
                ':descripcion'     => $data['descripcion_recurso'],
                ':clasificacion'    => $data['clasificacion_recurso'],
                ':tipo'             => $data['tipo_recurso'],
                ':contenido'       => $data['contenido_recurso'],
                ':fyh_creacion'     => $data['fyh_creacion'],
                ':estado'          => $data['estado']
                ]
            );
        } catch (Throwable $e) {
            return false;
        }
    }

    /**
     * Actualiza un recurso existente
     *
     * @param  array $data Datos actualizados del recurso
     * @return bool Resultado de la operación
     */
    public function update(array $data): bool
    {
        try {
            $sql = "UPDATE {$this->table} 
                    SET 
                        descripcion_recurso = :descripcion,
                        clasificacion_recurso = :clasificacion,
                        tipo_recurso = :tipo,
                        contenido_recurso = :contenido,
                        fyh_modificacion = :fyh_modificacion
                    WHERE id_recurso = :id_recurso";

            $stmt = $this->getConexion()->prepare($sql);
            
            return $stmt->execute(
                [
                ':descripcion'        => $data['descripcion_recurso'],
                ':clasificacion'      => $data['clasificacion_recurso'],
                ':tipo'               => $data['tipo_recurso'],
                ':contenido'          => $data['contenido_recurso'],
                ':fyh_modificacion'   => $data['fyh_modificacion'],
                ':id_recurso'         => $data['id_recurso']
                ]
            );
        } catch (Throwable $e) {
            return false;
        }
    }

    /**
     * Elimina un recurso de la base de datos
     *
     * @param  int $id ID del recurso a eliminar
     * @return bool Resultado de la operación
     */
    public function delete(int $id): bool
    {
        try {
            $sql = "DELETE FROM {$this->table} WHERE id_recurso = :id";
            $stmt = $this->getConexion()->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            
            return $stmt->execute();
        } catch (Throwable $e) {
            return false;
        }
    }
}
