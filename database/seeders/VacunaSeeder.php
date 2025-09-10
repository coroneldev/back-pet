<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VacunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('vacunas')->insert([
            [
                'nombre' => 'RABICA',
                'descripcion' => 'Vacuna contra la rabia',
                'numero_dosis_requeridas' => 1,
                'intervalo_dosis' => 365, // refuerzo anual
                'especie_destinada' => 'PERRO',
                'estado' => true,
                'veterinario_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'OCTAVALENTE',
                'descripcion' => 'Protege contra 8 enfermedades virales y bacterianas',
                'numero_dosis_requeridas' => 3,
                'intervalo_dosis' => 21, // cada 21 días entre dosis
                'especie_destinada' => 'PERRO',
                'estado' => true,
                'veterinario_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'QUINTUPLE',
                'descripcion' => 'Protege contra 5 enfermedades principales',
                'numero_dosis_requeridas' => 3,
                'intervalo_dosis' => 21,
                'especie_destinada' => 'PERRO',
                'estado' => true,
                'veterinario_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'HEPATITIS',
                'descripcion' => 'Protección contra la hepatitis infecciosa canina',
                'numero_dosis_requeridas' => 2,
                'intervalo_dosis' => 365,
                'especie_destinada' => 'PERRO',
                'estado' => true,
                'veterinario_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'LEPTOSPIROSIS',
                'descripcion' => 'Prevención de leptospirosis canina',
                'numero_dosis_requeridas' => 2,
                'intervalo_dosis' => 365,
                'especie_destinada' => 'PERRO',
                'estado' => true,
                'veterinario_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
