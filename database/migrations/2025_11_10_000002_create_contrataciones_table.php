<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migración: Tabla contrataciones
 * 
 * Descripción funcional:
 * Registra todas las contrataciones de servicios realizadas por los usuarios.
 * Esta tabla actúa como punto central que conecta a los usuarios con los 
 * servicios que han adquirido, permitiendo hacer seguimiento del estado 
 * de cada contratación desde que está pendiente hasta que se finaliza.
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contrataciones', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('id_usuario')->constrained('users', 'id')->onDelete('cascade');
            $table->foreignUuid('id_servicio')->constrained('servicios', 'id')->onDelete('cascade');
            $table->timestamp('fecha_contratacion');
            $table->enum('estado_contratacion', ['pendiente', 'activo', 'finalizado']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contrataciones');
    }
};
