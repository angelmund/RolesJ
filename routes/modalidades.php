<?php

use Illuminate\Support\Facades\Route;



Route::get('/', [App\Http\Controllers\ModalidadController::class, 'index'])->name('Index');
Route::get('/crear', [App\Http\Controllers\ModalidadController::class, 'crear'])->name('Crear');
Route::post('/guardar', [App\Http\Controllers\ModalidadController::class, 'guardar'])->name('Guardar');
Route::get('/edit/{id}', [App\Http\Controllers\ModalidadController::class, 'editar'])->name('Editar');
Route::put('/actualizar/{id}', [App\Http\Controllers\ModalidadController::class, 'actualizar'])->name('Actualizar');
Route::post('/eliminar/{id}', [App\Http\Controllers\ModalidadController::class, 'eliminar'])->name('Eliminar');
