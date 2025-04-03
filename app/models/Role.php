<?php

namespace App\Models;

class Role extends Conexion
{
    public function getAllRoles()
    {
        try {
            $stmt = $this->getConexion()->query("SELECT * FROM roles");
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            return [];
        }
    }

}
