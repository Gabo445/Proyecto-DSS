<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'edad',
        'peso_objetivo',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'edad' => 'integer',
        'peso_objetivo' => 'decimal:2',
    ];

    // Relaciones
    public function registrosPeso(): HasMany
    {
        return $this->hasMany(RegistroPeso::class);
    }

    public function rutinas(): HasMany
    {
        return $this->hasMany(Rutina::class);
    }

    public function historialEntrenamientos(): HasMany
    {
        return $this->hasMany(HistorialEntrenamiento::class);
    }
}