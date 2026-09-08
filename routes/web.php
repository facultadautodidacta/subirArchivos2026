<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubirArchivoController;

// Ruta para mostrar el formulario
Route::get('/', [SubirArchivoController::class, 'index'])->name('formulario');

// Ruta para procesar la subida (POST)
Route::post('/subir', [SubirArchivoController::class, 'store'])->name('subir');

// Ruta para listar los archivos subidos
Route::get('/listar', [SubirArchivoController::class, 'listar'])->name('listar-archivos');

// Ruta para eliminar un archivo (POST)
Route::post('/eliminar', [SubirArchivoController::class, 'eliminar'])->name('eliminar-archivo');