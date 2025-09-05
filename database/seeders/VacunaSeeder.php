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
            'vacuna'        => 'RABICA',
            'fecha'         => '2025-08-01',
            'prox_fecha'    => '2025-08-31',
            'mascota_id'    => 1,
            'veterinario_id' => 2
        ]);

        DB::table('vacunas')->insert([
            'vacuna'        => 'OCTAVALENTE',
            'fecha'         => '2025-08-03',
            'prox_fecha'    => '2025-08-11',
            'mascota_id'    => 2,
            'veterinario_id' => 2
        ]);

        DB::table('vacunas')->insert([
            'vacuna'        => 'QUINTUPLE',
            'fecha'         => '2025-08-05',
            'prox_fecha'    => '2025-09-05',
            'mascota_id'    => 3,
            'veterinario_id' => 2
        ]);

        DB::table('vacunas')->insert([
            'vacuna'        => 'HEPATITIS',
            'fecha'         => '2025-08-07',
            'prox_fecha'    => '2025-08-31',
            'mascota_id'    => 4,
            'veterinario_id' => 2
        ]);

        DB::table('vacunas')->insert([
            'vacuna'        => 'LEPTOSPIROSIS',
            'fecha'         => '2025-08-09',
            'prox_fecha'    => '2025-09-09',
            'mascota_id'    => 5,
            'veterinario_id' => 2
        ]);

        DB::table('vacunas')->insert([
            'vacuna'        => 'RABICA',
            'fecha'         => '2025-08-10',
            'prox_fecha'    => '2025-09-10',
            'mascota_id'    => 6,
            'veterinario_id' => 2
        ]);

        DB::table('vacunas')->insert([
            'vacuna'        => 'OCTAVALENTE',
            'fecha'         => '2025-08-12',
            'prox_fecha'    => '2025-08-20',
            'mascota_id'    => 7,
            'veterinario_id' => 2
        ]);

        DB::table('vacunas')->insert([
            'vacuna'        => 'QUINTUPLE',
            'fecha'         => '2025-08-14',
            'prox_fecha'    => '2025-09-14',
            'mascota_id'    => 8,
            'veterinario_id' => 2
        ]);

        DB::table('vacunas')->insert([
            'vacuna'        => 'HEPATITIS',
            'fecha'         => '2025-08-16',
            'prox_fecha'    => '2025-09-16',
            'mascota_id'    => 9,
            'veterinario_id' => 2
        ]);

        DB::table('vacunas')->insert([
            'vacuna'        => 'LEPTOSPIROSIS',
            'fecha'         => '2025-08-18',
            'prox_fecha'    => '2025-09-18',
            'mascota_id'    => 10,
            'veterinario_id' => 2
        ]);
    }
}
