<?php

namespace App\Services;

use App\Repositories\AreaRepository;
use Illuminate\Support\Facades\Validator;

class AreaService
{

    protected $areaRepository;

    public function __construct(AreaRepository $areaRepository)
    {
        $this->areaRepository = $areaRepository;
    }

    public function index()
    {
        $areas = $this->areaRepository->listar();

        return response()->json([
            'status'    => true,
            'message'   => 'Registros recuperados existosamente',
            'data'      => $areas
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

        $area = $this->areaRepository->guardar($request);

        return response()->json([
            'status'    => true,
            'message'   => 'Registro guardado exitosamente',
            'data'      => $area
        ], 201);
    }

    public function show($id)
    {
        $area = $this->areaRepository->obtener($id);

        if(is_null($area)){
            return response()->json([
                'status'    => false,
                'message'   => 'Registro no encontrado'
            ], 200);
        }
        
        return response()->json([
            'status'    => true,
            'message'   => 'Registro recuperado exitosamente',
            'data'      => $area
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

        $area = $this->areaRepository->obtener($id);

        if(is_null($area)){
            return response()->json([
                'status'    => false,
                'message'   => 'Registro no encontrado'
            ], 200);
        }

        $area = $this->areaRepository->editar($request, $id);

        return response()->json([
            'status'    => true,
            'message'   => 'Registro modificado exitosamente',
            'data'      => $area
        ], 200);
    }

    public function destroy($id)
    {
        $area = $this->areaRepository->obtener($id);

        if(is_null($area)){
            return response()->json([
                'status'    => false,
                'message'   => 'Registro no encontrado'
            ], 200);
        }

        $area = $this->areaRepository->eliminar($id);

        return response()->json([
            'status'    => true,
            'message'   => 'Registro eliminado exitosamente',
            'data'      => $area
        ], 200);
    }

}