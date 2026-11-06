<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\DigicamApiController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\MahasiswaController;
use App\Http\Controllers\API\MatakuliahController;
use App\Http\Controllers\API\NilaiController;
use App\Http\Controllers\API\MenuApiController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/mahasiswa', [MahasiswaController::class, 'index']);
Route::get('/matakuliah', [MatakuliahController::class, 'index']);
Route::get('/nilai', [NilaiController::class, 'index']);

Route::get('/digicam', [DigicamApiController::class, 'index']);
Route::get('/digicam/{id}', [DigicamApiController::class, 'show']);

// CRUD MENU
Route::get('/menu', [MenuApiController::class, 'index']);
Route::get('/menu/{id}', [MenuApiController::class, 'show']);
Route::post('/menu', [MenuApiController::class, 'store']);
Route::put('/menu/{id}', [MenuApiController::class, 'update']);
Route::post('/menu/{id}', [MenuApiController::class, 'update']);
Route::delete('/menu/{id}', [MenuApiController::class, 'destroy']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/digicam', [DigicamApiController::class, 'store']);
    Route::put('/digicam/{id}', [DigicamApiController::class, 'update']);
    Route::delete('/digicam/{id}', [DigicamApiController::class, 'destroy']);
});