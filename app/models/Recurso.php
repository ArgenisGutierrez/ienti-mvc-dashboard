<?php
/* ========================================================
 * ============ Modelo de Recursos ======================
 * ======================================================*/

namespace App\Models;

class Recurso extends Conexion
{
    protected $table = 'recursos';

    public function getAllRecursos()
    {
        try {
            $stmt = $this->getConexion()->query("SELECT * FROM {$this->table}");
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            return [];
        }
    }

    public function getRecurso($id)
    {
        try {
            $stmt = $this->getConexion()->query("SELECT * FROM {$this->table} WHERE id_recurso = $id");
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            return [];
        }
    }

    public function create($data)
    {
        try {
            $pdo = $this->getConexion();
            $sentencia = $pdo->prepare(
                "INSERT INTO {$this->table} 
        (descripcion_recurso, clasificacion_recurso, tipo_recurso, contenido_recurso, fyh_creacion, estado)
        VALUES 
        (:descripcion, :clasificacion, :tipo, :contenido, :fyh_creacion, :estado)"
            );

            $sentencia->execute(
                [
                ':descripcion' => $data['descripcion_recurso'],
                ':clasificacion' => $data['clasificacion_recurso'],
                ':tipo' => $data['tipo_recurso'],
                ':contenido' => $data['contenido_recurso'],
                ':fyh_creacion'=>$data['fyh_creacion'],
                ':estado' => $data['estado']
                ]
            );
            return true;
        } catch(\Throwable $th) {
            return false;
        }
    }

    public function delete($id)
    {
        try {
            $pdo = $this->getConexion();
            $sentencia = $pdo->prepare("DELETE FROM {$this->table} WHERE id_recurso = :id");
            $sentencia->execute([':id' => $id]);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
