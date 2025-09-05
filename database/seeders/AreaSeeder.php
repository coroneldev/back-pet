<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('areas')->insert([
            'nombre'        => 'INFORMÁTICA',
            'descripcion'   => 'Informática'
        ]);
        DB::table('areas')->insert([
            'nombre'        => 'ROBÓTICA',
            'descripcion'   => 'Robotica'
        ]);
        DB::table('areas')->insert([
            'nombre'        => 'IDIOMAS',
            'descripcion'   => 'Idiomas'
        ]);
    }
}
