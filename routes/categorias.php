<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;

Route::middleware('auth')->group(function () {
    Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');
    Route::get('/categorias/crear', [CategoriaController::class, 'create'])->name('categorias.create');
    Route::post('/categorias/store', [CategoriaController::class, 'store'])->name('categorias.store');
    Route::get('/categorias/{id}/show', [CategoriaController::class, 'show'])->name('categorias.show');
    Route::get('/categorias/{id}/editar', [CategoriaController::class, 'edit'])->name('categorias.edit');
    Route::put('/categorias/{id}/actualizar', [CategoriaController::class, 'update'])->name('categorias.update');
    Route::delete('/categorias/{id}/eliminar', [CategoriaController::class, 'destroy'])->name('categorias.destroy');
});
