<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Modelo: LeccionIndividual
 * 
 * Descripción funcional:
 * Gestiona las lecciones contratadas de forma individual (no como parte de un curso).
 * Permite programar lecciones específicas con fecha y hora, hacer seguimiento de su
 * estado y agregar observaciones sobre el desempeño del estudiante.
 */
class LeccionIndividual extends Model
{
    use HasFactory, HasUuids;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lecciones_individuales';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_contratacion',
        'fecha_programada',
        'estado_leccion',
        'observaciones',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'fecha_programada' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Relación: Una lección individual pertenece a una contratación
     *
     * @return BelongsTo
     */
    public function contratacion(): BelongsTo
    {
        return $this->belongsTo(Contratacion::class, 'id_contratacion');
    }
}
