<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $fillable = [
        'nombre',
        'descripcion',

        'user_creador_id',
        'user_modificador_id',
        'user_eliminador_id',
        'fecha_creacion',
        'fecha_modificacion',
        'fecha_eliminacion',
    ];
    public $timestamps = false;

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
