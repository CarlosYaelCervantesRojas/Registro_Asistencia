<?php

use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\DocenteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/docentes', [DocenteController::class, 'index']);
Route::get('/docente/{id}', [DocenteController::class, 'show']);
Route::put('/docente', [DocenteController::class, 'store']);
Route::post('/docente/{id}', [DocenteController::class, 'update']);
Route::delete('/docente/{id}', [DocenteController::class, 'destroy']);

Route::get('/alumnos', [AlumnoController::class, 'index']);
Route::get('/alumno/{id}', [AlumnoController::class, 'show']);
Route::put('/alumno', [AlumnoController::class, 'store']);
Route::post('/alumno/{id}', [AlumnoController::class, 'update']);
Route::delete('/alumno/{id}', [AlumnoController::class, 'destroy']);

Route::get('/cursos', [CursoController::class, 'index']);
Route::get('/curso/{id}', [CursoController::class, 'show']);
Route::put('/curso', [CursoController::class, 'store']);
Route::post('/curso/{id}', [CursoController::class, 'update']);
Route::delete('/curso/{id}', [CursoController::class, 'destroy']);

Route::get('/asistencias', [AsistenciaController::class, 'index']);
Route::get('/asistencia/alumno/{id}', [AsistenciaController::class, 'show']);
Route::put('/asistencia/alumno/{id}', [AsistenciaController::class, 'store']);
Route::post('/editar/asistencia/{dia}/alumno/{id}', [AsistenciaController::class, 'update']);