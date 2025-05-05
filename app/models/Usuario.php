<?php

/**
 * Modelo para la gestión de usuarios del sistema
 * 
 * Proporciona operaciones CRUD completas y gestión de autenticación
 */

namespace App\Models;

use PDO;
use Throwable;

class Usuario extends Conexion
{
    /**
     * @var string $table Nombre de la tabla en la base de datos
     */
    protected $table = 'usuarios';

    /**
     * Obtiene todos los usuarios con información de roles
     * 
     * @return array Listado completo de usuarios o array vacío en caso de error
     */
    public function getAllUsuarios()
    {
        try {
            $sql = "SELECT 
                        u.id_usuario,
                        u.nombre_usuario,
                        r.nombre_rol,
                        u.email_usuario,
                        u.fyh_creacion,
                        u.estado
                    FROM {$this->table} u
                    JOIN roles r ON r.id_rol = u.id_rol";

            $stmt = $this->getConexion()->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Throwable $e) {
            error_log('Error en getAllUsuarios: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Obtiene un usuario por su ID con información detallada
     * 
     * @param  int $id ID del usuario
     * @return array|null Datos del usuario o null si no existe
     */
    public function getUsuario($id)
    {
        try {
            $sql = "SELECT 
                        u.id_usuario,
                        u.id_rol,
                        u.nombre_usuario,
                        r.nombre_rol,
                        u.email_usuario,
                        u.imagen_usuario,
                        u.verification_token,
                        u.fyh_creacion,
                        u.estado
                    FROM {$this->table} u
                    JOIN roles r ON r.id_rol = u.id_rol
                    WHERE u.id_usuario = :id";

            $stmt = $this->getConexion()->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
        } catch (Throwable $e) {
            error_log("Error en getUsuario(ID: {$id}): " . $e->getMessage());
            return null;
        }
    }

    /**
     * Busca un usuario por su dirección de correo electrónico
     * 
     * @param  string $email Email a buscar
     * @return array|null Datos del usuario o null si no existe
     */
    public function getByEmail($email)
    {
        try {
            $sql = "SELECT * FROM {$this->table} WHERE email_usuario = :email";
            $stmt = $this->getConexion()->prepare($sql);
            $stmt->execute([':email' => $email]);

            return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
        } catch (Throwable $e) {
            error_log("Error en getByEmail(Email: {$email}): " . $e->getMessage());
            return null;
        }
    }

    /**
     * Obtiene un usuario por su token de verificación
     * 
     * @param  string $token Token de verificación
     * @return array|null Datos del usuario o null si no existe
     */
    public function getByToken($token)
    {
        try {
            $sql = "SELECT 
                        id_usuario,
                        estado 
                    FROM {$this->table} 
                    WHERE verification_token = :token";

            $stmt = $this->getConexion()->prepare($sql);
            $stmt->execute([':token' => $token]);

            return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
        } catch (Throwable $e) {
            error_log("Error en getByToken(Token: {$token}): " . $e->getMessage());
            return null;
        }
    }

    /**
     * Verifica un usuario mediante su ID
     * 
     * @param  int $id ID del usuario a verificar
     * @return bool Resultado de la operación
     */
    public function verifyUser($id)
    {
        try {
            $sql = "UPDATE {$this->table} 
                    SET estado = 1 
                    WHERE id_usuario = :id 
                    LIMIT 1";

            $stmt = $this->getConexion()->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (Throwable $e) {
            error_log("Error en verifyUser(ID: {$id}): " . $e->getMessage());
            return false;
        }
    }

    /**
     * Actualiza la contraseña de un usuario
     * 
     * @param  array $data Datos requeridos para el cambio
     *                     Debe contener: password_usuario, id_usuario, token
     * @return bool Resultado de la operación
     */
    public function changePassword($data)
    {
        try {
            $sql = "UPDATE {$this->table} 
                    SET 
                        password_usuario = :password,
                        verification_token = :token 
                    WHERE id_usuario = :id";

            $stmt = $this->getConexion()->prepare($sql);

            return $stmt->execute(
                [
                'password' => $data['password_usuario'],
                'id'       => $data['id_usuario'],
                'token'    => $data['token']
                ]
            );
        } catch (Throwable $e) {
            error_log("Error en changePassword(ID: {$data['id_usuario']}): " . $e->getMessage());
            return false;
        }
    }

    /**
     * Crea un nuevo usuario en el sistema
     * 
     * @param  array $data Datos del nuevo usuario
     * @return bool Resultado de la operación
     */
    public function create($data)
    {
        try {
            $sql = "INSERT INTO {$this->table} (
                        nombre_usuario,
                        password_usuario,
                        verification_token,
                        email_usuario,
                        id_rol,
                        fyh_creacion,
                        estado
                    ) VALUES (
                        :nombre_usuario,
                        :password_usuario,
                        :verification_token,
                        :email_usuario,
                        :id_rol,
                        :fyh_creacion,
                        :estado
                    )";

            $stmt = $this->getConexion()->prepare($sql);

            return $stmt->execute(
                [
                'nombre_usuario'     => $data['nombre_usuario'],
                'password_usuario'  => $data['password_usuario'],
                'verification_token' => $data['verification_token'],
                'email_usuario'      => $data['email_usuario'],
                'id_rol'            => $data['id_rol'],
                'fyh_creacion'       => $data['fyh_creacion'],
                'estado'            => $data['estado']
                ]
            );
        } catch (Throwable $e) {
            error_log('Error en createUsuario: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Actualiza los datos de un usuario existente
     * 
     * @param  array $data Datos actualizados del usuario
     * @return bool Resultado de la operación
     */
    public function update($data)
    {
        try {
            $sql = "UPDATE {$this->table}
                    SET
                        nombre_usuario = :nombre,
                        email_usuario = :email,
                        id_rol = :rol,
                        estado = :estado,
                        fyh_modificacion = :fecha
                    WHERE id_usuario = :id";

            $stmt = $this->getConexion()->prepare($sql);

            return $stmt->execute(
                [
                ':nombre' => $data['nombre_usuario'],
                ':email'  => $data['email_usuario'],
                ':rol'    => $data['id_rol'],
                ':estado' => $data['estado'],
                ':fecha'  => $data['fyh_modificacion'],
                ':id'     => $data['id_usuario']
                ]
            );
        } catch (Throwable $e) {
            error_log("Error en updateUsuario(ID: {$data['id_usuario']}): " . $e->getMessage());
            return false;
        }
    }

    /**
     * Elimina un usuario del sistema
     * 
     * @param  int $id ID del usuario a eliminar
     * @return bool Resultado de la operación
     */
    public function delete($id)
    {
        try {
            $sql = "DELETE FROM {$this->table} 
                    WHERE id_usuario = :id 
                    LIMIT 1";

            $stmt = $this->getConexion()->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (Throwable $e) {
            error_log("Error en deleteUsuario(ID: {$id}): " . $e->getMessage());
            return false;
        }
    }

    /**
     * Cuenta la cantidad de usuarios administradores
     * 
     * @return int Número de administradores
     */
    public function countAdmins()
    {
        try {
            $sql = "SELECT COUNT(*) 
                    FROM {$this->table} u
                    INNER JOIN roles r ON u.id_rol = r.id_rol
                    WHERE r.nombre_rol = 'Administrador'";

            $stmt = $this->getConexion()->prepare($sql);
            $stmt->execute();

            return (int)$stmt->fetchColumn();
        } catch (Throwable $e) {
            error_log('Error en countAdmins: ' . $e->getMessage());
            return 0;
        }
    }

    /**
     * Actualiza la imagen de perfil de un usuario
     * 
     * @param  int    $id       ID del usuario
     * @param  string $filename Nombre del archivo de imagen
     * @return bool Resultado de la operación
     */
    public function updateImage(int $id, string $filename): bool
    {
        try {
            $sql = "UPDATE {$this->table} 
                    SET imagen_usuario = :imagen 
                    WHERE id_usuario = :id 
                    LIMIT 1";

            $stmt = $this->getConexion()->prepare($sql);
            $stmt->bindValue(':imagen', $filename);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (Throwable $e) {
            error_log("Error en updateImage(ID: {$id}): " . $e->getMessage());
            return false;
        }
    }
}
