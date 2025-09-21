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
        Schema::create('citas', function (Blueprint $table) {
            $table->id();

            // Relación con mascota
            $table->foreignId('mascota_id')->constrained('mascotas')->onDelete('cascade');

            // Relación con cliente (opcional, útil para búsquedas rápidas)
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');

            $table->date('fecha');                 // Fecha de la cita
            $table->time('hora_inicio');           // Hora de inicio
            $table->time('hora_fin')->nullable();  // Hora fin opcional
            $table->string('motivo', 255)->nullable();  // Motivo de la cita
            $table->enum('estado', ['PENDIENTE', 'CONFIRMADA', 'REALIZADA', 'CANCELADA'])
                ->default('PENDIENTE');         // Estado de la cita

            $table->softDeletes();
            $table->timestamps();                  // created_at y updated_a

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
