<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RegistroPeso extends Model
{
    protected $fillable = [
        'user_id',
        'peso',
        'fecha_registro',
    ];

    protected $casts = [
        'peso' => 'decimal:2',
        'fecha_registro' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}