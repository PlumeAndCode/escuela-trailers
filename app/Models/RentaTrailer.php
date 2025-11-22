<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * Modelo: RentaTrailer
 * 
 * Descripción funcional:
 * Registra todas las rentas de tráileres realizadas por los usuarios.
 * Controla las fechas de renta, devolución estimada y real, permitiendo
 * identificar rentas activas, devueltas o atrasadas.
 */
class RentaTrailer extends Model
{
    use HasFactory, HasUuids;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rentas_trailer';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_trailer',
        'id_contratacion',
        'fecha_renta',
        'fecha_devolucion_estimada',
        'fecha_devolucion_real',
        'estado_renta',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'fecha_renta' => 'datetime',
            'fecha_devolucion_estimada' => 'datetime',
            'fecha_devolucion_real' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Relación: Una renta pertenece a un trailer
     *
     * @return BelongsTo
     */
    public function trailer(): BelongsTo
    {
        return $this->belongsTo(Trailer::class, 'id_trailer');
    }

    /**
     * Relación: Una renta pertenece a una contratación
     *
     * @return BelongsTo
     */
    public function contratacion(): BelongsTo
    {
        return $this->belongsTo(Contratacion::class, 'id_contratacion');
    }

    /**
     * Scope: Filtrar rentas activas
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActivas($query)
    {
        return $query->where('estado_renta', 'activa');
    }

    /**
     * Scope: Filtrar rentas atrasadas
     * Rentas que están activas y la fecha de devolución estimada ya pasó
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAtrasadas($query)
    {
        return $query->where('estado_renta', 'atrasada')
            ->orWhere(function ($query) {
                $query->where('estado_renta', 'activa')
                    ->where('fecha_devolucion_estimada', '<', Carbon::now());
            });
    }
}
