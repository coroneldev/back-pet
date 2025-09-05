<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $table = 'cursos';
    protected $fillable = [
        'nombre',
        'detalle',
        'horario',
        'fecha_inicio',
        'fecha_fin',
        'hora_inicio',
        'hora_fin',
        'fecha_limite',
        'costo',
        'modalidad',
        'imagen',
        'documento',
        'estado',

        'user_creador_id',
        'user_modificador_id',
        'user_eliminador_id',
        'fecha_creacion',
        'fecha_modificacion',
        'fecha_eliminacion',

        'user_id',
        'area_id'
    ];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class);
    }

}
