<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HistorialEntrenamiento extends Model
{
    protected $fillable = [
        'user_id',
        'rutina_id',
        'fecha_entrenamiento',
        'notas',
    ];

    protected $casts = [
        'fecha_entrenamiento' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function rutina(): BelongsTo
    {
        return $this->belongsTo(Rutina::class);
    }
}