<?php

use Illuminate\Support\Facades\Route;


Route::get('/', [App\Http\Controllers\TorneosController::class, 'index'])->name('Index');
Route::get('/crear', [App\Http\Controllers\TorneosController::class, 'crear'])->name('Crear');
Route::post('/guardar', [App\Http\Controllers\TorneosController::class, 'guardar'])->name('Guardar');
Route::get('/edit/{id}', [App\Http\Controllers\TorneosController::class, 'editar'])->name('Editar');
Route::put('/actualizar/{id}', [App\Http\Controllers\TorneosController::class, 'actualizar'])->name('Actualizar');
Route::post('/eliminar/{id}', [App\Http\Controllers\TorneosController::class, 'eliminar'])->name('Eliminar');
