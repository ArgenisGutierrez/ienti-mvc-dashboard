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
use App\Controllers\LoginController;
use App\Controllers\CategoriaController;

/*----- Rutas de login y registro------*/

Route::get('/login', [LoginController::class, 'index']);
Route::get('/logout', [LoginController::class, 'logout']);
Route::post('/login', [LoginController::class, 'login']);
Route::get('/registro', [LoginController::class, 'registro']);
Route::post('/registro', [LoginController::class, 'registrarse']);
Route::get('/verify/:token', [LoginController::class, 'verificar']);
Route::get('/forgetPassword', [LoginController::class, 'forgetPassword']);
Route::post('/forgetPassword', [LoginController::class, 'comprobacionCorreo']);
Route::get('/changePassword/:token', [LoginController::class, 'formChangePassword']);
Route::post('/changePassword', [LoginController::class, 'changePassword']);

Route::get('/404', [HomeController::class, 'error404']);
Route::get('/', [HomeController::class, 'index']);

/*----- Rutas de roles ------*/
Route::get('/roles', [RoleController::class, 'index']);
Route::post('/roles', [RoleController::class, 'create']);
Route::put('/roles/:id', [RoleController::class, 'update']);
Route::delete('/roles/:id', [RoleController::class, 'delete']);

/*----- Rutas de recursos ------*/
Route::get('/recursos', [RecursoController::class, 'index']);
Route::post('/recursos', [RecursoController::class, 'create']);
Route::put('/recursos/:id', [RecursoController::class, 'update']);
Route::delete('/recursos/:id', [RecursoController::class, 'delete']);

/*----- Rutas de usuarios ------*/
Route::get('/usuarios', [UsuarioController::class, 'index']);
Route::post('/usuarios', [UsuarioController::class, 'create']);
Route::put('/usuarios/:id', [UsuarioController::class, 'update']);
Route::delete('/usuarios/:id', [UsuarioController::class, 'delete']);
Route::get('/usuario', [UsuarioController::class, 'perfil']);
Route::put('/usuario/:id', [UsuarioController::class, 'updatePerfil']);
Route::put('/updateProfileImage', [UsuarioController::class, 'updateProfileImage']);

/*----- Rutas de categorias ------*/
Route::get('/categorias', [CategoriaController::class, 'index']);
Route::post('/categorias', [CategoriaController::class, 'createCategoria']);
Route::post('/subcategorias', [CategoriaController::class, 'createSubcategoria']);
Route::put('/categorias/:id', [CategoriaController::class, 'updateCategoria']);
Route::put('/subcategorias/:id', [CategoriaController::class, 'updateSubcategoria']);
Route::delete('/categorias/:id', [CategoriaController::class, 'deleteCategoria']);
Route::delete('/subcategorias/:id', [CategoriaController::class, 'deleteSubcategoria']);

Route::dispatch();
