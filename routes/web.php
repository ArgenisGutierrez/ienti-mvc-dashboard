<?php

/* ========================================================
 * ========== Archivo de Creacion de Rutas ================
 * ======================================================*/

/*----- Creacion de rutas ------*/
use App\Controllers\RoleController;
use Lib\Route;
use App\Controllers\HomeController;
use App\Controllers\RecursoController;
use App\Controllers\UsuarioController;

Route::get('/', [HomeController::class,'index']);

/*----- Rutas de roles ------*/
Route::get('/roles', [RoleController::class,'index']);
Route::post('/roles', [RoleController::class,'create']);
Route::put('/roles/:id', [RoleController::class,'update']);
Route::delete('/roles/:id', [RoleController::class,'delete']);

/*----- Rutas de recursos ------*/
Route::get('/recursos', [RecursoController::class,'index']);
Route::post('/recursos', [RecursoController::class,'create']);
Route::put('/recursos/:id', [RecursoController::class,'update']);
Route::delete('/recursos/:id', [RecursoController::class,'delete']);

/*----- Rutas de usuarios ------*/
Route::get('/usuarios', [UsuarioController::class,'index']);
Route::post('/usuarios', [UsuarioController::class,'create']);
Route::put('/usuarios/:id', [UsuarioController::class,'update']);
Route::delete('/usuarios/:id', [UsuarioController::class,'delete']);

Route::dispatch();
