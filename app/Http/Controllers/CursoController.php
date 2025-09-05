<?php

namespace App\Http\Controllers;

use App\Services\CursoService;
use Illuminate\Http\Request;


class CursoController extends Controller
{
    
    protected $cursoService;

    public function __construct(CursoService $cursoService)
    {
        $this->cursoService = $cursoService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->cursoService->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->cursoService->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->cursoService->show($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->cursoService->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->cursoService->destroy($id);
    }

    public function updateImagen(Request $request, string $id)
    {
        return $this->cursoService->updateImagen($request, $id);
    }

    public function indexPortal()
    {
        return $this->cursoService->indexPortal();
    }
}
