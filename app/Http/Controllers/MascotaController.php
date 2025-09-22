<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Mascota;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

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
                'nombre'      => 'required|string|max:100',
                'especie'     => 'required|string|max:50',
                'raza'        => 'nullable|string|max:50',
                'edad'        => 'nullable|integer|min:0',
                'peso'        => 'nullable|numeric|min:0',
                'sexo'        => 'nullable|in:MACHO,HEMBRA',
                'detalles'    => 'nullable|string',
                'cliente_id'  => 'required|exists:clientes,id',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Error en validaciones',
                'errors'  => $validator->errors()
            ], 422);
        }

        // Contador basado en registros existentes
        $contador = Mascota::count() + 1;
        $contadorFormatted = str_pad($contador, 5, "0", STR_PAD_LEFT);

        // Generar 3 dígitos aleatorios
        $randomDigits = str_pad(rand(0, 999), 3, "0", STR_PAD_LEFT);

        // Código final
        $codigo = "MASC{$randomDigits}{$contadorFormatted}";

        // Crear mascota (foto quedará null)
        $mascota = Mascota::create(array_merge(
            $request->all(),
            ['codigo' => $codigo, 'foto' => null]
        ));

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
     * Actualizar mascota (sin foto).
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
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
            ], 422);
        }

        $mascota = Mascota::find($id);
        if (!$mascota) {
            return response()->json([
                'status'  => false,
                'message' => 'Mascota no encontrada'
            ], 404);
        }

        // Actualizamos todo menos foto
        $mascota->update($request->except('foto'));

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

    /**
     * Actualizar foto de mascota (nueva función).
     */

    public function updateImagen(Request $request, $id): JsonResponse
    {
        // Validación de foto
        $validator = Validator::make(
            $request->all(),
            [
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            ],
            [
                'foto.image'  => 'El archivo debe ser una imagen válida',
                'foto.mimes'  => 'Solo se permiten imágenes JPEG, PNG, JPG, GIF o WEBP',
                'foto.max'    => 'La imagen no debe superar los 5 MB',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Error en validaciones',
                'errors'  => $validator->errors()
            ], 422);
        }

        // Verificar que la mascota existe
        $mascota = Mascota::whereNull('deleted_at')->with('cliente')->find($id);

        if (!$mascota) {
            return response()->json([
                'status'  => false,
                'message' => 'Mascota no encontrada'
            ], 404);
        }

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');

            // Carpeta por cliente y nombre de mascota
            $cliente = $mascota->cliente;
            $clienteFolder = "Clientes/{$cliente->nombre}-{$cliente->id}/{$mascota->nombre}";

            // Nombre único
            $filename = \Illuminate\Support\Str::uuid() . '.' . $file->getClientOriginalExtension();

            // Guardar archivo en storage/app/public/Clientes/...
            $file->storeAs("public/{$clienteFolder}", $filename);

            // Guardar ruta relativa en BD
            $mascota->foto = "{$clienteFolder}/{$filename}";
            $mascota->save();

            return response()->json([
                'status'  => true,
                'message' => 'Imagen de la mascota guardada correctamente',
                'data'    => $mascota
            ], 200);
        }

        return response()->json([
            'status'  => false,
            'message' => 'No se encontró el archivo de imagen'
        ], 400);
    }

    /**
     * Obtener vacunas de una mascota por ID
     */
    public function vacunasPorCodigo($codigo)
    {
        // Buscar mascota por su código con sus controles y vacunas
        $mascota = Mascota::with(['controles.vacuna', 'controles.usuario'])
            ->where('codigo', $codigo)
            ->first();

        if (!$mascota) {
            return response()->json([
                'status'  => false,
                'message' => 'Mascota no encontrada'
            ], 404);
        }

        // Solo devolvemos los controles/vacunas
        $vacunas = $mascota->controles->map(function ($control) {
            return [
                'id'                => $control->id,
                'vacuna_id'         => $control->vacuna_id,
                'vacuna_nombre'     => $control->vacuna->nombre ?? null,
                'fecha_aplicacion'  => $control->fecha_aplicacion,
                'proxima_aplicacion' => $control->proxima_aplicacion,
                'observaciones'     => $control->observaciones,
                'usuario_id'        => $control->usuario_id,
                'usuario_nombre'    => $control->usuario->nombres ?? null,
            ];
        });

        return response()->json([
            'status'  => true,
            'message' => 'Vacunas de la mascota obtenidas exitosamente',
            'data'    => $vacunas
        ], 200);
    }

    public function generarPDF($codigo)
    {
        $mascota = Mascota::with(['controles.vacuna', 'controles.usuario'])
            ->where('codigo', $codigo)
            ->first();

        if (!$mascota) {
            return response()->json([
                'status'  => false,
                'message' => 'Mascota no encontrada'
            ], 404);
        }

        $vacunas = $mascota->controles;

        $pdf = Pdf::loadView('mascota_vacunas', compact('mascota', 'vacunas'))
            ->setPaper('a4', 'portrait');

        return $pdf->download("Ficha_Mascota_{$mascota->codigo}.pdf");
    }

    //servicio para la app movil
    public function porCodigo($codigo)
    {
        $mascota = Mascota::with('cliente')->where('codigo', $codigo)->first();

        if (!$mascota) {
            return response()->json([
                'status' => false,
                'message' => 'Mascota no encontrada'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Mascota encontrada',
            'data' => $mascota
        ], 200);
    }
}
