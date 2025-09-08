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
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100)->nullable();
            $table->text('detalle')->nullable();
            $table->string('horario', 100)->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->time('hora_inicio')->nullable();
            $table->time('hora_fin')->nullable();
            $table->date('fecha_limite')->nullable();
            $table->decimal('costo', 18, 2)->nullable();
            $table->string('modalidad', 20)->nullable();
            $table->string('imagen', 255)->nullable();
            $table->string('documento', 255)->nullable();
            $table->string('estado', 20)->nullable();

            $table->integer('user_creador_id')->nullable();
            $table->integer('user_modificador_id')->nullable();
            $table->integer('user_eliminador_id')->nullable();
            $table->timestamp('fecha_creacion')->nullable();
            $table->timestamp('fecha_modificacion')->nullable();
            $table->timestamp('fecha_eliminacion')->nullable();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cursos');
    }
};
