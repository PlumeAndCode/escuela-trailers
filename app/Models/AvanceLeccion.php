<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Modelo: AvanceLeccion
 * 
 * Descripción funcional:
 * Controla el progreso específico de cada usuario en cada lección de un curso.
 * Permite rastrear si la lección ha sido vista, si está pendiente de pago
 * o si ya fue pagada. Esta tabla vincula las lecciones con las contrataciones.
 */
class AvanceLeccion extends Model
{
    use HasFactory, HasUuids;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'avance_leccion';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_leccion',
        'id_contratacion',
        'estado_avance',
    ];

    /**
     * Boot del modelo - registrar eventos
     */
    protected static function booted(): void
    {
        // Cuando se actualiza un avance, verificar si el curso está completo
        static::updated(function (AvanceLeccion $avance) {
            $avance->verificarCursoCompleto();
        });

        // También verificar cuando se crea un nuevo avance
        static::created(function (AvanceLeccion $avance) {
            $avance->verificarCursoCompleto();
        });
    }

    /**
     * Verificar si el curso está 100% completado y marcar contratación como finalizada
     */
    public function verificarCursoCompleto(): void
    {
        $contratacion = $this->contratacion;
        
        if (!$contratacion || $contratacion->estado_contratacion === 'finalizado') {
            return;
        }

        $curso = $contratacion->curso;
        
        if (!$curso) {
            return;
        }

        $totalLecciones = $curso->lecciones()->count();
        
        if ($totalLecciones === 0) {
            return;
        }

        // Contar lecciones completadas (vista o pagada)
        $leccionesCompletadas = AvanceLeccion::where('id_contratacion', $contratacion->id)
            ->whereIn('estado_avance', ['vista', 'pagada'])
            ->count();

        // Si todas las lecciones están completadas, finalizar la contratación
        if ($leccionesCompletadas >= $totalLecciones) {
            $contratacion->update(['estado_contratacion' => 'finalizado']);
            
            // También actualizar el avance del curso al 100%
            $curso->update(['avance_porcentaje' => 100]);
        }
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Relación: Un avance pertenece a una lección
     *
     * @return BelongsTo
     */
    public function leccion(): BelongsTo
    {
        return $this->belongsTo(Leccion::class, 'id_leccion');
    }

    /**
     * Relación: Un avance pertenece a una contratación
     *
     * @return BelongsTo
     */
    public function contratacion(): BelongsTo
    {
        return $this->belongsTo(Contratacion::class, 'id_contratacion');
    }

    /**
     * Accessor: Obtener el usuario del avance a través de la contratación
     */
    public function getUsuarioAttribute()
    {
        return $this->contratacion?->usuario;
    }

    /**
     * Accessor: Obtener el ID del usuario
     */
    public function getUsuarioIdAttribute()
    {
        return $this->contratacion?->id_usuario;
    }

    /**
     * Verificar si el avance está completado
     */
    public function getCompletadoAttribute(): bool
    {
        return in_array($this->estado_avance, ['vista', 'pagada', 'completado', 'pagado']);
    }
}
