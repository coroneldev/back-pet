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
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->integer('numero_dosis_requeridas')->default(1);
            $table->integer('intervalo_dosis')->nullable(); // Intervalo en días entre dosis
            $table->string('especie_destinada');
            $table->boolean('estado')->default(true);
            $table->foreignId('veterinario_id') // veterinario responsable
                ->nullable()
                ->constrained('users') // suponiendo que veterinarios están en la tabla users
                ->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();
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
