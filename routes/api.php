<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\MascotaController;
use App\Http\Controllers\VacunaController;
use App\Http\Controllers\ControlController;
use App\Http\Controllers\CitaController;




Route::get('/mascotas/codigo/{codigo}', [MascotaController::class, 'porCodigo']);


Route::post('/auth/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/auth/logout', [AuthController::class, 'logout']);


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
    Route::put('/usuarios/{id}/reset-password', [UserController::class, 'resetPassword']);

    Route::get('/clientes', [ClienteController::class, 'index']);
    Route::post('/clientes', [ClienteController::class, 'store']);
    Route::put('/clientes/{id}', [ClienteController::class, 'update']);
    Route::get('/clientes/{id}', [ClienteController::class, 'show']);
    Route::delete('/clientes/{id}', [ClienteController::class, 'destroy']);

    Route::get('/mascotas', [MascotaController::class, 'index']);
    Route::post('/mascotas', [MascotaController::class, 'store']);
    Route::put('/mascotas/{id}', [MascotaController::class, 'update']);
    Route::get('/mascotas/{id}', [MascotaController::class, 'show']);
    Route::delete('/mascotas/{id}', [MascotaController::class, 'destroy']);
    Route::post('/mascotas/{id}/imagen', [MascotaController::class, 'updateImagen']);


    Route::get('/vacunas', [VacunaController::class, 'index']);
    Route::post('/vacunas', [VacunaController::class, 'store']);
    Route::put('/vacunas/{id}', [VacunaController::class, 'update']);
    Route::get('/vacunas/{id}', [VacunaController::class, 'show']);
    Route::delete('/vacunas/{id}', [VacunaController::class, 'destroy']);

    Route::get('/controles', [ControlController::class, 'index']);
    Route::post('/controles', [ControlController::class, 'store']);
    Route::get('/controles/{id}', [ControlController::class, 'show']);
    Route::put('/controles/{id}', [ControlController::class, 'update']);
    Route::delete('/controles/{id}', [ControlController::class, 'destroy']);


    /*Reportes*/
    Route::get('/mascota/codigo/{codigo}/vacunas', [MascotaController::class, 'vacunasPorCodigo']);
    Route::get('/mascota/codigo/{codigo}/pdf', [MascotaController::class, 'generarPDF']);


    Route::get('/citas', [CitaController::class, 'index']);
    Route::post('/citas', [CitaController::class, 'store']);
    Route::put('/citas/{id}', [CitaController::class, 'update']);
    Route::get('/citas/{id}', [CitaController::class, 'show']);
    Route::delete('/citas/{id}', [CitaController::class, 'destroy']);
});
