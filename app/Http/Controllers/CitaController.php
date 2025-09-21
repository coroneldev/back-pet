<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;
use Illuminate\Support\Facades\Validator;


class CitaController extends Controller
{
    /**
     * Listar todas las citas con relaciones.
     */
    public function index()
    {
        $citas = Cita::with(['cliente', 'mascota'])
            ->orderBy('id', 'desc')
            ->get();

        return response()->json([
            'status'  => true,
            'message' => 'Citas recuperadas exitosamente',
            'data'    => $citas
        ], 200);
    }

    /**
     * Guardar una nueva cita.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'fecha'       => 'required|date',
                'hora_inicio' => 'required|date_format:H:i',
                'hora_fin'    => 'required|date_format:H:i',
                'motivo'      => 'required|string|max:255',
                'observacion' => 'nullable|string',
                'cliente_id'  => 'required|exists:clientes,id',
                'mascota_id'  => 'required|exists:mascotas,id',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Error en validaciones',
                'errors'  => $validator->errors()
            ], 422);
        }

        $cita = Cita::create($request->all());

        return response()->json([
            'status'  => true,
            'message' => 'Cita registrada exitosamente',
            'data'    => $cita->load(['cliente', 'mascota'])
        ], 201);
    }

    /**
     * Mostrar cita por ID.
     */
    public function show(string $id)
    {
        $cita = Cita::with(['cliente', 'mascota'])->find($id);

        if (!$cita) {
            return response()->json([
                'status'  => false,
                'message' => 'Cita no encontrada'
            ], 404);
        }

        return response()->json([
            'status'  => true,
            'message' => 'Registro recuperado exitosamente',
            'data'    => $cita
        ], 200);
    }

    /**
     * Actualizar cita.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make(
            $request->all(),
            [

                'fecha'       => 'required|date',
                'hora_inicio' => 'required|date_format:H:i',
                'hora_fin'    => 'required|date_format:H:i',
                'motivo'      => 'required|string|max:255',
                'observacion' => 'nullable|string',
                'cliente_id'  => 'required|exists:clientes,id',
                'mascota_id'  => 'required|exists:mascotas,id',
                'user_id'     => 'required|exists:usuarios,id',

            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Error en validaciones',
                'errors'  => $validator->errors()
            ], 422);
        }

        $cita = Cita::find($id);
        if (!$cita) {
            return response()->json([
                'status'  => false,
                'message' => 'Cita no encontrada'
            ], 404);
        }

        $cita->update($request->all());

        return response()->json([
            'status'  => true,
            'message' => 'Cita modificada exitosamente',
            'data'    => $cita->load(['cliente', 'mascota'])
        ], 200);
    }

    /**
     * Eliminar cita (soft delete).
     */
    public function destroy(string $id)
    {
        $cita = Cita::find($id);
        if (!$cita) {
            return response()->json([
                'status'  => false,
                'message' => 'Cita no encontrada'
            ], 404);
        }

        $cita->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Cita eliminada exitosamente',
            'data'    => $cita
        ], 200);
    }
}
