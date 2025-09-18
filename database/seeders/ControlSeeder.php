<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ControlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('controles')->insert([
            [
                'fecha_aplicacion'   => $now,
                'proxima_aplicacion' => $now->copy()->addDays(365),
                'observaciones'      => 'PRIMERA DOSIS DE VACUNA ANTIRRÁBICA',
                'vacuna_id'          => 1,
                'user_id'            => 2, // veterinario
                'cliente_id'         => 1,
                'mascota_id'         => 1,
                'created_at'         => $now,
                'updated_at'         => $now,
            ],
            [
                'fecha_aplicacion'   => $now,
                'proxima_aplicacion' => $now->copy()->addDays(365),
                'observaciones'      => 'CHEQUEO GENERAL ANUAL',
                'vacuna_id'          => 2,
                'user_id'            => 2,
                'cliente_id'         => 2,
                'mascota_id'         => 2,
                'created_at'         => $now,
                'updated_at'         => $now,
            ],
            [
                'fecha_aplicacion'   => $now,
                'proxima_aplicacion' => $now->copy()->addDays(30),
                'observaciones'      => 'SEGUNDA DOSIS DE DESPARASITACIÓN',
                'vacuna_id'          => 1,
                'user_id'            => 2,
                'cliente_id'         => 3,
                'mascota_id'         => 3,
                'created_at'         => $now,
                'updated_at'         => $now,
            ],
            [
                'fecha_aplicacion'   => $now,
                'proxima_aplicacion' => $now->copy()->addDays(365),
                'observaciones'      => 'PRIMERA DOSIS DE VACUNA TRIPLE FELINA',
                'vacuna_id'          => 2,
                'user_id'            => 2,
                'cliente_id'         => 4,
                'mascota_id'         => 4,
                'created_at'         => $now,
                'updated_at'         => $now,
            ],
            [
                'fecha_aplicacion'   => $now,
                'proxima_aplicacion' => $now->copy()->addDays(180),
                'observaciones'      => 'VACUNACIÓN CONTRA PARVOVIRUS PARA CACHORROS',
                'vacuna_id'          => 3,
                'user_id'            => 2,
                'cliente_id'         => 1,
                'mascota_id'         => 1,
                'created_at'         => $now,
                'updated_at'         => $now,
            ],
            [
                'fecha_aplicacion'   => $now,
                'proxima_aplicacion' => $now->copy()->addDays(30),
                'observaciones'      => 'CONTROL DE PESO Y NUTRICIÓN MENSUAL',
                'vacuna_id'          => 1, // si no es vacuna específica
                'user_id'            => 2,
                'cliente_id'         => 2,
                'mascota_id'         => 2,
                'created_at'         => $now,
                'updated_at'         => $now,
            ],
        ]);
    }
}
