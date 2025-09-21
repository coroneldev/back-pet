<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $table = 'citas';
    protected $fillable = [
        'mascota_id',
        'cliente_id',
        'fecha',
        'hora_inicio',
        'hora_fin',
        'motivo',
        'estado',

    ];
    public $timestamps = false;

    /**
     * Relación con la mascota
     */
    public function mascota()
    {
        return $this->belongsTo(Mascota::class);
    }

    /**
     * Relación con el cliente
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }


}
