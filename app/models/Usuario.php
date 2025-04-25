<?php
/* ========================================================
 * ============ Modelo de Usuario ======================
 * ======================================================*/

namespace App\Models;

use PDO;

class Usuario extends Conexion
{
    protected $table = 'usuarios';

    public function getAllUsuarios()
    {
        try {
            $stmt = $this->getConexion()->query("SELECT u.id_usuario, u.nombre_usuario,r.nombre_rol,u.email_usuario,u.fyh_creacion,u.estado FROM {$this->table} u JOIN roles r ON r.id_rol = u.id_rol");
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function getUsuario($id)
    {
        try {
            $stmt = $this->getConexion()->query("SELECT u.id_usuario, u.id_rol,u.nombre_usuario,r.nombre_rol,u.email_usuario,u.imagen_usuario,u.verification_token,u.fyh_creacion,u.estado FROM {$this->table} u JOIN roles r ON r.id_rol = u.id_rol WHERE u.id_usuario = {$id}");
            return $stmt->fetch(\PDO::FETCH_ASSOC) ?: null;
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function getByEmail($email)
    {
        try {
            $stmt = $this->getConexion()->prepare("SELECT * FROM {$this->table} WHERE email_usuario = :email");
            $stmt->execute([':email' => $email]);
            return $stmt->fetch(\PDO::FETCH_ASSOC) ?: null; // Devuelve null si no existe
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function getByToken($token)
    {
        try {
            $stmt = $this->getConexion()->prepare("SELECT id_usuario,estado FROM {$this->table} WHERE verification_token = :token");
            $stmt->execute([':token' => $token]);
            return $stmt->fetch(\PDO::FETCH_ASSOC) ?: null; // Devuelve null si no existe
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function verifyUser($id)
    {
        try {
            $stmt = $this->getConexion()->prepare("UPDATE {$this->table} SET estado = 1 WHERE id_usuario = :id");
            $stmt->execute(['id' => $id]);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function changePassword($data)
    {
        try {
            $stmt = $this->getConexion()->prepare("UPDATE {$this->table} SET password_usuario = :password,verification_token=:token WHERE id_usuario = :id");
            $stmt->execute(
                [
                'password' => $data['password_usuario'],
                'id' => $data['id_usuario'],
                'token' => $data['token']
                ]
            );
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function create($data)
    {
        try {
            $stmt = $this->getConexion()->prepare(
                "INSERT INTO {$this->table} 
      (nombre_usuario, password_usuario, verification_token, email_usuario, id_rol, fyh_creacion, estado) 
      VALUES (:nombre_usuario, :password_usuario, :verification_token, :email_usuario, :id_rol, :fyh_creacion, :estado)"
            );

            $stmt->execute(
                [
                'nombre_usuario' => $data['nombre_usuario'],
                'password_usuario' => $data['password_usuario'],
                'verification_token' => $data['verification_token'],
                'email_usuario' => $data['email_usuario'],
                'id_rol' => $data['id_rol'],
                'fyh_creacion' => $data['fyh_creacion'],
                'estado' => $data['estado']
                ]
            );

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function update($data)
    {
        try {
            $stmt = $this->getConexion()->prepare(
                "UPDATE usuarios 
        SET nombre_usuario = :nombre,
            email_usuario = :email,
            id_rol = :rol,
            estado = :estado,
            imagen_usuario =:imagen_usuario,
            fyh_modificacion = :fecha
        WHERE id_usuario = :id"
            );
            $stmt->execute(
                [
                ':nombre' => $data['nombre_usuario'],
                ':email' => $data['email_usuario'],
                ':rol' => $data['id_rol'],
                ':estado' => $data['estado'],
                ':imagen_usuario' => $data['imagen_usuario'],
                ':fecha' => $data['fyh_modificacion'],
                ':id' => $data['id_usuario']
                ]
            );
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function delete($id)
    {
        try {
            $stmt = $this->getConexion()->prepare("DELETE FROM {$this->table} WHERE id_usuario = :id");
            return $stmt->execute(['id' => $id]);
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function countAdmins()
    {
        $stmt = $this->getConexion()->prepare(
            "SELECT COUNT(*) 
             FROM usuarios u
             INNER JOIN roles r ON u.id_rol = r.id_rol
             WHERE r.nombre_rol = 'Administrador'"
        );
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function updateImage(int $id, string $filename): bool
    {
        try {
            $sql = "UPDATE {$this->table} 
                SET imagen_usuario = :imagen 
                WHERE id_usuario = :id";

            $stmt = $this->getConexion()->prepare($sql);
            $stmt->bindParam(':imagen', $filename);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (\PDOException $e) {
            return false;
        }
    }
}
