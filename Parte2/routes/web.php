<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Lab3\EstudianteController;
use App\Http\Controllers\Lab3\CursoController;
use App\Http\Controllers\Lab3\EstudianteCursoController;
use App\Http\Controllers\Lab3\AsistenciaController;

Route::get('/', function () {
    return redirect()->route('estudiantes.index');
});

Route::resource('estudiantes', EstudianteController::class);
Route::resource('cursos', CursoController::class);
Route::resource('estudiante_curso', EstudianteCursoController::class);
Route::resource('asistencias', AsistenciaController::class);
