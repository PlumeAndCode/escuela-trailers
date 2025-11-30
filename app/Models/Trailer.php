<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Modelo: Trailer
 * 
 * Descripción funcional:
 * Gestiona el inventario completo de tráileres disponibles en la escuela.
 * Cada tráiler tiene información única como modelo, número de serie y placa.
 * El estado del tráiler indica si está disponible para renta, actualmente
 * rentado o en mantenimiento.
 */
class Trailer extends Model
{
    use HasFactory, HasUuids;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'trailers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'modelo',
        'numero_serie',
        'placa',
        'estado_trailer',
        'motivo_mantenimiento',
        'notas',
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
     * Relación: Un trailer puede tener muchas rentas
     *
     * @return HasMany
     */
    public function rentas(): HasMany
    {
        return $this->hasMany(RentaTrailer::class, 'id_trailer');
    }

    /**
     * Alias para rentas (compatibilidad con componentes)
     *
     * @return HasMany
     */
    public function rentasTrailer(): HasMany
    {
        return $this->hasMany(RentaTrailer::class, 'id_trailer');
    }

    /**
     * Scope: Filtrar trailers disponibles
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDisponibles($query)
    {
        return $query->where('estado_trailer', 'disponible');
    }

    /**
     * Scope: Filtrar trailers rentados
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRentados($query)
    {
        return $query->where('estado_trailer', 'rentado');
    }

    /**
     * Scope: Filtrar trailers en mantenimiento
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeEnMantenimiento($query)
    {
        return $query->where('estado_trailer', 'mantenimiento');
    }
}
