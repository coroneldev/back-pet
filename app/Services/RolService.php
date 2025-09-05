<?php

namespace App\Services;

use App\Repositories\RolRepository;
use Illuminate\Support\Facades\Validator;

class RolService
{

    protected $rolRepository;

    public function __construct(RolRepository $rolRepository)
    {
        $this->rolRepository = $rolRepository;
    }

    public function index()
    {
        $roles = $this->rolRepository->listar();

        return response()->json([
            'status'    => true,
            'message'   => 'Registros recuperados existosamente',
            'data'      => $roles
        ], 200);
    }

    public function store($request)
    {
        $validator = Validator::make($request->all(), 
            [
                'nombre'   => 'required',
            ],
            [
                'nombre.required'  => 'El campo Nombre es requerido',
            ]
        );

        if($validator->fails()){
            return response()->json([
                'status'    => false,
                'message'   => 'Error en validaciones',
                'errors'    => $validator->errors()
            ], 200);
        }

        $rol = $this->rolRepository->guardar($request);

        return response()->json([
            'status'    => true,
            'message'   => 'Registro guardado exitosamente',
            'data'      => $rol
        ], 201);
    }

    public function show($id)
    {
        $rol = $this->rolRepository->obtener($id);

        if(is_null($rol)){
            return response()->json([
                'status'    => false,
                'message'   => 'Registro no encontrado'
            ], 200);
        }
        
        return response()->json([
            'status'    => true,
            'message'   => 'Registro recuperado exitosamente',
            'data'      => $rol
        ], 200);
    }

    public function update($request, $id)
    {
        $validator = Validator::make($request->all(), 
            [
                'nombre'   => 'required',
            ],
            [
                'nombre.required'  => 'El campo Nombre es requerido',
            ]
        );

        if($validator->fails()){
            return response()->json([
                'status'    => false,
                'message'   => 'Error en validaciones',
                'errors'    => $validator->errors()
            ], 200);
        }

        $rol = $this->rolRepository->obtener($id);

        if(is_null($rol)){
            return response()->json([
                'status'    => false,
                'message'   => 'Registro no encontrado'
            ], 200);
        }

        $rol = $this->rolRepository->editar($request, $id);

        return response()->json([
            'status'    => true,
            'message'   => 'Registro modificado exitosamente',
            'data'      => $rol
        ], 200);
    }

    public function destroy($id)
    {
        $rol = $this->rolRepository->obtener($id);

        if(is_null($rol)){
            return response()->json([
                'status'    => false,
                'message'   => 'Registro no encontrado'
            ], 200);
        }

        $rol = $this->rolRepository->eliminar($id);

        return response()->json([
            'status'    => true,
            'message'   => 'Registro eliminado exitosamente',
            'data'      => $rol
        ], 200);
    }

}