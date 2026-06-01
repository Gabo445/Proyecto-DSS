<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rutinas', function (Blueprint $table) {
            $table->id();                           // PK
            $table->foreignId('user_id')            // FK → users
                  ->constrained()
                  ->onDelete('cascade');
            $table->string('nombre', 100);          // Nombre de la rutina
            $table->text('descripcion')->nullable(); // Descripción opcional
            $table->date('fecha_creacion');         // Fecha de creación
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rutinas');
    }
};