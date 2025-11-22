<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Modelo: Contratacion
 * 
 * Descripción funcional:
 * Registra todas las contrataciones de servicios realizadas por los usuarios.
 * Esta tabla actúa como punto central que conecta a los usuarios con los 
 * servicios que han adquirido, permitiendo hacer seguimiento del estado 
 * de cada contratación.
 */
class Contratacion extends Model
{
    use HasFactory, HasUuids;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'contrataciones';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_usuario',
        'id_servicio',
        'fecha_contratacion',
        'estado_contratacion',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'fecha_contratacion' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Relación: Una contratación pertenece a un usuario
     *
     * @return BelongsTo
     */
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    /**
     * Relación: Una contratación pertenece a un servicio
     *
     * @return BelongsTo
     */
    public function servicio(): BelongsTo
    {
        return $this->belongsTo(Servicio::class, 'id_servicio');
    }

    /**
     * Relación: Una contratación puede tener muchos pagos
     *
     * @return HasMany
     */
    public function pagos(): HasMany
    {
        return $this->hasMany(Pago::class, 'id_contratacion');
    }

    /**
     * Relación: Una contratación puede tener un curso
     *
     * @return HasOne
     */
    public function curso(): HasOne
    {
        return $this->hasOne(Curso::class, 'id_contratacion');
    }

    /**
     * Relación: Una contratación puede tener muchas lecciones individuales
     *
     * @return HasMany
     */
    public function leccionesIndividuales(): HasMany
    {
        return $this->hasMany(LeccionIndividual::class, 'id_contratacion');
    }

    /**
     * Relación: Una contratación puede tener un trámite de licencia
     *
     * @return HasOne
     */
    public function tramiteLicencia(): HasOne
    {
        return $this->hasOne(TramiteLicencia::class, 'id_contratacion');
    }

    /**
     * Relación: Una contratación puede tener muchas rentas de trailer
     *
     * @return HasMany
     */
    public function rentasTrailer(): HasMany
    {
        return $this->hasMany(RentaTrailer::class, 'id_contratacion');
    }

    /**
     * Relación: Una contratación puede tener muchos registros de avance de lección
     *
     * @return HasMany
     */
    public function avancesLeccion(): HasMany
    {
        return $this->hasMany(AvanceLeccion::class, 'id_contratacion');
    }

    /**
     * Scope: Filtrar contrataciones activas
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActivas($query)
    {
        return $query->where('estado_contratacion', 'activo');
    }

    /**
     * Scope: Filtrar por usuario
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $userId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePorUsuario($query, $userId)
    {
        return $query->where('id_usuario', $userId);
    }
}
