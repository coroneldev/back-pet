<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MascotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('mascotas')->insert([
            [
                'codigo'      => 'MASC-0001',
                'nombre'      => 'LOBO',
                'edad'        => 4,
                'peso'        => 18.0,
                'foto'        => 'Clientes/JUAN PEREZ-1001/LOBO/lo_bo.jpg',
                'especie'     => 'PERRO',
                'raza'        => 'PASTOR ALEMÁN',
                'sexo'        => 'MACHO',
                'detalles'    => 'GUARDIÁN FIEL DE LA FAMILIA',
                'cliente_id'  => 1,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'codigo'      => 'MASC-0002',
                'nombre'      => 'BAYERN',
                'edad'        => 2,
                'peso'        => 12.0,
                'foto'        => 'Clientes/MARIA LOPEZ-1002/BAYERN/bayern.jpg',
                'especie'     => 'PERRO',
                'raza'        => 'ROTTWEILER',
                'sexo'        => 'HEMBRA',
                'detalles'    => 'ENTRENADA PARA DEFENSA',
                'cliente_id'  => 2,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'codigo'      => 'MASC-0003',
                'nombre'      => 'FIRULAIS',
                'edad'        => 3,
                'peso'        => 9.0,
                'foto'        => 'Clientes/CARLOS GUTIERREZ-1003/FIRULAIS/firulais.jpg',
                'especie'     => 'PERRO',
                'raza'        => 'BOXER',
                'sexo'        => 'MACHO',
                'detalles'    => 'ENERGÉTICO Y JUGUETÓN',
                'cliente_id'  => 3,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'codigo'      => 'MASC-0004',
                'nombre'      => 'SASHA',
                'edad'        => 1,
                'peso'        => 3.0,
                'foto'        => 'Clientes/ANA FERNANDEZ-1004/SASHA/sasha.jpg',
                'especie'     => 'GATO',
                'raza'        => 'PERSA',
                'sexo'        => 'HEMBRA',
                'detalles'    => 'AMA DORMIR SOBRE LA COMPUTADORA',
                'cliente_id'  => 4,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],


        ]);
    }
}
