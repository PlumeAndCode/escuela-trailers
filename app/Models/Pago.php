<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Modelo: Pago
 * 
 * Descripción funcional:
 * Registra todos los pagos realizados por los usuarios asociados a sus
 * contrataciones de servicios. Permite controlar el método de pago utilizado,
 * el monto pagado y el estado del pago.
 */
class Pago extends Model
{
    use HasFactory, HasUuids;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pagos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_contratacion',
        'fecha_pago',
        'monto_pagado',
        'tipo_pago',
        'estado_pago',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'fecha_pago' => 'datetime',
            'monto_pagado' => 'decimal:2',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Relación: Un pago pertenece a una contratación
     *
     * @return BelongsTo
     */
    public function contratacion(): BelongsTo
    {
        return $this->belongsTo(Contratacion::class, 'id_contratacion');
    }

    /**
     * Scope: Filtrar pagos pendientes
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePendientes($query)
    {
        return $query->where('estado_pago', 'pendiente');
    }

    /**
     * Scope: Filtrar pagos completados
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePagados($query)
    {
        return $query->where('estado_pago', 'pagado');
    }
}
