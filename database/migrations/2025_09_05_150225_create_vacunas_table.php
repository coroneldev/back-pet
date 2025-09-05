<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vacunas', function (Blueprint $table) {
            $table->id();

            $table->string('vacuna');               // nombre de la vacuna
            $table->date('fecha');                  // fecha de aplicación
            $table->date('prox_fecha')->nullable(); // próxima dosis

            // Relación con mascota
            $table->foreignId('mascota_id')
                ->constrained('mascotas')
                ->onDelete('cascade');

            // Relación con veterinario (usuario con rol veterinario)
            $table->foreignId('veterinario_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacunas');
    }
};
