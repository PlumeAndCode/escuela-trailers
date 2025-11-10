<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migración: Tabla pagos
 * 
 * Descripción funcional:
 * Registra todos los pagos realizados por los usuarios asociados a sus
 * contrataciones de servicios. Permite controlar el método de pago utilizado,
 * el monto pagado y el estado del pago (pendiente, pagado o vencido).
 * Es esencial para la gestión financiera y seguimiento de cuentas por cobrar.
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('id_contratacion')->constrained('contrataciones', 'id')->onDelete('cascade');
            $table->timestamp('fecha_pago');
            $table->decimal('monto_pagado', 10, 2);
            $table->enum('tipo_pago', ['efectivo', 'tarjeta', 'linea']);
            $table->enum('estado_pago', ['pendiente', 'pagado', 'vencido'])->default('pendiente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
