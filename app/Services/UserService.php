<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{

    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $users = $this->userRepository->listar();

        return response()->json([
            'status'    => true,
            'message'   => 'Registros recuperados existosamente',
            'data'      => $users
        ], 200);
    }

    public function store($request)
    {
        $validator = Validator::make($request->all(), 
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

        if($validator->fails()){
            return response()->json([
                'status'    => false,
                'message'   => 'Error en validaciones',
                'errors'    => $validator->errors()
            ], 200);
        }

        $user = $this->userRepository->guardar($request);

        return response()->json([
            'status'    => true,
            'message'   => 'Registro guardado exitosamente',
            'data'      => $user
        ], 201);
    }

    public function show($id)
    {
        $user = $this->userRepository->obtener($id);

        if(is_null($user)){
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

    public function update($request, $id)
    {
        $validator = Validator::make($request->all(), 
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

        if($validator->fails()){
            return response()->json([
                'status'    => false,
                'message'   => 'Error en validaciones',
                'errors'    => $validator->errors()
            ], 200);
        }

        $user = $this->userRepository->obtener($id);

        if(is_null($user)){
            return response()->json([
                'status'    => false,
                'message'   => 'Registro no encontrado'
            ], 200);
        }

        $user = $this->userRepository->editar($request, $id);

        return response()->json([
            'status'    => true,
            'message'   => 'Registro modificado exitosamente',
            'data'      => $user
        ], 200);
    }

    public function destroy($id)
    {
        $user = $this->userRepository->obtener($id);

        if(is_null($user)){
            return response()->json([
                'status'    => false,
                'message'   => 'Registro no encontrado'
            ], 200);
        }

        $user = $this->userRepository->eliminar($id);

        return response()->json([
            'status'    => true,
            'message'   => 'Registro eliminado exitosamente',
            'data'      => $user
        ], 200);
    }

    public function storePortal($request)
    {
        $validator = Validator::make($request->all(), 
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
                'password'          => 'required'
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
                'password.required'         => 'El campo Contraseña es requerido'
            ]
        );

        if($validator->fails()){
            return response()->json([
                'status'    => false,
                'message'   => 'Complete los campos correctamente',
                'errors'    => $validator->errors()
            ], 200);
        }

        $user = $this->userRepository->guardarUserPortal($request);

        return response()->json([
            'status'    => true,
            'message'   => 'Se ha registrado con éxito',
            'data'      => $user
        ], 201);
    }

    public function obtenerEstudianteCi($ci)
    {
        $user = $this->userRepository->obtenerEstudianteCi($ci);

        if(is_null($user)){
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

    public function resetPassword($request, $id)
    {
        $user = $this->userRepository->obtener($id);

        if(is_null($user)){
            return response()->json([
                'status'    => false,
                'message'   => 'Registro no encontrado'
            ], 200);
        }

        $user = $this->userRepository->resetPassword($request, $id);

        return response()->json([
            'status'    => true,
            'message'   => 'Contraseña reseteado exitosamente',
            'data'      => $user
        ], 200);
    }

    public function cambiarPassword($request, $id)
    {
        $validator = Validator::make($request->all(), 
            [
                'antiguo_password'  => 'required',
                'nuevo_password'    => 'required'
            ],
            [
                'antiguo_password.required' => 'El campo Antigua Contraseña es requerido',
                'nuevo_password.required'   => 'El campo Nueva Contraseña es requerido'
            ]
        );

        if($validator->fails()){
            return response()->json([
                'status'    => false,
                'message'   => 'Complete los campos correctamente',
                'errors'    => $validator->errors()
            ], 200);
        }

        $user = $this->userRepository->obtener($id);

        if(is_null($user)){
            return response()->json([
                'status'    => false,
                'message'   => 'Registro no encontrado'
            ], 200);
        }

        //validacion las credenciales
        if (!Hash::check( $request->antiguo_password, $user->password )) {
            return response()->json([
                'status'    => false,
                'message'   => 'La antigua contraseña no coincide',
            ], 200);
        }

        $user = $this->userRepository->cambiarPassword($request, $id);

        return response()->json([
            'status'    => true,
            'message'   => 'Contraseña cambiado exitosamente',
            'data'      => $user
        ], 200);
    }

    public function indexDocentes()
    {
        $users = $this->userRepository->listarDocentes();

        return response()->json([
            'status'    => true,
            'message'   => 'Registros recuperados existosamente',
            'data'      => $users
        ], 200);
    }

}