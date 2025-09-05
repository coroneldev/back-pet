<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vacuna extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'vacuna',
        'fecha',
        'prox_fecha',
        'mascota_id',
        'veterinario_id',
    ];

    /**
     * Relación con Mascota
     */
    public function mascota()
    {
        return $this->belongsTo(Mascota::class);
    }

    /**
     * Relación con Veterinario (Usuario con rol veterinario)
     */
    public function veterinario()
    {
        return $this->belongsTo(User::class, 'veterinario_id');
    }
}
