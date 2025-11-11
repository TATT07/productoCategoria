<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Agrega la columna 'activa' a la tabla 'categorias'
     */
    public function up(): void
    {
        Schema::table('categorias', function (Blueprint $table) {
            $table->boolean('activa')->default(true)->after('descripcion');
        });
    }

    /**
     * Elimina la columna 'activa' si se revierte la migración
     */
    public function down(): void
    {
        Schema::table('categorias', function (Blueprint $table) {
            $table->dropColumn('activa');
        });
    }
};
