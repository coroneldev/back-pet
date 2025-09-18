<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Control;
use Illuminate\Support\Facades\Validator;

class ControlController extends Controller
{
    /**
     * Listar todos los controles con relaciones.
     */
    public function index()
    {
        $controles = Control::with(['usuario', 'cliente', 'mascota', 'vacuna'])
            ->orderBy('id', 'desc')
            ->get();

        return response()->json([
            'status'  => true,
            'message' => 'Controles recuperados exitosamente',
            'data'    => $controles
        ], 200);
    }

    /**
     * Guardar un nuevo control.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'fecha_aplicacion'   => 'required|date',
                'proxima_aplicacion' => 'nullable|date|after_or_equal:fecha_aplicacion',
                'observaciones'      => 'nullable|string|max:500',
                'vacuna_id'          => 'nullable|exists:vacunas,id',
                'user_id'            => 'required|exists:users,id',
                'cliente_id'         => 'nullable|exists:clientes,id',
                'mascota_id'         => 'nullable|exists:mascotas,id',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Error en validaciones',
                'errors'  => $validator->errors()
            ], 200);
        }

        $control = Control::create($request->all());

        return response()->json([
            'status'  => true,
            'message' => 'Control registrado exitosamente',
            'data'    => $control->load(['usuario', 'cliente', 'mascota', 'vacuna'])
        ], 201);
    }

    /**
     * Mostrar control por ID.
     */
    public function show(string $id)
    {
        $control = Control::with(['usuario', 'cliente', 'mascota', 'vacuna'])->find($id);

        if (!$control) {
            return response()->json([
                'status'  => false,
                'message' => 'Control no encontrado'
            ], 404);
        }

        return response()->json([
            'status'  => true,
            'message' => 'Registro recuperado exitosamente',
            'data'    => $control
        ], 200);
    }

    /**
     * Actualizar control.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'fecha_aplicacion'   => 'required|date',
                'proxima_aplicacion' => 'nullable|date|after_or_equal:fecha_aplicacion',
                'observaciones'      => 'nullable|string|max:500',
                'vacuna_id'          => 'nullable|exists:vacunas,id',
                'user_id'            => 'required|exists:users,id',
                'cliente_id'         => 'nullable|exists:clientes,id',
                'mascota_id'         => 'nullable|exists:mascotas,id',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Error en validaciones',
                'errors'  => $validator->errors()
            ], 200);
        }

        $control = Control::find($id);
        if (!$control) {
            return response()->json([
                'status'  => false,
                'message' => 'Control no encontrado'
            ], 404);
        }

        $control->update($request->all());

        return response()->json([
            'status'  => true,
            'message' => 'Control modificado exitosamente',
            'data'    => $control->load(['usuario', 'cliente', 'mascota', 'vacuna'])
        ], 200);
    }

    /**
     * Eliminar control (soft delete).
     */
    public function destroy(string $id)
    {
        $control = Control::find($id);
        if (!$control) {
            return response()->json([
                'status'  => false,
                'message' => 'Control no encontrado'
            ], 404);
        }

        $control->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Control eliminado exitosamente',
            'data'    => $control
        ], 200);
    }
}
