<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vacuna extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nombre',
        'descripcion',
        'numero_dosis_requeridas',
        'intervalo_dosis',
        'especie_destinada',
        'estado',
    ];

    /**
     * Relación con Mascotas (muchas mascotas pueden tener esta vacuna).
     */
    public function mascotas()
    {
        return $this->belongsToMany(Mascota::class, 'mascota_vacuna')
            ->withPivot(['fecha_aplicacion', 'proxima_aplicacion', 'observaciones'])
            ->withTimestamps();
    }

    /**
     * Relación con Veterinario (Usuario con rol veterinario).
     */
    public function veterinario()
    {
        return $this->belongsTo(User::class, 'veterinario_id');
    }
}
