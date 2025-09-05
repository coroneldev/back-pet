<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'nombre',
        'email',
        'documento',
        'telefono',
        'direccion',
    ];
    /**
     * Relación con Mascotas
     * Un cliente puede tener muchas mascotas
     */
    public function mascotas()
    {
        return $this->hasMany(Mascota::class);
    }
}
