<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migración: Tabla rentas_trailer
 * 
 * Descripción funcional:
 * Registra todas las rentas de tráileres realizadas por los usuarios.
 * Controla las fechas de renta, devolución estimada y real, permitiendo
 * identificar rentas activas, devueltas o atrasadas. Esta información es
 * crucial para la gestión de la flota y el cobro de penalizaciones por retraso.
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rentas_trailer', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('id_trailer')->constrained('trailers', 'id')->onDelete('cascade');
            $table->foreignUuid('id_contratacion')->constrained('contrataciones', 'id')->onDelete('cascade');
            $table->timestamp('fecha_renta');
            $table->timestamp('fecha_devolucion_estimada');
            $table->timestamp('fecha_devolucion_real')->nullable();
            $table->enum('estado_renta', ['activa', 'devuelta', 'atrasada'])->default('activa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentas_trailer');
    }
};
