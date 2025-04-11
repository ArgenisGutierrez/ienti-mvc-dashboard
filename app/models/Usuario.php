<?php
/* ========================================================
 * ============ Modelo de Usuario ======================
 * ======================================================*/

namespace App\Models;

class Usuario extends Conexion
{
    protected $table = 'usuarios';

    public function getAllUsuarios()
    {
        try {
            $stmt = $this->getConexion()->query("SELECT u.nombre_usuario,r.nombre_rol,u.email_usuario,ubfyh_creacion,u.estado FROM {$this->table} u JOIN roles r ON r.id_rol = u.id_rol");
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            return [];
        }
    }
}
