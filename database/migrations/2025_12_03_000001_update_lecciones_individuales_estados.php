<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

/**
 * Migración: Actualizar estados de lecciones_individuales
 * 
 * Descripción funcional:
 * Cambia los estados de lecciones individuales para que coincidan con los
 * estados de avance_leccion (pendiente, en_progreso, vista, pagada).
 * Esto unifica la lógica de estados entre cursos y lecciones individuales.
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Primero eliminamos la restricción existente
        DB::statement("ALTER TABLE lecciones_individuales DROP CONSTRAINT IF EXISTS lecciones_individuales_estado_leccion_check");
        
        // Actualizamos los valores existentes al nuevo formato
        DB::statement("UPDATE lecciones_individuales SET estado_leccion = 'pendiente' WHERE estado_leccion = 'no_iniciada'");
        DB::statement("UPDATE lecciones_individuales SET estado_leccion = 'vista' WHERE estado_leccion = 'completada'");
        DB::statement("UPDATE lecciones_individuales SET estado_leccion = 'pendiente' WHERE estado_leccion = 'bloqueada'");
        
        // Ahora agregamos la nueva restricción
        DB::statement("ALTER TABLE lecciones_individuales ADD CONSTRAINT lecciones_individuales_estado_leccion_check CHECK (estado_leccion IN ('pendiente', 'en_progreso', 'vista', 'pagada'))");
        
        // Actualizar el valor por defecto
        DB::statement("ALTER TABLE lecciones_individuales ALTER COLUMN estado_leccion SET DEFAULT 'pendiente'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revertir los valores al formato anterior
        DB::statement("UPDATE lecciones_individuales SET estado_leccion = 'no_iniciada' WHERE estado_leccion = 'pendiente'");
        DB::statement("UPDATE lecciones_individuales SET estado_leccion = 'completada' WHERE estado_leccion = 'vista'");
        DB::statement("UPDATE lecciones_individuales SET estado_leccion = 'completada' WHERE estado_leccion = 'pagada'");
        
        // Restaurar la restricción original
        DB::statement("ALTER TABLE lecciones_individuales DROP CONSTRAINT IF EXISTS lecciones_individuales_estado_leccion_check");
        DB::statement("ALTER TABLE lecciones_individuales ADD CONSTRAINT lecciones_individuales_estado_leccion_check CHECK (estado_leccion IN ('no_iniciada', 'en_progreso', 'completada', 'bloqueada'))");
        
        // Restaurar el valor por defecto
        DB::statement("ALTER TABLE lecciones_individuales ALTER COLUMN estado_leccion SET DEFAULT 'no_iniciada'");
    }
};
