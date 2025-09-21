<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CitaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('citas')->insert([
            [
                'mascota_id'         => 1,
                'cliente_id'         => 1,
                'fecha'              => $now->addDays(1)->format('Y-m-d'),
                'hora_inicio'        => '10:00:00',
                'hora_fin'           => '10:30:00',
                'motivo'             => 'VACUNACIÓN ANTIRRÁBICA',
                'estado'             => 'PENDIENTE',
                'created_at'         => $now,
                'updated_at'         => $now,

            ],
            [
                'mascota_id'         => 2,
                'cliente_id'         => 2,
                'fecha'              => $now->addDays(2)->format('Y-m-d'),
                'hora_inicio'        => '11:00:00',
                'hora_fin'           => '11:30:00',
                'motivo'             => 'CHEQUEO GENERAL',
                'estado'             => 'PENDIENTE',
                'created_at'         => $now,
                'updated_at'         => $now,

            ],
            [
                'mascota_id'         => 3,
                'cliente_id'         => 3,
                'fecha'              => $now->addDays(3)->format('Y-m-d'),
                'hora_inicio'        => '09:30:00',
                'hora_fin'           => '10:00:00',
                'motivo'             => 'VACUNACIÓN MÚLTIPLE',
                'estado'             => 'CONFIRMADA',
                'created_at'         => $now,
                'updated_at'         => $now,

            ],
            [
                'mascota_id'         => 4,
                'cliente_id'         => 4,
                'fecha'              => $now->addDays(4)->format('Y-m-d'),
                'hora_inicio'        => '14:00:00',
                'hora_fin'           => '14:30:00',
                'motivo'             => 'DESPARASITACIÓN',
                'estado'             => 'CANCELADA',
                'created_at'         => $now,
                'updated_at'         => $now,

            ],
        ]);
    }
}
