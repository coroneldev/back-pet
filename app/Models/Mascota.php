<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mascota extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'codigo',
        'nombre',
        'edad',
        'peso',
        'foto',
        'especie',
        'raza',
        'sexo',
        'detalles',
        'cliente_id',
    ];

    /**
     * Relación con Cliente
     * Una mascota pertenece a un cliente
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function controles()
    {
        return $this->hasMany(Control::class);
    }
}
