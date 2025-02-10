<?php

use Illuminate\Support\Facades\Route;



Route::get('/', [App\Http\Controllers\Equipo_Torneo_JugadorController::class, 'index'])->name('Equipos.Index');
Route::get('/crear', [App\Http\Controllers\Equipo_Torneo_JugadorController::class, 'crear'])->name('Equipos.Crear');
Route::post('/guardar', [App\Http\Controllers\Equipo_Torneo_JugadorController::class, 'guardar'])->name('Equipos.Guardar');
Route::get('/edit/{id}', [App\Http\Controllers\Equipo_Torneo_JugadorController::class, 'editar'])->name('Equipos.Editar');
Route::post('/actualizar/{id}', [App\Http\Controllers\Equipo_Torneo_JugadorController::class, 'actualizar'])->name('Equipos.Actualizar');
Route::post('/eliminar/{id}', [App\Http\Controllers\Equipo_Torneo_JugadorController::class, 'eliminar'])->name('Equipos.Eliminar');