<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    /**
     * Mostrar todos los clientes.
     */
    public function index()
    {
        $clientes = Cliente::all();
        return response()->json($clientes);
    }

    /**
     * Guardar un nuevo cliente.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'     => 'required|string',
            'email'      => 'required|email|unique:clientes,email',
            'documento'  => 'required|string|unique:clientes,documento',
            'telefono'   => 'required|string',
            'direccion'  => 'required|string',
        ]);

        $cliente = Cliente::create($request->all());

        return response()->json($cliente, 201);
    }

    /**
     * Mostrar un cliente específico.
     */
    public function show($id)
    {
        $cliente = Cliente::findOrFail($id);
        return response()->json($cliente);
    }

    /**
     * Actualizar un cliente existente.
     */
    public function update(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);

        $request->validate([
            'nombre'     => 'sometimes|required|string',
            'email'      => 'sometimes|required|email|unique:clientes,email,' . $id,
            'documento'  => 'sometimes|required|string|unique:clientes,documento,' . $id,
            'telefono'   => 'sometimes|required|string',
            'direccion'  => 'sometimes|required|string',
        ]);

        $cliente->update($request->all());

        return response()->json($cliente);
    }

    /**
     * Eliminar un cliente.
     */
    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete(); // Si usas soft deletes, se marcará como eliminado

        return response()->json(['message' => 'Cliente eliminado correctamente']);
    }
}
