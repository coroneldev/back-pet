<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class UserRepository
{

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function listar()
    {
        $users = User::with(['rol'])
                        ->whereNull('user_eliminador_id')
                        ->orderBy('id')
                        ->get();
        
        return $users;
    }

    public function guardar($request)
    {
        $user = new User();
        $user->apellido_paterno = Str::upper($request->apellido_paterno);
        $user->apellido_materno = Str::upper($request->apellido_materno);
        $user->nombres          = Str::upper($request->nombres);
        $user->cedula_identidad = $request->cedula_identidad;
        $user->expedicion_ci    = Str::upper($request->expedicion_ci);
        $user->fecha_nacimiento = $request->fecha_nacimiento;
        $user->sexo             = Str::upper($request->sexo);
        $user->celular          = $request->celular;
        $user->email            = $request->email;
        $user->password         = bcrypt($request->password);
        $user->estado           = $request->estado;
        $user->rol_id           = $request->rol_id;
        $user->user_creador_id   = Auth::id();
        $user->fecha_creacion    = date('Y-m-d H:i:s');
        $user->save();

        return $user;
    }

    public function obtener($id)
    {
        $user = User::whereNull('user_eliminador_id')
                    ->where('id', $id)
                    ->first();

        return $user;
    }

    public function editar($request, $id)
    {
        $user = User::find($id);
        $user->apellido_paterno = Str::upper($request->apellido_paterno);
        $user->apellido_materno = Str::upper($request->apellido_materno);
        $user->nombres          = Str::upper($request->nombres);
        $user->cedula_identidad = $request->cedula_identidad;
        $user->expedicion_ci    = Str::upper($request->expedicion_ci);
        $user->fecha_nacimiento = $request->fecha_nacimiento;
        $user->sexo             = Str::upper($request->sexo);
        $user->celular          = $request->celular;
        $user->email            = $request->email;
        //$user->password         = bcrypt($request->password);
        $user->estado           = $request->estado;
        $user->rol_id           = $request->rol_id;
        $user->user_modificador_id   = Auth::id();
        $user->fecha_modificacion    = date('Y-m-d H:i:s');
        $user->save();

        return $user;
    }

    public function eliminar($id)
    {
        $user = User::whereNull('user_eliminador_id')
                    ->where('id', $id)
                    ->first();
        //$user->delete();
        $user->user_eliminador_id = Auth::id();
        $user->fecha_eliminacion  = date('Y-m-d H:i:s');
        $user->save();

        return $user;
    }

    public function guardarUserPortal($request)
    {
        $user = new User();
        $user->apellido_paterno = Str::upper($request->apellido_paterno);
        $user->apellido_materno = Str::upper($request->apellido_materno);
        $user->nombres          = Str::upper($request->nombres);
        $user->cedula_identidad = $request->cedula_identidad;
        $user->expedicion_ci    = Str::upper($request->expedicion_ci);
        $user->fecha_nacimiento = $request->fecha_nacimiento;
        $user->sexo             = Str::upper($request->sexo);
        $user->celular          = $request->celular;
        $user->email            = $request->email;
        $user->password         = bcrypt($request->password);
        $user->estado           = 'ACTIVO';
        $user->rol_id           = 3;
        $user->save();

        return $user;
    }

    public function obtenerEstudianteCi($ci)
    {
        $user = User::whereNull('user_eliminador_id')
                    ->where('rol_id', 3)
                    ->where('cedula_identidad', $ci)
                    ->first();

        return $user;
    }

    public function resetPassword($request, $id)
    {
        $user = User::whereNull('user_eliminador_id')
                    ->where('id', $id)
                    ->first();
        $user->password = bcrypt($user->cedula_identidad);
        $user->user_modificador_id   = Auth::id();
        $user->fecha_modificacion    = date('Y-m-d H:i:s');
        $user->save();

        return $user;
    }

    public function cambiarPassword($request, $id)
    {
        $user = User::whereNull('user_eliminador_id')
                    ->where('id', $id)
                    ->first();
        $user->password = bcrypt($request->nuevo_password);
        $user->user_modificador_id   = Auth::id();
        $user->fecha_modificacion    = date('Y-m-d H:i:s');
        $user->save();

        return $user;
    }

    public function listarDocentes()
    {
        $users = User::with(['rol'])
                        ->whereNull('user_eliminador_id')
                        ->where('rol_id', 2)
                        ->orderBy('id')
                        ->get();
        
        return $users;
    }

}