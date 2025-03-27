<?php

/* ========================================================
 * ========== Archivo de Creacion de Rutas ================
 * ======================================================*/

/*----- Creacion de rutas ------*/
use Lib\Route;

Route::get(
    '/', function () {
        echo 'hola desde el home';
    }
);

Route::get(
    '/usuarios', function () {
        echo 'hola desde los usuarios';
    }
);

Route::dispatch();
