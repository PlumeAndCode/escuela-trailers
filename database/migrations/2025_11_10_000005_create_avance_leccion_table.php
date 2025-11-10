<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migración: Tabla avance_leccion
 * 
 * Descripción funcional:
 * Controla el progreso específico de cada usuario en cada lección de un curso.
 * Permite rastrear si la lección ha sido vista, si está pendiente de pago
 * o si ya fue pagada. Esta tabla vincula las lecciones con las contrataciones
 * para gestionar el avance individual de cada estudiante.
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('avance_leccion', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('id_leccion')->constrained('lecciones', 'id')->onDelete('cascade');
            $table->foreignUuid('id_contratacion')->constrained('contrataciones', 'id')->onDelete('cascade');
            $table->enum('estado_avance', ['pendiente', 'vista', 'pagada'])->default('pendiente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avance_leccion');
    }
};
