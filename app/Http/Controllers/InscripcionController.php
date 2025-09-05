<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Inscripcion;
use App\Models\User;
use App\Services\InscripcionService;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\PDF;

class InscripcionController extends Controller
{

    protected $inscripcionService;

    public function __construct(InscripcionService $inscripcionService)
    {
        $this->inscripcionService = $inscripcionService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->inscripcionService->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->inscripcionService->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->inscripcionService->show($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->inscripcionService->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->inscripcionService->destroy($id);
    }

    public function certificado(string $id)
    {

        $inscripcion = Inscripcion::find($id);
        $curso = Curso::find($inscripcion->curso_id);
        $estudiante = User::find($inscripcion->user_id);

        $data = [
            'inscripcion'   => $inscripcion,
            'curso'         => $curso,
            'estudiante'    => $estudiante,
        ];

        $pdf = PDF::loadView('certificadoCurso', $data);
        $pdf->setPaper('Letter', 'landscape');

        //return $pdf->download('tutsmake.pdf');
        return $pdf->output();

    }

    public function indexUsuario()
    {
        return $this->inscripcionService->indexUsuario();
    }

}
