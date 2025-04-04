<?php
/* ========================================================
 * ============ Modelo de Roles ======================
 * ======================================================*/

namespace App\Models;

class Role extends Conexion
{
    protected $table = 'roles';

    public function getAllRoles()
    {
        try {
            $stmt = $this->getConexion()->query("SELECT * FROM {$this->table}");
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            return [];
        }
    }

    public function createRole($data)
    {
        extract($data);
        try{
            $stmt = $this->getConexion()->prepare("INSERT INTO roles ( nombre_rol,fyh_creacion,estado ) VALUES (:nombre_rol,:fyh_creacion,:estado)");
            $stmt->bindParam('nombre_rol', $nombre_rol);
            $stmt->bindParam('fyh_creacion', $fechaHora);
            $stmt->bindParam('estado', $estado);
            $stmt->execute();
            return true;
        }catch(\Throwable $th){
            return false;
        }
    }
}
