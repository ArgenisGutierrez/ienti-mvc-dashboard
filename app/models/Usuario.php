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
            $stmt = $this->getConexion()->query("SELECT u.nombre_usuario,r.nombre_rol,u.email_usuario,u.fyh_creacion,u.estado FROM {$this->table} u JOIN roles r ON r.id_rol = u.id_rol");
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            return [];
        }
    }

    public function create($data)
    {
        try {
            $stmt= $this->getConexion()->prepare(
                "INSERT INTO {$this->table} 
        (nombre_usuario, password_usuario, email_usuario, id_rol, fyh_creacion,estado) 
        VALUES (:nombre, :password, :email, :rol, :fyh_creacion, :estado)"
            );
            $stmt->execute(
                [
                'nombre' => $data['nombre_usuario'],
                'password' => $data['password_usuario'],
                'email' => $data['email_usuario'],
                'rol' => $data['id_rol'],
                'fyh_creacion' => $data['fyh_creacion'],
                'estado' => $data['estado']
                ]
            );
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
