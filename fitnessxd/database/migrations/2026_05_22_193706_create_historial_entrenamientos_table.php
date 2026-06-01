<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('historial_entrenamientos', function (Blueprint $table) {
            $table->id();                           // PK
            $table->foreignId('user_id')            // FK → users
                  ->constrained()
                  ->onDelete('cascade');
            $table->foreignId('rutina_id')          // FK → rutinas
                  ->constrained()
                  ->onDelete('cascade');
            $table->dateTime('fecha_entrenamiento'); // Fecha y hora del entrenamiento
            $table->text('notas')->nullable();       // Notas opcionales
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('historial_entrenamientos');
    }
};