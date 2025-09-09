<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::all();

        return response()->json([
            'status'    => true,
            'message'   => 'Registros recuperados exitosamente',
            'data'      => $clientes
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nombre'   => 'required|string|max:100',
                'email'    => 'required|email|unique:clientes,email',
                'telefono' => 'nullable|string|max:20',
            ],
            [
                'nombre.required'  => 'El campo Nombre es requerido',
                'email.required'   => 'El campo Email es requerido',
                'email.email'      => 'Debe ser un correo válido',
                'email.unique'     => 'El correo ya está registrado',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status'    => false,
                'message'   => 'Error en validaciones',
                'errors'    => $validator->errors()
            ], 200);
        }

        $cliente = Cliente::create($request->all());

        return response()->json([
            'status'    => true,
            'message'   => 'Registro guardado exitosamente',
            'data'      => $cliente
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cliente = Cliente::find($id);

        if (is_null($cliente)) {
            return response()->json([
                'status'    => false,
                'message'   => 'Registro no encontrado'
            ], 404);
        }

        return response()->json([
            'status'    => true,
            'message'   => 'Registro recuperado exitosamente',
            'data'      => $cliente
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nombre'   => 'required|string|max:100',
                'email'    => 'required|email|unique:clientes,email,' . $id,
                'telefono' => 'nullable|string|max:20',
            ],
            [
                'nombre.required'  => 'El campo Nombre es requerido',
                'email.required'   => 'El campo Email es requerido',
                'email.email'      => 'Debe ser un correo válido',
                'email.unique'     => 'El correo ya está registrado',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status'    => false,
                'message'   => 'Error en validaciones',
                'errors'    => $validator->errors()
            ], 200);
        }

        $cliente = Cliente::find($id);

        if (is_null($cliente)) {
            return response()->json([
                'status'    => false,
                'message'   => 'Registro no encontrado'
            ], 404);
        }

        $cliente->update($request->all());

        return response()->json([
            'status'    => true,
            'message'   => 'Registro modificado exitosamente',
            'data'      => $cliente
        ], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cliente = Cliente::find($id);

        if (is_null($cliente)) {
            return response()->json([
                'status'    => false,
                'message'   => 'Registro no encontrado'
            ], 404);
        }

        $cliente->delete();

        return response()->json([
            'status'    => true,
            'message'   => 'Registro eliminado exitosamente',
            'data'      => $cliente
        ], 200);
    }
}
