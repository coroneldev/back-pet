<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->userService->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->userService->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->userService->show($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->userService->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->userService->destroy($id);
    }

    public function storePortal(Request $request)
    {
        return $this->userService->storePortal($request);
    }

    public function obtenerEstudianteCi(string $ci)
    {
        return $this->userService->obtenerEstudianteCi($ci);
    }

    public function resetPassword(Request $request, string $id)
    {
        return $this->userService->resetPassword($request, $id);
    }

    public function cambiarPassword(Request $request, string $id)
    {
        return $this->userService->cambiarPassword($request, $id);
    }

    public function indexDocentes()
    {
        return $this->userService->indexDocentes();
    }

}
