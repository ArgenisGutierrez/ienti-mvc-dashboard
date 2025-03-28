<?php

/* ========================================================
 * ========== Archivo de Creacion de Rutas ================
 * ======================================================*/

/*----- Creacion de rutas ------*/
use Lib\Route;
use App\Controllers\HomeController;

Route::get('/', [HomeController::class,'index']);

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
