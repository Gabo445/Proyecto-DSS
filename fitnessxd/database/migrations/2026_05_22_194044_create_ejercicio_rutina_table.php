<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ejercicio_rutina', function (Blueprint $table) {
            $table->id();                           // PK
            $table->foreignId('rutina_id')          // FK → rutinas
                  ->constrained()
                  ->onDelete('cascade');
            $table->string('ejercicio_api_id', 50); // ID del ejercicio desde API externa
            $table->integer('series');              // Número de series
            $table->integer('repeticiones');        // Número de repeticiones
            $table->decimal('peso', 5, 2)->nullable(); // Peso opcional
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ejercicio_rutina');
    }
};