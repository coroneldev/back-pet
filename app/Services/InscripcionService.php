<?php

namespace App\Services;

use App\Repositories\InscripcionRepository;
use Illuminate\Support\Facades\Validator;

class InscripcionService
{

    protected $inscripcionRepository;

    public function __construct(InscripcionRepository $inscripcionRepository)
    {
        $this->inscripcionRepository = $inscripcionRepository;
    }

    public function index()
    {
        $inscripciones = $this->inscripcionRepository->listar();

        return response()->json([
            'status'    => true,
            'message'   => 'Registros recuperados existosamente',
            'data'      => $inscripciones
        ], 200);
    }

    public function store($request)
    {
        $validator = Validator::make($request->all(), 
            [
                //'estado'    => 'required',
                'user_id'   => 'required',
                'curso_id'  => 'required'
            ],
            [
                //'estado.required'   => 'El campo Estado es requerido',
                'user_id.required'  => 'El campo Usuario es requerido',
                'curso_id.required' => 'El campo Curso es requerido'
            ]
        );

        if($validator->fails()){
            return response()->json([
                'status'    => false,
                'message'   => 'Error en validaciones',
                'errors'    => $validator->errors()
            ], 200);
        }

        $inscripcion = $this->inscripcionRepository->verificaInscripcion($request);

        if($inscripcion){
            return response()->json([
                'status'    => false,
                'message'   => 'El estudiante ya se encuentra inscrito en el curso'
            ], 200);
        }

        if($request->nota && $request->nota > 100){
            return response()->json([
                'status'    => false,
                'message'   => 'La Nota debe estar entre 1 y 100'
            ], 200);
        }

        if($request->nota && $request->nota < 0){
            return response()->json([
                'status'    => false,
                'message'   => 'La Nota debe estar entre 1 y 100'
            ], 200);
        }

        $inscripcion = $this->inscripcionRepository->guardar($request);

        return response()->json([
            'status'    => true,
            'message'   => 'Registro guardado exitosamente',
            'data'      => $inscripcion
        ], 201);
    }

    public function show($id)
    {
        $inscripcion = $this->inscripcionRepository->obtener($id);

        if(is_null($inscripcion)){
            return response()->json([
                'status'    => false,
                'message'   => 'Registro no encontrado'
            ], 200);
        }
        
        return response()->json([
            'status'    => true,
            'message'   => 'Registro recuperado exitosamente',
            'data'      => $inscripcion
        ], 200);
    }

    public function update($request, $id)
    {
        $validator = Validator::make($request->all(), 
            [
                //'estado'    => 'required',
                'user_id'   => 'required',
                'curso_id'  => 'required'
            ],
            [
                //'estado.required'   => 'El campo Estado es requerido',
                'user_id.required'  => 'El campo Usuario es requerido',
                'curso_id.required' => 'El campo Curso es requerido'
            ]
        );

        if($validator->fails()){
            return response()->json([
                'status'    => false,
                'message'   => 'Error en validaciones',
                'errors'    => $validator->errors()
            ], 200);
        }

        $inscripcion= $this->inscripcionRepository->obtener($id);

        if(is_null($inscripcion)){
            return response()->json([
                'status'    => false,
                'message'   => 'Registro no encontrado'
            ], 200);
        }

        if($request->nota && $request->nota > 100){
            return response()->json([
                'status'    => false,
                'message'   => 'La Nota debe estar entre 1 y 100'
            ], 200);
        }

        if($request->nota && $request->nota < 0){
            return response()->json([
                'status'    => false,
                'message'   => 'La Nota debe estar entre 1 y 100'
            ], 200);
        }

        $inscripcion = $this->inscripcionRepository->editar($request, $id);

        return response()->json([
            'status'    => true,
            'message'   => 'Registro modificado exitosamente',
            'data'      => $inscripcion
        ], 200);
    }

    public function destroy($id)
    {
        $inscripcion = $this->inscripcionRepository->obtener($id);

        if(is_null($inscripcion)){
            return response()->json([
                'status'    => false,
                'message'   => 'Registro no encontrado'
            ], 200);
        }

        $inscripcion = $this->inscripcionRepository->eliminar($id);

        return response()->json([
            'status'    => true,
            'message'   => 'Registro eliminado exitosamente',
            'data'      => $inscripcion
        ], 200);
    }

    public function indexUsuario()
    {
        $inscripciones = $this->inscripcionRepository->listarPorUsuario();

        return response()->json([
            'status'    => true,
            'message'   => 'Registros recuperados existosamente',
            'data'      => $inscripciones
        ], 200);
    }

}