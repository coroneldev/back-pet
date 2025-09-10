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
        Schema::create('mascota_vacuna', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mascota_id')
                ->constrained('mascotas')
                ->onDelete('cascade');
            $table->foreignId('vacuna_id')
                ->constrained('vacunas')
                ->onDelete('cascade');
            $table->date('fecha_aplicacion'); // Fecha de la aplicación
            $table->date('proxima_aplicacion')->nullable(); // Refuerzo
            $table->text('observaciones')->nullable();
            $table->string('veterinario')->nullable(); // Opcional
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mascota_vacuna');
    }
};
