<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('edad')->nullable();               // Agrega columna edad
            $table->decimal('peso_objetivo', 5, 2)->nullable(); // Agrega columna peso_objetivo
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['edad', 'peso_objetivo']);     // Elimina las columnas si haces rollback
        });
    }
};