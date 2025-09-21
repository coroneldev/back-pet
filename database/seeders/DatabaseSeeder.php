<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ClienteSeeder::class);
        $this->call(MascotaSeeder::class);
        $this->call(VacunaSeeder::class);
        $this->call(ControlSeeder::class);
        $this->call(CitaSeeder::class);
    }
}
