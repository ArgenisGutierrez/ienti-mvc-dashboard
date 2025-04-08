<?php

/* ========================================================
 * ========== Archivo de Creacion de Rutas ================
 * ======================================================*/

/*----- Creacion de rutas ------*/
use App\Controllers\RoleController;
use Lib\Route;
use App\Controllers\HomeController;

Route::get('/', [HomeController::class,'index']);

Route::get('/roles', [RoleController::class,'index']);
Route::post('/roles', [RoleController::class,'create']);

Route::dispatch();
