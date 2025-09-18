<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Control extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'controles';

    protected $fillable = [
        'fecha_aplicacion',
        'proxima_aplicacion',
        'observaciones',

        'vacuna_id',
        'user_id',            // Responsable del control (veterinario / usuario)
        'cliente_id',            // Si aplica a un cliente específico
        'mascota_id',            // Si aplica a una mascota específica
    ];

    /**
     * Relación con Usuario
     * Un control pertenece a un usuario (veterinario o responsable)
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    /**
     * Relación con Cliente
     * Un control puede pertenecer a un cliente
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    /**
     * Relación con Mascota
     * Un control puede pertenecer a una mascota
     */
    public function mascota()
    {
        return $this->belongsTo(Mascota::class);
    }

    /**
     * Relación con Vacuna
     * Un control puede pertenecer a una vacuna
     */

    public function vacuna()
    {
        return $this->belongsTo(Vacuna::class);
    }
}
