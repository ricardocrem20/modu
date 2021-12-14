<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

use Ricardo\Modu\Controllers\ApiAuth\AuthController;
use Ricardo\Modu\Controllers\Admin\ModuloController;
use Ricardo\Modu\Controllers\Admin\AreaController;
use Ricardo\Modu\Controllers\Admin\PermisoController;
use Ricardo\Modu\Controllers\Admin\TipoRoleController;
use Ricardo\Modu\Controllers\Admin\RoleController;
use Ricardo\Modu\Controllers\Admin\UserController;
use Ricardo\Modu\Controllers\Admin\RoleUserController;
use Ricardo\Modu\Controllers\Admin\PermisoUserController;

Route::prefix('api/auth')
	->group(function () {
		Route::post('registro', [AuthController::class, 'registro']);
		Route::post('login', [AuthController::class, 'login']);
		Route::group(['middleware' => 'auth:api'], function() {
			Route::get('user', [AuthController::class, 'user']);
			Route::post('logout', [AuthController::class, 'logout']);
		});
	});

Route::group(['middleware' => 'auth:api'], function() {
	Route::prefix('api/admin')
		->group(function () {
			Route::post('editar_foto_perfil', [UserController::class, 'editarFotoPerfil']);
			Route::apiResource('users', UserController::class)->except(['index', 'destroy']);
			Route::get('users_administrativos', [UserController::class, 'usersAdministrativos']);
			Route::put('editar_email/{User}', [UserController::class, 'editarEmail']);
			Route::put('editar_password/{User}', [UserController::class, 'editarPassword']);

			Route::apiResource('modulos', ModuloController::class);
			Route::get('select_modulos', [ModuloController::class, 'selectModulos']);

			Route::apiResource('areas', AreaController::class)->except(['index']);
			Route::get('areas_modulo/{Modulo}', [AreaController::class, 'areasModulo']);
			Route::get('permisos_area/{Area}', [AreaController::class, 'permisosArea']);

			Route::get('select_tipos_roles', [TipoRoleController::class, 'selectTiposRoles']);
			Route::apiResource('roles', RoleController::class);
			Route::get('select_roles/{TipoRole}', [RoleController::class, 'selectRoles']);
			Route::post('asignar_roles', [RoleUserController::class, 'asignarRoles']);
			
			Route::apiResource('permisos', PermisoController::class)->except(['index']);
			Route::post('asignar_permiso', [PermisoUserController::class, 'store']);
			Route::post('asignar_todos_permisos', [PermisoUserController::class, 'asignarTodosPermisos']);
			Route::post('quitar_todos_permisos', [PermisoUserController::class, 'quitarTodosPermisos']);
		
			Route::get('areas_permisos_user/{User}', [UserController::class, 'areasPermisosUser']);
			Route::get('menu_user', [UserController::class, 'menuUser']);
		});
});