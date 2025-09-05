<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'apellido_paterno',
        'apellido_materno',
        'nombres',
        'cedula_identidad',
        'expedicion_ci',
        'fecha_nacimiento',
        'sexo',
        'celular',
        'estado',
        'email',
        'password',

        'user_creador_id',
        'user_modificador_id',
        'user_eliminador_id',
        'fecha_creacion',
        'fecha_modificacion',
        'fecha_eliminacion',

        'rol_id'
    ];

    public $timestamps = false;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }

}
