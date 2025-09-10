<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mascota;
use App\Models\Cliente;
use Illuminate\Support\Facades\Validator;

class MascotaController extends Controller
{
    /**
     * Listar todas las mascotas con cliente.
     */
    public function index()
    {
        $mascotas = Mascota::with('cliente')
            ->orderBy('id', 'desc') // Ordenar descendente por ID
            ->get();

        return response()->json([
            'status'  => true,
            'message' => 'Mascotas recuperadas exitosamente',
            'data'    => $mascotas
        ], 200);
    }

    /**
     * Guardar una nueva mascota.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'codigo'      => 'required|string|unique:mascotas,codigo',
                'nombre'      => 'required|string|max:100',
                'especie'     => 'required|string|max:50',
                'raza'        => 'nullable|string|max:50',
                'edad'        => 'nullable|integer|min:0',
                'peso'        => 'nullable|numeric|min:0',
                'sexo'        => 'nullable|in:MACHO,HEMBRA',
                'detalles'    => 'nullable|string',
                'cliente_id'  => 'required|exists:clientes,id'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Error en validaciones',
                'errors'  => $validator->errors()
            ], 200);
        }

        $mascota = Mascota::create($request->all());

        return response()->json([
            'status'  => true,
            'message' => 'Mascota registrada exitosamente',
            'data'    => $mascota->load('cliente')
        ], 201);
    }


    /**
     * Mostrar mascota por ID.
     */
    public function show(string $id)
    {
        $mascota = Mascota::with('cliente')->find($id);

        if (!$mascota) {
            return response()->json([
                'status'  => false,
                'message' => 'Mascota no encontrada'
            ], 404);
        }

        return response()->json([
            'status'  => true,
            'message' => 'Registro recuperado exitosamente',
            'data'    => $mascota
        ], 200);
    }


    /**
     * Actualizar mascota.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'codigo'      => 'required|string|unique:mascotas,codigo,' . $id,
                'nombre'      => 'required|string|max:100',
                'especie'     => 'required|string|max:50',
                'raza'        => 'nullable|string|max:50',
                'edad'        => 'nullable|integer|min:0',
                'peso'        => 'nullable|numeric|min:0',
                'sexo'        => 'nullable|in:MACHO,HEMBRA',
                'detalles'    => 'nullable|string',
                'cliente_id'  => 'required|exists:clientes,id'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Error en validaciones',
                'errors'  => $validator->errors()
            ], 200);
        }

        $mascota = Mascota::find($id);
        if (!$mascota) {
            return response()->json([
                'status'  => false,
                'message' => 'Mascota no encontrada'
            ], 404);
        }

        $mascota->update($request->all());

        return response()->json([
            'status'  => true,
            'message' => 'Mascota modificada exitosamente',
            'data'    => $mascota->load('cliente')
        ], 200);
    }

    /**
     * Eliminar mascota (soft delete).
     */
    public function destroy(string $id)
    {
        $mascota = Mascota::find($id);
        if (!$mascota) {
            return response()->json([
                'status'  => false,
                'message' => 'Mascota no encontrada'
            ], 404);
        }

        $mascota->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Mascota eliminada exitosamente',
            'data'    => $mascota
        ], 200);
    }
}
