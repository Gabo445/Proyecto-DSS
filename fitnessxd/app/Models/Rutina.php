<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rutina extends Model
{
    protected $fillable = [
        'user_id',
        'nombre',
        'descripcion',
        'fecha_creacion',
    ];

    protected $casts = [
        'fecha_creacion' => 'date',
    ];

    // Relación: una rutina pertenece a un usuario
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relación: una rutina tiene muchos ejercicios (tabla pivote)
    public function ejercicios(): HasMany
    {
        return $this->hasMany(EjercicioRutina::class);
    }

    // Relación: una rutina tiene muchos registros en el historial
    public function historial(): HasMany
    {
        return $this->hasMany(HistorialEntrenamiento::class);
    }
}