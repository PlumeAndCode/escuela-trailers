<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Modelo: Leccion
 * 
 * Descripción funcional:
 * Almacena las lecciones individuales que componen cada curso. Cada lección
 * tiene su propio estado de progreso y puede incluir observaciones sobre
 * el desempeño del estudiante o notas del instructor.
 */
class Leccion extends Model
{
    use HasFactory, HasUuids;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lecciones';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_curso',
        'nombre_leccion',
        'descripcion',
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
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Relación: Una lección pertenece a un curso
     *
     * @return BelongsTo
     */
    public function curso(): BelongsTo
    {
        return $this->belongsTo(Curso::class, 'id_curso');
    }

    /**
     * Relación: Una lección tiene muchos registros de avance
     *
     * @return HasMany
     */
    public function avances(): HasMany
    {
        return $this->hasMany(AvanceLeccion::class, 'id_leccion');
    }
}
