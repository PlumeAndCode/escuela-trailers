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
}
