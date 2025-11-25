<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Modelo: Servicio
 * 
 * Descripción funcional:
 * Gestiona el catálogo completo de servicios que la escuela de manejo de tráileres 
 * ofrece a sus usuarios. Incluye cursos completos, lecciones individuales, 
 * trámites de licencia y renta de tráileres.
 */
class Servicio extends Model
{
    use HasFactory, HasUuids;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'servicios';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre_servicio',
        'tipo_servicio',
        'descripcion',
        'precio',
        'estado_servicio',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'precio' => 'decimal:2',
            'estado_servicio' => 'boolean',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Relación: Un servicio puede tener muchas contrataciones
     *
     * @return HasMany
     */
    public function contrataciones(): HasMany
    {
        return $this->hasMany(Contratacion::class, 'id_servicio');
    }

    /**
     * Scope: Filtrar servicios activos
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActivos($query)
    {
        return $query->where('estado_servicio', true);
    }

    /**
     * Scope: Filtrar por tipo de servicio
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $tipo
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePorTipo($query, $tipo)
    {
        return $query->where('tipo_servicio', $tipo);
    }
}
