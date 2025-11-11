<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('productos', function (Blueprint $table) {
            // Agregar la columna si no existe
            if (!Schema::hasColumn('productos', 'categoria_id')) {
                $table->unsignedBigInteger('categoria_id')->nullable()->after('stock');
                $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');
            }
        });
    }

    public function down(): void
    {
        Schema::table('productos', function (Blueprint $table) {
            if (Schema::hasColumn('productos', 'categoria_id')) {
                $table->dropForeign(['categoria_id']);
                $table->dropColumn('categoria_id');
            }
        });
    }
};
