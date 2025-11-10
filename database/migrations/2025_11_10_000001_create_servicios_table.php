<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migración: Tabla servicios
 * 
 * Descripción funcional:
 * Contiene el catálogo completo de servicios que la escuela de manejo de tráileres 
 * ofrece a sus usuarios. Incluye cursos completos, lecciones individuales, 
 * trámites de licencia y renta de tráileres. Cada servicio tiene su precio 
 * y puede activarse/desactivarse según la disponibilidad de la escuela.
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('servicios', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('nombre_servicio');
            $table->enum('tipo_servicio', ['curso', 'leccion', 'licencia', 'renta_trailer']);
            $table->text('descripcion');
            $table->decimal('precio', 10, 2);
            $table->boolean('estado_servicio')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicios');
    }
};
