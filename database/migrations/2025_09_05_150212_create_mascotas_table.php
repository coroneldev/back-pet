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
        Schema::create('mascotas', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->string('nombre');
            $table->integer('edad')->nullable();
            $table->decimal('peso', 8, 2)->nullable(); 
            $table->string('foto')->nullable(); 
            $table->string('especie');
            $table->string('raza')->nullable();
            $table->enum('sexo', ['MACHO', 'HEMBRA'])->nullable();
            $table->text('detalles')->nullable();
            $table->foreignId('cliente_id')
                ->constrained('clientes')
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
        Schema::dropIfExists('mascotas');
    }
};
