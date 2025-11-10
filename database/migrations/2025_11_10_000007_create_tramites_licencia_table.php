<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migración: Tabla tramites_licencia
 * 
 * Descripción funcional:
 * Registra y da seguimiento a los trámites de obtención de licencia de conducir
 * que los usuarios gestionan a través de la escuela. Permite controlar el tipo
 * de licencia solicitada (A, B, C, D, E) y el estado del trámite desde que
 * inicia hasta su completación o cancelación.
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tramites_licencia', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('id_contratacion')->constrained('contrataciones', 'id')->onDelete('cascade');
            $table->enum('tipo_licencia', ['A', 'B', 'C', 'D', 'E']);
            $table->enum('estado_tramite', ['proceso', 'completado', 'cancelado'])->default('proceso');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tramites_licencia');
    }
};
