<?php

namespace App\Models;

use PDO;
use PDOException;

class Conexion
{
    protected static $conexion;

    public function __construct()
    {
        if (!isset(self::$conexion)) {
            $this->conectar();
        }
    }

    protected function conectar()
    {
        try {
            $dsn = 'mysql:host=' . DB_HOST. ';dbname=' . DB_NAME . ';charset=utf8';
            
            self::$conexion = new PDO(
                $dsn, DB_USER, DB_PASS, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
                ]
            );

        } catch (PDOException $e) {
            error_log('Error de conexión: ' . $e->getMessage());
            throw new \RuntimeException('Error al conectar con la base de datos');
        }
    }

    // Método para obtener la conexión desde cualquier modelo
    protected function getConexion()
    {
        return self::$conexion;
    }
}
