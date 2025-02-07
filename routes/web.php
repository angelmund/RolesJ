<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/modalidades', [App\Http\Controllers\ModalidadController::class, 'index'])->name('ModalidadesIndex');
    Route::get('/modalidades/crear', [App\Http\Controllers\ModalidadController::class, 'crear'])->name('MalidadesCrear');
    Route::post('/modalidades/guardar', [App\Http\Controllers\ModalidadController::class, 'guardar'])->name('ModalidadesGuardar');
    Route::get('/modalidades/edit/{id}', [App\Http\Controllers\ModalidadController::class, 'editar'])->name('ModalidadesEditar');
    Route::put('/modalidades/actualizar/{id}', [App\Http\Controllers\ModalidadController::class, 'actualizar'])->name('ModalidadesActualizar');
    Route::post('/modalidades/eliminar/{id}', [App\Http\Controllers\ModalidadController::class, 'eliminar'])->name('ModalidadesEliminar');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/torneos', [App\Http\Controllers\TorneosController::class, 'index'])->name('TorneosIndex');
    Route::get('/torneos/crear', [App\Http\Controllers\TorneosController::class, 'crear'])->name('TorneosCrear');
    Route::post('/torneos/guardar', [App\Http\Controllers\TorneosController::class, 'guardar'])->name('TorneosGuardar');
    Route::get('/torneos/edit/{id}', [App\Http\Controllers\TorneosController::class, 'editar'])->name('TorneosEditar');
    Route::put('/torneos/actualizar/{id}', [App\Http\Controllers\TorneosController::class, 'actualizar'])->name('TorneosActualizar');
    Route::post('/torneos/eliminar/{id}', [App\Http\Controllers\TorneosController::class, 'eliminar'])->name('TorneosEliminar');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/equipos', [App\Http\Controllers\Equipo_Torneo_JugadorController::class, 'index'])->name('EquiposIndex');
    Route::get('/equipos/crear', [App\Http\Controllers\Equipo_Torneo_JugadorController::class, 'crear'])->name('EquiposCrear');
    Route::post('/equipos/guardar', [App\Http\Controllers\Equipo_Torneo_JugadorController::class, 'guardar'])->name('EquiposGuardar');
    Route::get('/equipos/edit/{id}', [App\Http\Controllers\Equipo_Torneo_JugadorController::class, 'editar'])->name('EquiposEditar');
    Route::post('/equipos/actualizar/{id}', [App\Http\Controllers\Equipo_Torneo_JugadorController::class, 'actualizar'])->name('EquiposActualizar');
    Route::post('/equipos/eliminar/{id}', [App\Http\Controllers\Equipo_Torneo_JugadorController::class, 'eliminar'])->name('EquiposEliminar');
});
