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
            $table->string('titulo');
            $table->text('descripcion');
            $table->string('imagen')->nullable();
            $table->string('categoria');
            $table->enum('nivel', ['basico', 'intermedio', 'avanzado']);
            $table->integer('duracion_horas');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->integer('cupo_maximo');
            $table->enum('estado', ['borrador', 'publicado', 'finalizado'])->default('borrador');
            $table->json('objetivos')->nullable();
            $table->json('requisitos')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->boolean('aprobado')->default(false);
            $table->timestamps();
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
