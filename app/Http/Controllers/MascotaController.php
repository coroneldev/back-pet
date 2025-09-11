<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mascota;
use App\Models\Cliente;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class MascotaController extends Controller
{
    /**
     * Listar todas las mascotas con cliente.
     */
    public function index()
    {
        $mascotas = Mascota::with('cliente')
            ->orderBy('id', 'desc')
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
                'cliente_id'  => 'required|exists:clientes,id',
                'foto'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
                // 'foto'        => 'nullable'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Error en validaciones',
                'errors'  => $validator->errors()
            ], 200);
        }

        // Creamos primero la mascota sin la foto
        $mascota = Mascota::create($request->except('foto'));

        // Procesamos la foto si viene
        if ($request->hasFile('foto')) {
            $cliente = $mascota->cliente;
            $clienteFolder = "Clientes/{$cliente->nombre}-{$cliente->id}/{$mascota->nombre}";


            // Guardamos con el código de la mascota como nombre de archivo
            $path = $request->file('foto')->storeAs(
                "public/{$clienteFolder}",
                $mascota->codigo . '.' . $request->file('foto')->getClientOriginalExtension()
            );

            // Guardamos en BD la ruta accesible públicamente
            //$mascota->foto = str_replace("public/", "storage/", $path);
            $mascota->foto = str_replace("public/mascotas/", "", $path);
            $mascota->save();
        }

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
                // 'foto'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                //  'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
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

        // Actualizamos campos excepto foto
        $mascota->update($request->except('foto'));

        // Si viene una nueva foto, reemplazar
        if ($request->hasFile('foto')) {
            $cliente = $mascota->cliente;
            $clienteFolder = "Clientes/{$cliente->nombre}-{$cliente->id}/{$mascota->nombre}";

            // Borramos la foto anterior si existe
            /* if ($mascota->foto && Storage::exists(str_replace("storage/", "public/", $mascota->foto))) {
                Storage::delete(str_replace("storage/", "public/", $mascota->foto));
            }*/

            /* $path = $request->file('foto')->storeAs(
                "public/{$clienteFolder}",
                $mascota->codigo . '.' . $request->file('foto')->getClientOriginalExtension()
            );*/
            // Guardar el archivo dentro de storage/app/public/Clientes/...
            /* $path = $request->file('foto')->storeAs(
                "public/mascotas/{$clienteFolder}",
                $mascota->codigo . '.' . $request->file('foto')->getClientOriginalExtension()
            );*/

            /* $mascota->foto = str_replace("public/", "storage/", $path);
            $mascota->save();*/

            // Guardamos en BD la ruta relativa **sin 'public/mascotas/'**
            //$mascota->foto = "{$clienteFolder}/{$mascota->codigo}." . $request->file('foto')->getClientOriginalExtension();

            $path = $request->file('foto')->storeAs(
                "public/Clientes/{$cliente->nombre}-{$cliente->id}/{$mascota->nombre}",
                $mascota->codigo . '.' . $request->file('foto')->getClientOriginalExtension()
            );
            $mascota->foto = "Clientes/{$cliente->nombre}-{$cliente->id}/{$mascota->nombre}/{$mascota->codigo}." . $request->file('foto')->getClientOriginalExtension();
            $mascota->save();
        }

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
