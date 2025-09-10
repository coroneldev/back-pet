<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vacuna;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class VacunaController extends Controller
{
    /**
     * Listar todas las vacunas.
     */
    public function index()
    {
        $vacunas = Vacuna::with('veterinario')
            ->orderBy('id', 'desc')
            ->get();

        return response()->json([
            'status'  => true,
            'message' => 'Vacunas recuperadas exitosamente',
            'data'    => $vacunas
        ], 200);
    }

    /**
     * Guardar una nueva vacuna en el catálogo.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nombre'                  => 'required|string|max:100|unique:vacunas,nombre',
                'descripcion'             => 'nullable|string',
                'numero_dosis_requeridas' => 'required|integer|min:1',
                'intervalo_dosis'         => 'nullable|integer|min:0',
                'especie_destinada'       => 'required|string|max:50',
                'estado'                  => 'nullable|boolean',
                'veterinario_id'          => 'nullable|exists:users,id'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Error en validaciones',
                'errors'  => $validator->errors()
            ], 200);
        }

        $vacuna = Vacuna::create($request->all());

        return response()->json([
            'status'  => true,
            'message' => 'Vacuna registrada exitosamente',
            'data'    => $vacuna->load('veterinario')
        ], 201);
    }

    /**
     * Mostrar vacuna por ID.
     */
    public function show(string $id)
    {
        $vacuna = Vacuna::with('veterinario')->find($id);

        if (!$vacuna) {
            return response()->json([
                'status'  => false,
                'message' => 'Vacuna no encontrada'
            ], 404);
        }

        return response()->json([
            'status'  => true,
            'message' => 'Registro recuperado exitosamente',
            'data'    => $vacuna
        ], 200);
    }

    /**
     * Actualizar vacuna.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nombre'                  => 'required|string|max:100|unique:vacunas,nombre,' . $id,
                'descripcion'             => 'nullable|string',
                'numero_dosis_requeridas' => 'required|integer|min:1',
                'intervalo_dosis'         => 'nullable|integer|min:0',
                'especie_destinada'       => 'required|string|max:50',
                'estado'                  => 'nullable|boolean',
                'veterinario_id'          => 'nullable|exists:users,id'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Error en validaciones',
                'errors'  => $validator->errors()
            ], 200);
        }

        $vacuna = Vacuna::find($id);
        if (!$vacuna) {
            return response()->json([
                'status'  => false,
                'message' => 'Vacuna no encontrada'
            ], 404);
        }

        $vacuna->update($request->all());

        return response()->json([
            'status'  => true,
            'message' => 'Vacuna modificada exitosamente',
            'data'    => $vacuna->load('veterinario')
        ], 200);
    }

    /**
     * Eliminar vacuna (soft delete).
     */
    public function destroy(string $id)
    {
        $vacuna = Vacuna::find($id);
        if (!$vacuna) {
            return response()->json([
                'status'  => false,
                'message' => 'Vacuna no encontrada'
            ], 404);
        }

        $vacuna->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Vacuna eliminada exitosamente',
            'data'    => $vacuna
        ], 200);
    }
}
