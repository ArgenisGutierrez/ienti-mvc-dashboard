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
}
