<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migración: Tabla lecciones_individuales
 * 
 * Descripción funcional:
 * Gestiona las lecciones contratadas de forma individual (no como parte de un curso).
 * Permite programar lecciones específicas con fecha y hora, hacer seguimiento de su
 * estado y agregar observaciones sobre el desempeño del estudiante durante la clase.
 * Ideal para estudiantes que prefieren lecciones personalizadas.
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lecciones_individuales', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('id_contratacion')->constrained('contrataciones', 'id')->onDelete('cascade');
            $table->timestamp('fecha_programada');
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
        Schema::dropIfExists('lecciones_individuales');
    }
};
