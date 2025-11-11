<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migración: Tabla lecciones
 * 
 * Descripción funcional:
 * Almacena las lecciones individuales que componen cada curso. Cada lección
 * tiene su propio estado de progreso y puede incluir observaciones sobre
 * el desempeño del estudiante o notas del instructor. Las lecciones pueden
 * estar bloqueadas hasta que se completen requisitos previos.
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lecciones', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('id_curso')->constrained('cursos', 'id')->onDelete('cascade');
            $table->text('nombre_leccion');
            $table->text('descripcion');
            $table->enum('estado_leccion', ['no_iniciada', 'en_progreso', 'completada', 'bloqueada'])->default('no_iniciada');
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lecciones');
    }
};
