<?php

/* ========================================================
 * ========== Archivo de Creacion de Rutas ================
 * ======================================================*/

/*----- Creacion de rutas ------*/
use Lib\Route;

Route::get(
    '/', function () {
        header('Content-Type: application/json');
        return json_encode(
            [
            'title' => 'Bienvenido...',
            'content' => '...'
            ]
        );
    }
);

Route::get(
    '/usuarios/', function () {
        return 'hola desde los usuarios';
    }
);

Route::get(
    '/usuarios/:nombre', function ($usuario) {
        return 'el usuario es: ' .$usuario;
    }
);

Route::dispatch();
