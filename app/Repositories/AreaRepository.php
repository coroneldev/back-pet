<?php

namespace App\Repositories;

use App\Models\Area;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class AreaRepository
{

    protected $area;

    public function __construct(Area $area)
    {
        $this->area = $area;
    }

    public function listar()
    {
        $areas = Area::whereNull('user_eliminador_id')
                    ->orderBy('id')
                    ->get();
        
        return $areas;
    }

    public function guardar($request)
    {
        $area = new Area();
        $area->nombre       = Str::upper($request->nombre);
        $area->descripcion  = $request->descripcion;
        $area->user_creador_id   = Auth::id();
        $area->fecha_creacion    = date('Y-m-d H:i:s');
        $area->save();

        return $area;
    }

    public function obtener($id)
    {
        $area = Area::whereNull('user_eliminador_id')
                    ->where('id', $id)
                    ->first();

        return $area;
    }

    public function editar($request, $id)
    {
        $area = Area::whereNull('user_eliminador_id')
                    ->where('id', $id)
                    ->first();
                    
        $area->nombre = Str::upper($request->nombre);
        $area->descripcion = $request->descripcion;
        $area->user_modificador_id   = Auth::id();
        $area->fecha_modificacion    = date('Y-m-d H:i:s');
        $area->save();

        return $area;
    }

    public function eliminar($id)
    {
        $area = Area::whereNull('user_eliminador_id')
                    ->where('id', $id)
                    ->first();
        //$area->delete();
        $area->user_eliminador_id = Auth::id();
        $area->fecha_eliminacion  = date('Y-m-d H:i:s');
        $area->save();

        return $area;
    }

}