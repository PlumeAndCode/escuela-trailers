<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migración: Tabla trailers
 * 
 * Descripción funcional:
 * Gestiona el inventario completo de tráileres disponibles en la escuela.
 * Cada tráiler tiene información única como modelo, número de serie y placa.
 * El estado del tráiler indica si está disponible para renta, actualmente
 * rentado o en mantenimiento, permitiendo un control eficiente de la flota.
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('trailers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('modelo');
            $table->text('numero_serie')->unique();
            $table->text('placa')->unique();
            $table->enum('estado_trailer', ['disponible', 'rentado', 'mantenimiento'])->default('disponible');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trailers');
    }
};
