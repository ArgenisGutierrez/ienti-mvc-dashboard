<?php

/**
 * Modelo de Conexión a Base de Datos
 * 
 * Implementa un patrón Singleton para gestionar la conexión PDO
 * Características principales:
 * - Conexión única persistente por instancia
 * - Configuración centralizada desde constantes
 * - Manejo de excepciones con logging
 * - Configuración óptima de PDO
 */

namespace App\Models;

use PDO;
use PDOException;

class Conexion
{
  /**
   * @var PDO Instancia única de conexión
   */
  protected static $conexion;

  /**
   * Constructor que inicializa la conexión
   *
   * @throws \RuntimeException Si falla la conexión
   */
  public function __construct()
  {
    if (!isset(self::$conexion)) {
      $this->conectar();
    }
  }

  /**
   * Establece la conexión a la base de datos
   *
   * @throws \RuntimeException Si ocurre un error de conexión
   */
  protected function conectar()
  {
    try {
      // Verificar constantes definidas
      if (!defined('DB_HOST') || !defined('DB_NAME') || !defined('DB_USER') || !defined('DB_PASS')) {
        throw new \RuntimeException('Configuración de base de datos incompleta');
      }

      $dsn = sprintf(
        'mysql:host=%s;dbname=%s;charset=utf8',
        DB_HOST,
        DB_NAME
      );

      // Configuración de opciones PDO
      $opciones = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_PERSISTENT => false
      ];

      self::$conexion = new PDO($dsn, DB_USER, DB_PASS, $opciones);
    } catch (PDOException $e) {
      error_log('Error PDO: ' . $e->getMessage());
      throw new \RuntimeException('Error al conectar con el servidor de base de datos');
    } catch (\RuntimeException $e) {
      error_log('Error de configuración: ' . $e->getMessage());
      throw $e;
    }
  }

  /**
   * Devuelve la instancia de conexión activa
   *
   * @return PDO Instancia de conexión PDO
   */
  protected function getConexion()
  {
    // Verificar conexión activa
    if (self::$conexion === null) {
      throw new \RuntimeException('Conexión no inicializada');
    }
    return self::$conexion;
  }
}
