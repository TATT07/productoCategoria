<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;

Route::middleware('auth')->group(function () {
    Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
    Route::get('/productos/crear', [ProductoController::class, 'create'])->name('productos.create');
    Route::post('/productos/store', [ProductoController::class, 'store'])->name('productos.store');
    Route::get('/productos/{id}/show', [ProductoController::class, 'show'])->name('productos.show');
    Route::get('/productos/{id}/editar', [ProductoController::class, 'edit'])->name('productos.edit');
    Route::put('/productos/{id}/actualizar', [ProductoController::class, 'update'])->name('productos.update');
    Route::delete('/productos/{id}/eliminar', [ProductoController::class, 'destroy'])->name('productos.destroy');
});
