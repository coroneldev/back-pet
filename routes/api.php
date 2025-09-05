<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\InscripcionController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClienteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('/cursos-portal', [CursoController::class, 'indexPortal']);
Route::post('/usuarios-portal', [UserController::class, 'storePortal']);

Route::post('/auth/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/auth/logout', [AuthController::class, 'logout']);

    Route::get('/areas', [AreaController::class, 'index']);
    Route::post('/areas', [AreaController::class, 'store']);
    Route::get('/areas/{id}', [AreaController::class, 'show']);
    Route::put('/areas/{id}', [AreaController::class, 'update']);
    Route::delete('/areas/{id}', [AreaController::class, 'destroy']);

    Route::get('/roles', [RolController::class, 'index']);
    Route::post('/roles', [RolController::class, 'store']);
    Route::get('/roles/{id}', [RolController::class, 'show']);
    Route::put('/roles/{id}', [RolController::class, 'update']);
    Route::delete('/roles/{id}', [RolController::class, 'destroy']);


    Route::get('/usuarios', [UserController::class, 'index']);
    Route::post('/usuarios', [UserController::class, 'store']);
    Route::get('/usuarios/{id}', [UserController::class, 'show']);
    Route::put('/usuarios/{id}', [UserController::class, 'update']);
    Route::delete('/usuarios/{id}', [UserController::class, 'destroy']);
    Route::get('/usuarios/{ci}/estudiante', [UserController::class, 'obtenerEstudianteCi']);
    Route::put('/usuarios/{id}/reset-password', [UserController::class, 'resetPassword']);
    Route::put('/usuarios/{id}/cambiar-password', [UserController::class, 'cambiarPassword']);
    Route::get('/usuarios-docentes', [UserController::class, 'indexDocentes']);

    Route::get('/cursos', [CursoController::class, 'index']);
    Route::post('/cursos', [CursoController::class, 'store']);
    Route::get('/cursos/{id}', [CursoController::class, 'show']);
    Route::put('/cursos/{id}', [CursoController::class, 'update']);
    Route::delete('/cursos/{id}', [CursoController::class, 'destroy']);
    Route::post('/cursos/{id}/imagen', [CursoController::class, 'updateImagen']);

    Route::get('/inscripciones', [InscripcionController::class, 'index']);
    Route::post('/inscripciones', [InscripcionController::class, 'store']);
    Route::get('/inscripciones/{id}', [InscripcionController::class, 'show']);
    Route::put('/inscripciones/{id}', [InscripcionController::class, 'update']);
    Route::delete('/inscripciones/{id}', [InscripcionController::class, 'destroy']);
    Route::get('/inscripciones/{id}/certificado', [InscripcionController::class, 'certificado']);
    Route::get('/inscripciones-usuario/{id}', [InscripcionController::class, 'indexUsuario']);

    Route::get('/clientes', [ClienteController::class, 'index']);
    Route::post('/clientes', [ClienteController::class, 'store']);
    Route::put('/clientes/{id}', [ClienteController::class, 'update']);
    Route::get('/clientes/{id}', [ClienteController::class, 'show']);
    Route::put('/clientes/{id}', [ClienteController::class, 'update']);
    Route::delete('/clientes/{id}', [ClienteController::class, 'destroy']);
});
