<?php

namespace App\Models;

class Categoria extends Conexion
{
    protected $table = 'categorias';

    public function getAllCategorias(): array
    {
        try {
            $sql = "SELECT 
              c.id_categoria,
              c.nombre_categoria,
              s.id_subcategoria,
              s.nombre_subcategoria
                    FROM {$this->table}
                    JOIN subcategorias s
                    ON c.id_categoria = s.id_categoria";
            $stmt = $this->getConexion()->query($sql);
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (Throwable $e) {
            return [];
        }
    }
}
