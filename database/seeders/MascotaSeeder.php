<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MascotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('mascotas')->insert([
            'codigo'      => 'MASC-0001',
            'nombre'      => 'LOBO',
            'edad'        => 4,
            'peso'        => 18.0,
            'foto'        => 'Clientes/JUAN PEREZ-1001/LOBO/lo_bo.jpg',
            'especie'     => 'PERRO',
            'raza'        => 'PASTOR ALEMÁN',
            'sexo'        => 'MACHO',
            'detalles'    => 'GUARDIÁN FIEL DE LA FAMILIA',
            'cliente_id'  => 1
        ]);

        DB::table('mascotas')->insert([
            'codigo'      => 'MASC-0002',
            'nombre'      => 'BAYERN',
            'edad'        => 2,
            'peso'        => 12.0,
            'foto'        => 'Clientes/MARIA LOPEZ-1002/BAYERN/bayern.jpg',
            'especie'     => 'PERRO',
            'raza'        => 'ROTTWEILER',
            'sexo'        => 'HEMBRA',
            'detalles'    => 'ENTRENADA PARA DEFENSA',
            'cliente_id'  => 2
        ]);

        DB::table('mascotas')->insert([
            'codigo'      => 'MASC-0003',
            'nombre'      => 'FIRULAIS',
            'edad'        => 3,
            'peso'        => 9.0,
            'foto'        => 'Clientes/CARLOS GUTIERREZ-1003/FIRULAIS/firulais.jpg',
            'especie'     => 'PERRO',
            'raza'        => 'BOXER',
            'sexo'        => 'MACHO',
            'detalles'    => 'ENERGÉTICO Y JUGUETÓN',
            'cliente_id'  => 3
        ]);

        DB::table('mascotas')->insert([
            'codigo'      => 'MASC-0004',
            'nombre'      => 'SASHA',
            'edad'        => 1,
            'peso'        => 3.0,
            'foto'        => 'Clientes/ANA FERNANDEZ-1004/SASHA/sasha.jpg',
            'especie'     => 'GATO',
            'raza'        => 'PERSA',
            'sexo'        => 'HEMBRA',
            'detalles'    => 'AMA DORMIR SOBRE LA COMPUTADORA',
            'cliente_id'  => 4
        ]);

        DB::table('mascotas')->insert([
            'codigo'      => 'MASC-0005',
            'nombre'      => 'TIGRE',
            'edad'        => 5,
            'peso'        => 20.0,
            'foto'        => 'Clientes/PEDRO RAMIREZ-1005/TIGRE/tigre.jpg',
            'especie'     => 'PERRO',
            'raza'        => 'GRAN DANÉS',
            'sexo'        => 'MACHO',
            'detalles'    => 'SILENCIOSO, PERO IMPONENTE',
            'cliente_id'  => 5
        ]);

        DB::table('mascotas')->insert([
            'codigo'      => 'MASC-0006',
            'nombre'      => 'ROCKY',
            'edad'        => 2,
            'peso'        => 15.5,
            'foto'        => 'Clientes/JUAN PEREZ-1001/ROCKY/rocky.jpg',
            'especie'     => 'PERRO',
            'raza'        => 'LABRADOR',
            'sexo'        => 'MACHO',
            'detalles'    => 'VACUNADO Y DEPARACITADO',
            'cliente_id'  => 1
        ]);

        DB::table('mascotas')->insert([
            'codigo'      => 'MASC-0007',
            'nombre'      => 'LUNA',
            'edad'        => 3,
            'peso'        => 8.0,
            'foto'        => 'Clientes/MARIA LOPEZ-1002/LUNA/luna.jpg',
            'especie'     => 'GATO',
            'raza'        => 'SIAMES',
            'sexo'        => 'HEMBRA',
            'detalles'    => 'MUY JUGUETONA',
            'cliente_id'  => 2
        ]);

        DB::table('mascotas')->insert([
            'codigo'      => 'MASC-0008',
            'nombre'      => 'MAX',
            'edad'        => 4,
            'peso'        => 22.0,
            'foto'        => 'Clientes/CARLOS GUTIERREZ-1003/MAX/max.jpg',
            'especie'     => 'PERRO',
            'raza'        => 'BULLDOG',
            'sexo'        => 'MACHO',
            'detalles'    => 'FUERTE Y VALIENTE',
            'cliente_id'  => 3
        ]);

        DB::table('mascotas')->insert([
            'codigo'      => 'MASC-0009',
            'nombre'      => 'BELLA',
            'edad'        => 1,
            'peso'        => 2.5,
            'foto'        => 'Clientes/ANA FERNANDEZ-1004/BELLA/bella.jpg',
            'especie'     => 'GATO',
            'raza'        => 'MAINE COON',
            'sexo'        => 'HEMBRA',
            'detalles'    => 'DULCE Y CARIÑOSA',
            'cliente_id'  => 4
        ]);

        DB::table('mascotas')->insert([
            'codigo'      => 'MASC-0010',
            'nombre'      => 'ZEUS',
            'edad'        => 6,
            'peso'        => 25.0,
            'foto'        => 'Clientes/PEDRO RAMIREZ-1005/ZEUS/zeus.jpg',
            'especie'     => 'PERRO',
            'raza'        => 'DOBERMAN',
            'sexo'        => 'MACHO',
            'detalles'    => 'PROTECTOR DE LA FAMILIA',
            'cliente_id'  => 5
        ]);
    }
}
