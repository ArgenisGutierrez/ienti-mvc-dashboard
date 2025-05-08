<?php

/**
 * Punto de entrada principal de la aplicación
 * 
 * @author  Argenis Gutierrez <argenis.v.gtz@gmail.com>
 * @version 1.0.0
 * @license MIT
 * 
 * @see \Lib\Route
 * @see \App\Controllers
 * 
 * @example
 * Desde el navegador: http://tudominio.com/
 */

/**
 * Bootstrap de la aplicación
 * 
 * Secuencia de inicialización:
 * 1. Configuraciones
 * 2. Autoloader
 * 3. Rutas
 * 4. Ejecutar enrutador
 */

// Configuración inicial de la aplicación
require_once '../config/database.php';  // Configuración de base de datos
require_once '../config/server.php';     // Configuración del servidor

// Sistema de autoloading (PSR-4)
require_once '../autoload.php';          // Cargador automático de clases

// Definición de rutas
require_once '../routes/web.php';        // Mapeo de rutas y controladores
