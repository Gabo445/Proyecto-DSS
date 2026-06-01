<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registro_pesos', function (Blueprint $table) {
            $table->id();                           // PK
            $table->foreignId('user_id')            // FK → users
                  ->constrained()
                  ->onDelete('cascade');
            $table->decimal('peso', 5, 2);          // Peso en kg
            $table->date('fecha_registro');         // Fecha del registro
            $table->timestamps();                   // created_at, updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registro_pesos');
    }
};