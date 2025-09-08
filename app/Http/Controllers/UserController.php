<?php

namespace App\Http\Controllers;

//use App\Services\UserService;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $users = User::all();

        return response()->json([
            'status'    => true,
            'message'   => 'Registros recuperados existosamente',
            'data'      => $users
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
                //'apellido_paterno'  => 'required',
                //'apellido_materno'  => 'required',
                'nombres'           => 'required',
                'cedula_identidad'  => 'required|unique:users,cedula_identidad',
                'expedicion_ci'     => 'required',
                'fecha_nacimiento'  => 'required',
                'sexo'              => 'required',
                'celular'           => 'required|unique:users,celular',
                'email'             => 'required|unique:users,email',
                'password'          => 'required',
                'estado'            => 'required',
                'rol_id'            => 'required'
            ],
            [
                //'apellido_paterno.required' => 'El campo Apellido Paterno es requerido',
                //'apellido_materno.required' => 'El campo Apellido Materno es requerido',
                'nombres.required'          => 'El campo Nombres es requerido',
                'cedula_identidad.required' => 'El campo Cédula de Identidad es requerido',
                'cedula_identidad.unique'   => 'El campo Cédula de Identidad ya fue usado',
                'expedicion_ci.required'    => 'El campo Expedición de CI es requerido',
                'fecha_nacimiento.required' => 'El campo Fecha Nacimiento es requerido',
                'sexo.required'             => 'El campo Sexo es requerido',
                'celular.required'          => 'El campo Celular es requerido',
                'celular.unique'            => 'El campo Celular ya fue usado',
                'email.required'            => 'El campo Correo Electrónico es requerido',
                'email.unique'              => 'El campo Correo Electrónico ya fue usado',
                'password.required'         => 'El campo Contraseña es requerido',
                'estado.required'           => 'El campo Estado es requerido',
                'rol_id.required'           => 'El campo Rol es requerido'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status'    => false,
                'message'   => 'Error en validaciones',
                'errors'    => $validator->errors()
            ], 200);
        }

        $user = User::create($request->all());

        return response()->json([
            'status'    => true,
            'message'   => 'Registro guardado exitosamente',
            'data'      => $user
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        if (is_null($user)) {
            return response()->json([
                'status'    => false,
                'message'   => 'Registro no encontrado'
            ], 200);
        }

        return response()->json([
            'status'    => true,
            'message'   => 'Registro recuperado exitosamente',
            'data'      => $user
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $user = User::findOrFail($id);

        $validator = Validator::make(
            $request->all(),
            [
                //'apellido_paterno'  => 'required',
                //'apellido_materno'  => 'required',
                'nombres'           => 'required',
                'cedula_identidad'  => 'required',
                'expedicion_ci'     => 'required',
                'fecha_nacimiento'  => 'required',
                'sexo'              => 'required',
                'celular'           => 'required',
                'email'             => 'required',
                //'password'          => 'required',
                'rol_id'            => 'required'
            ],
            [
                //'apellido_paterno.required' => 'El campo Apellido Paterno es requerido',
                //'apellido_materno.required' => 'El campo Apellido Materno es requerido',
                'nombres.required'          => 'El campo Nombres es requerido',
                'cedula_identidad.required' => 'El campo Cédula de Identidad es requerido',
                'expedicion_ci.required'    => 'El campo Expedición de CI es requerido',
                'fecha_nacimiento.required' => 'El campo Fecha Nacimiento es requerido',
                'sexo.required'             => 'El campo Sexo es requerido',
                'celular.required'          => 'El campo Celular es requerido',
                'email.required'            => 'El campo Correo Electrónico es requerido',
                //'password.required'         => 'El campo Contraseña es requerido',
                'rol_id.required'           => 'El campo Rol es requerido'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status'    => false,
                'message'   => 'Error en validaciones',
                'errors'    => $validator->errors()
            ], 200);
        }
        $user->update($request->all());


        if (is_null($user)) {
            return response()->json([
                'status'    => false,
                'message'   => 'Registro no encontrado'
            ], 200);
        }

        return response()->json([
            'status'    => true,
            'message'   => 'Registro modificado exitosamente',
            'data'      => $user
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['message' => 'Usuario eliminado correctamente']);
    }

    /* public function resetPassword(Request $request, string $id)
    {
        return $this->userService->resetPassword($request, $id);
    }

    public function cambiarPassword(Request $request, string $id)
    {
        return $this->userService->cambiarPassword($request, $id);
    }*/

    public function resetPassword(Request $request, string $id)
    {

        $user = User::whereNull('user_eliminador_id')
            ->where('id', $id)
            ->first();
        $user->password = bcrypt($user->cedula_identidad);
        $user->user_modificador_id   = Auth::id();
        $user->fecha_modificacion    = date('Y-m-d H:i:s');
        $user->save();

        return response()->json([
            'status'    => true,
            'message'   => 'Contraseña reseteado exitosamente',
            'data'      => $user
        ], 200);
    }
}
