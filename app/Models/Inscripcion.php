<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    use HasFactory;

    protected $table = 'inscripciones';
    protected $fillable = [
        'fecha_inscripcion',
        'nota',
        'nota_literal',
        'estado',

        'user_creador_id',
        'user_modificador_id',
        'user_eliminador_id',
        'fecha_creacion',
        'fecha_modificacion',
        'fecha_eliminacion',

        'user_id',
        'curso_id'
    ];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class, 'curso_id');
    }

}
