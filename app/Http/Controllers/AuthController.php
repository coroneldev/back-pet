<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Rol;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email'     => 'required',
                'password'  => 'required'
            ],
            [
                'email.required'    => 'El campo Correo Electrónico es requerido',
                'password.required' => 'El campo Contraseña es requerido'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status'    => false,
                'message'   => 'Complete los campos correctamente',
                'errors'    => $validator->errors()
            ], 401);
        }

        //validacion las credenciales
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return response()->json([
                'status'    => false,
                'message'   => 'Credenciales incorrectos',
            ], 401);
        }

        //validacion de usuario inhabilitado
        $usuario = User::where('email', $request->email)->first();
        if ($usuario->estado == 'INACTIVO') {
            return response()->json([
                'status'    => false,
                'message'   => 'Usuario Inhabilitado'
            ], 401);
        }

        $usuario = User::where('email', $request->email)->first();
        $rol = Rol::where('id', $usuario->rol_id)->first();
        $token = $usuario->createToken("auth_token")->plainTextToken;

        return response()->json([
            'status'    => true,
            'message'   => 'Credenciales correctos',
            'data'      => [
                'usuario'   => base64_encode($usuario),
                'rol'       => base64_encode($rol),
                'token'     => $token
            ]
        ], 200);
    }

    public function logout($request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status'    => true,
            'message'   => 'Sesión cerrado exitosamente',
            'data'      => $request->user()
        ], 200);
    }
}
