<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migración: Tabla cursos
 * 
 * Descripción funcional:
 * Gestiona los cursos completos contratados por los usuarios. Cada curso
 * está vinculado a una contratación específica y permite hacer seguimiento
 * del avance del estudiante mediante el porcentaje de completitud. Los cursos
 * están compuestos por múltiples lecciones que se gestionan en otra tabla.
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('id_contratacion')->constrained('contrataciones', 'id')->onDelete('cascade');
            $table->text('nombre_curso');
            $table->text('descripcion');
            $table->decimal('avance_porcentaje', 5, 2)->default(0.00);
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
