<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EjercicioRutina extends Model
{
    protected $table = 'ejercicio_rutina';

    protected $fillable = [
        'rutina_id',
        'ejercicio_api_id',
        'series',
        'repeticiones',
        'peso',
    ];

    protected $casts = [
        'series' => 'integer',
        'repeticiones' => 'integer',
        'peso' => 'decimal:2',
    ];

    public function rutina(): BelongsTo
    {
        return $this->belongsTo(Rutina::class);
    }
}