<?php

namespace App\Services;

use App\Repositories\CursoRepository;
use Illuminate\Support\Facades\Validator;

class CursoService
{

    protected $cursoRepository;

    public function __construct(CursoRepository $cursoRepository)
    {
        $this->cursoRepository = $cursoRepository;
    }

    public function index()
    {
        $cursos = $this->cursoRepository->listar();

        return response()->json([
            'status'    => true,
            'message'   => 'Registros recuperados existosamente',
            'data'      => $cursos
        ], 200);
    }

    public function store($request)
    {
        $validator = Validator::make($request->all(), 
            [
                'nombre'        => 'required',
                'detalle'       => 'required',
                'horario'       => 'required',
                'fecha_inicio'  => 'required',
                'fecha_fin'     => 'required',
                //'hora_inicio'   => 'required',
                //'hora_fin'      => 'required',
                'fecha_limite'  => 'required',
                'costo'         => 'required',
                'modalidad'     => 'required',
                //'imagen'      => 'required',
                //'documento'   => 'required',
                'estado'        => 'required',
                //'user_id'       => 'required',
              //  'area_id'       => 'required'
            ],
            [
                'nombre.required'       => 'El campo Nombre es requerido',
                'detalle.required'      => 'El campo Detalle es requerido',
                'horario.required'      => 'El campo Horario es requerido',
                'fecha_inicio.required' => 'El campo Fecha Inicio es requerido',
                'fecha_fin.required'    => 'El campo Fecha Fin es requerido',
                'hora_inicio.required'  => 'El campo Hora Inicio es requerido',
                'hora_fin.required'     => 'El campo Hora Fin es requerido',
                'fecha_limite'          => 'El campo Fecha Límite de Inscripción es requerido',
                'costo.required'        => 'El campo Costo es requerido',
                'modalidad.required'    => 'El campo Modalidad es requerido',
                //'imagen'              => 'required',
                //'documento'           => 'required',
                'estado.required'       => 'El campo Estado es requerido',
                //'user_id.required'      => 'El campo Docente es requerido',
              //  'area_id.required'      => 'El campo Área es requerido'
            ]
        );

        if($validator->fails()){
            return response()->json([
                'status'    => false,
                'message'   => 'Error en validaciones',
                'errors'    => $validator->errors()
            ], 200);
        }

        $curso = $this->cursoRepository->guardar($request);

        return response()->json([
            'status'    => true,
            'message'   => 'Registro guardado exitosamente',
            'data'      => $curso
        ], 201);
    }

    public function show($id)
    {
        $curso = $this->cursoRepository->obtener($id);

        if(is_null($curso)){
            return response()->json([
                'status'    => false,
                'message'   => 'Registro no encontrado'
            ], 200);
        }
        
        return response()->json([
            'status'    => true,
            'message'   => 'Registro recuperado exitosamente',
            'data'      => $curso
        ], 200);
    }

    public function update($request, $id)
    {
        $validator = Validator::make($request->all(), 
            [
                'nombre'        => 'required',
                'detalle'       => 'required',
                'horario'       => 'required',
                'fecha_inicio'  => 'required',
                'fecha_fin'     => 'required',
                //'hora_inicio'   => 'required',
                //'hora_fin'      => 'required',
                'fecha_limite'  => 'required',
                'costo'         => 'required',
                'modalidad'     => 'required',
                //'imagen'      => 'required',
                //'documento'   => 'required',
                'estado'        => 'required',
                //'user_id'       => 'required',
               // 'area_id'       => 'required'
            ],
            [
                'nombre.required'       => 'El campo Nombre es requerido',
                'detalle.required'      => 'El campo Detalle es requerido',
                'horario.required'      => 'El campo Horario es requerido',
                'fecha_inicio.required' => 'El campo Fecha Inicio es requerido',
                'fecha_fin.required'    => 'El campo Fecha Fin es requerido',
                'hora_inicio.required'  => 'El campo Hora Inicio es requerido',
                'hora_fin.required'     => 'El campo Hora Fin es requerido',
                'fecha_limite'          => 'El campo Fecha Límite de Inscripción es requerido',
                'costo.required'        => 'El campo Costo es requerido',
                'modalidad.required'    => 'El campo Modalidad es requerido',
                //'imagen'              => 'required',
                //'documento'           => 'required',
                'estado.required'       => 'El campo Estado es requerido',
                //'user_id.required'      => 'El campo Docente es requerido',
                //'area_id.required'      => 'El campo Área es requerido'
            ]
        );

        if($validator->fails()){
            return response()->json([
                'status'    => false,
                'message'   => 'Error en validaciones',
                'errors'    => $validator->errors()
            ], 200);
        }

        $curso = $this->cursoRepository->obtener($id);

        if(is_null($curso)){
            return response()->json([
                'status'    => false,
                'message'   => 'Registro no encontrado'
            ], 200);
        }

        $curso = $this->cursoRepository->editar($request, $id);

        return response()->json([
            'status'    => true,
            'message'   => 'Registro modificado exitosamente',
            'data'      => $curso
        ], 200);
    }

    public function destroy($id)
    {
        $curso = $this->cursoRepository->obtener($id);

        if(is_null($curso)){
            return response()->json([
                'status'    => false,
                'message'   => 'Registro no encontrado'
            ], 200);
        }

        $curso = $this->cursoRepository->eliminar($id);

        return response()->json([
            'status'    => true,
            'message'   => 'Registro eliminado exitosamente',
            'data'      => $curso
        ], 200);
    }

    public function updateImagen($request, $id)
    {
        $validator = Validator::make($request->all(), 
            [
                'imagen'            => 'required|max:1024',
            ],
            [
                'imagen.required'   => 'El campo Imagen es requerido',
                'imagen.max'        => 'El campo Imagen excede los 1024 KB',
            ]
        );

        if($validator->fails()){
            return response()->json([
                'status'    => false,
                'message'   => 'Error en validaciones',
                'errors'    => $validator->errors()
            ], 200);
        }

        $curso = $this->cursoRepository->obtener($id);

        if(is_null($curso)){
            return response()->json([
                'status'    => false,
                'message'   => 'Registro no encontrado'
            ], 200);
        }

        $curso = $this->cursoRepository->editarImagen($request, $id);

        return response()->json([
            'status'    => true,
            'message'   => 'Registro modificado exitosamente',
            'data'      => $curso
        ], 200);
    }

    public function indexPortal()
    {
        $cursos = $this->cursoRepository->listarCursosPortal();

        return response()->json([
            'status'    => true,
            'message'   => 'Registros recuperados existosamente',
            'data'      => $cursos
        ], 200);
    }

}