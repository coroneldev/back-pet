<?php

namespace App\Repositories;

use App\Models\Rol;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class RolRepository
{

    protected $rol;

    public function __construct(Rol $rol)
    {
        $this->rol = $rol;
    }

    public function listar()
    {
        $roles = Rol::whereNull('user_eliminador_id')
                    ->orderBy('id')
                    ->get();
        
        return $roles;
    }

    public function guardar($request)
    {
        $rol = new Rol();
        $rol->nombre            = Str::upper($request->nombre);
        $rol->descripcion       = $request->descripcion;
        $rol->user_creador_id   = Auth::id();
        $rol->fecha_creacion    = date('Y-m-d H:i:s');
        $rol->save();

        return $rol;
    }

    public function obtener($id)
    {
        $rol = Rol::whereNull('user_eliminador_id')
                    ->where('id', $id)
                    ->first();

        return $rol;
    }

    public function editar($request, $id)
    {
        $rol = Rol::whereNull('user_eliminador_id')
                    ->where('id', $id)
                    ->first();
        $rol->nombre                = Str::upper($request->nombre);
        $rol->descripcion           = $request->descripcion;
        $rol->user_modificador_id   = Auth::id();
        $rol->fecha_modificacion    = date('Y-m-d H:i:s');
        $rol->save();

        return $rol;
    }

    public function eliminar($id)
    {
        $rol = Rol::whereNull('user_eliminador_id')
                    ->where('id', $id)
                    ->first();
        //$rol->delete();
        $rol->user_eliminador_id = Auth::id();
        $rol->fecha_eliminacion  = date('Y-m-d H:i:s');
        $rol->save();

        return $rol;
    }

}