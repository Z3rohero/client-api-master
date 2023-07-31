<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\MascotaController;
use App\Http\Controllers\HistoriaController;
use App\Http\Controllers\AuthController;




//Con este metodo se crea las cuatros  enpoint metodos get, put, delete para cada uno
// Rutas para el recurso Cliente
Route::apiResource('clientes', ClienteController::class);
// Rutas para el recurso Mascota
Route::apiResource('mascotas', MascotaController::class);
// Rutas para el recurso Historial
Route::apiResource('historias', HistoriaController::class);

//Rutas para el login
Route::post('login', [AuthController::class, 'login']);

Route::post('register', [AuthController::class, 'register']);

Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::get('user-profile', [AuthController::class, 'userProfile']);
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::get('usuarios', [AuthController::class, 'allUsers']);



