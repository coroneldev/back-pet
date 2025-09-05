<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('clientes')->insert([
            'nombre'    => 'JUAN PEREZ',
            'email'     => 'JUAN.PEREZ@MAIL.COM',
            'documento' => 'DOC-1001',
            'telefono'  => '70000001',
            'direccion' => 'AVENIDA AMÉRICA #123'
        ]);

        DB::table('clientes')->insert([
            'nombre'    => 'MARIA LOPEZ',
            'email'     => 'MARIA.LOPEZ@MAIL.COM',
            'documento' => 'DOC-1002',
            'telefono'  => '70000002',
            'direccion' => 'CALLE BOLÍVAR #456'
        ]);

        DB::table('clientes')->insert([
            'nombre'    => 'CARLOS GUTIERREZ',
            'email'     => 'CARLOS.GUTIERREZ@MAIL.COM',
            'documento' => 'DOC-1003',
            'telefono'  => '70000003',
            'direccion' => 'BARRIO CENTRAL ZONA SUR'
        ]);

        DB::table('clientes')->insert([
            'nombre'    => 'ANA FERNANDEZ',
            'email'     => 'ANA.FERNANDEZ@MAIL.COM',
            'documento' => 'DOC-1004',
            'telefono'  => '70000004',
            'direccion' => 'URBANIZACIÓN EL CARMEN'
        ]);

        DB::table('clientes')->insert([
            'nombre'    => 'PEDRO RAMIREZ',
            'email'     => 'PEDRO.RAMIREZ@MAIL.COM',
            'documento' => 'DOC-1005',
            'telefono'  => '70000005',
            'direccion' => 'AV. SANTA CRUZ KM 5'
        ]);
    }
}
