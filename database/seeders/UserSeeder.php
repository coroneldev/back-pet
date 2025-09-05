<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'apellido_paterno'  => 'ADMINISTRADOR',
            'apellido_materno'  => 'ADMINISTRADOR',
            'nombres'           => 'ADMINISTRADOR',
            'cedula_identidad'  => '111111',
            'expedicion_ci'     => 'LP',
            'fecha_nacimiento'  => '2000-01-01',
            'sexo'              => 'MASCULINO',
            'celular'           => '77777777',
            'email'             => 'admin@example.com',
            'password'          => bcrypt('admin@example.com'),
            'estado'            => 'ACTIVO',
            'rol_id'            => 1
        ]);
        DB::table('users')->insert([
            'apellido_paterno'  => 'ERICK',
            'apellido_materno'  => 'ERICK',
            'nombres'           => 'ERICK',
            'cedula_identidad'  => '123456',
            'expedicion_ci'     => 'LP',
            'fecha_nacimiento'  => '2000-01-01',
            'sexo'              => 'MASCULINO',
            'celular'           => '7777777',
            'email'             => 'erick@example.com',
            'password'          => bcrypt('erick@example.com'),
            'estado'            => 'ACTIVO',
            'rol_id'            => 2
        ]);

    }
}
