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
        try {
            $pdo = $this->getConexion();
            $stmt = $pdo->prepare(
                "
            INSERT INTO roles 
            (nombre_rol, fyh_creacion, estado) 
            VALUES (:nombre_rol, :fyh_creacion, :estado)
        "
            );
            $stmt->bindParam(':nombre_rol', $data['nombre_rol']);
            $stmt->bindParam(':fyh_creacion', $data['fechaHora']);
            $stmt->bindParam(':estado', $data['estado']);
            $stmt->execute();
            return true;
        
        } catch(\Throwable $th) {
            return false;
        }
    }

    public function update($data)
    {
        try{
            $stmt = $this->getConexion()->prepare("UPDATE roles SET nombre_rol = :nombre_rol, fyh_modificacion = :fyh_modificacion WHERE id_rol = :id_rol");
            $stmt->bindParam(':id_rol', $data['id_rol']);
            $stmt->bindParam(':nombre_rol', $data['nombre_rol']);
            $stmt->bindParam(':fyh_modificacion', $data['fechaHora']);
            $stmt->execute();
            return true;
        }catch(\Throwable $th){
            return false;
        }
    }

    public function delete($id_rol)
    {
        try {
            $stmt = $this->getConexion()->prepare(
                "DELETE FROM roles WHERE id_rol = :id_rol"
            );
            $stmt->bindParam(':id_rol', $id_rol);
            $stmt->execute();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
