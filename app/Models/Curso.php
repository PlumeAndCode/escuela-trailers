<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Modelo: Curso
 * 
 * Descripción funcional:
 * Gestiona los cursos completos contratados por los usuarios. Cada curso
 * está vinculado a una contratación específica y permite hacer seguimiento
 * del avance del estudiante mediante el porcentaje de completitud.
 */
class Curso extends Model
{
    use HasFactory, HasUuids;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cursos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_contratacion',
        'nombre_curso',
        'descripcion',
        'avance_porcentaje',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'avance_porcentaje' => 'decimal:2',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Relación: Un curso pertenece a una contratación
     *
     * @return BelongsTo
     */
    public function contratacion(): BelongsTo
    {
        return $this->belongsTo(Contratacion::class, 'id_contratacion');
    }

    /**
     * Relación: Un curso tiene muchas lecciones
     *
     * @return HasMany
     */
    public function lecciones(): HasMany
    {
        return $this->hasMany(Leccion::class, 'id_curso');
    }
}
