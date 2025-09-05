<?php

namespace App\Repositories;

use App\Models\Curso;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CursoRepository
{

    protected $curso;

    public function __construct(Curso $curso)
    {
        $this->curso = $curso;
    }

    public function listar()
    {
        $cursos = Curso::with(['user','area'])
                        ->whereNull('user_eliminador_id')
                        ->orderBy('id')
                        ->get();
        
        return $cursos;
    }

    public function guardar($request)
    {
        $curso = new Curso();
        $curso->nombre       = $request->nombre;
        $curso->detalle      = $request->detalle;
        $curso->horario      = $request->horario;
        $curso->fecha_inicio = $request->fecha_inicio;
        $curso->fecha_fin    = $request->fecha_fin;
        $curso->hora_inicio  = $request->hora_inicio;
        $curso->hora_fin     = $request->hora_fin;
        $curso->fecha_limite = $request->fecha_limite;
        $curso->costo        = $request->costo;
        $curso->modalidad    = $request->modalidad;
        $curso->imagen       = 'public/curso-imagen/sin-imagen.jpg';//$request->imagen;
        //$curso->documento  = $request->documento;
        $curso->estado       = $request->estado;
        $curso->user_id      = $request->user_id;
        $curso->area_id      = $request->area_id;
        $curso->user_creador_id   = Auth::id();
        $curso->fecha_creacion    = date('Y-m-d H:i:s');
        $curso->save();

        return $curso;
    }

    public function obtener($id)
    {
        $curso = Curso::whereNull('user_eliminador_id')
                        ->where('id', $id)
                        ->first();

        return $curso;
    }

    public function editar($request, $id)
    {
        $curso = Curso::whereNull('user_eliminador_id')
                        ->where('id', $id)
                        ->first();

        $curso->nombre       = $request->nombre;
        $curso->detalle      = $request->detalle;
        $curso->horario      = $request->horario;
        $curso->fecha_inicio = $request->fecha_inicio;
        $curso->fecha_fin    = $request->fecha_fin;
        $curso->hora_inicio  = $request->hora_inicio;
        $curso->hora_fin     = $request->hora_fin;
        $curso->fecha_limite = $request->fecha_limite;
        $curso->costo        = $request->costo;
        $curso->modalidad    = $request->modalidad;
        //$curso->imagen     = $request->imagen;
        //$curso->documento  = $request->documento;
        $curso->estado       = $request->estado;
        $curso->user_id      = $request->user_id;
        $curso->area_id      = $request->area_id;
        $curso->user_modificador_id   = Auth::id();
        $curso->fecha_modificacion    = date('Y-m-d H:i:s');
        $curso->save();

        return $curso;
    }

    public function eliminar($id)
    {
        $curso = Curso::whereNull('user_eliminador_id')
                        ->where('id', $id)
                        ->first();
        //$curso->delete();
        $curso->user_eliminador_id = Auth::id();
        $curso->fecha_eliminacion  = date('Y-m-d H:i:s');
        $curso->save();

        return $curso;
    }

    public function editarImagen($request, $id)
    {
        $curso = Curso::whereNull('user_eliminador_id')
                        ->where('id', $id)
                        ->first();
        
        $file_imagen = $request->file('imagen');
        $path_imagen = $file_imagen->store('public/curso-imagen');
        $curso->imagen = $path_imagen;

        $curso->user_modificador_id   = Auth::id();
        $curso->fecha_modificacion    = date('Y-m-d H:i:s');

        $curso->save();

        return $curso;
    }

    public function listarCursosPortal()
    {
        $cursos = Curso::where('estado', 'ACTIVO')
                        ->whereNull('user_eliminador_id')
                        ->get();
        
        return $cursos;
    }

}