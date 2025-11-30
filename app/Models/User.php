<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Modelo User
 * 
 * Representa a los usuarios del sistema de la Escuela de Manejo de Tráileres.
 * Implementa autenticación con verificación de email y sistema de roles Spatie.
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use HasRoles;
    use HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre_completo',
        'telefono',
        'email',
        'password',
        'rol',
        'estado_usuario',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'estado_usuario' => 'boolean',
        ];
    }

    /**
     * Verifica si el usuario está activo
     *
     * @return bool
     */
    public function isActivo(): bool
    {
        return $this->estado_usuario === true;
    }

    /**
     * Verifica si el usuario tiene un rol específico (usando Spatie)
     *
     * @param string $rol
     * @return bool
     */
    public function tieneRol(string $rol): bool
    {
        return $this->hasRole($rol);
    }

    /**
     * Obtiene la ruta del dashboard según el rol del usuario
     * Redirección inteligente post-login
     *
     * @return string
     */
    public function getDashboardPath(): string
    {
        if ($this->hasRole('administrador')) {
            return '/admin';
        }
        
        if ($this->hasRole('encargado')) {
            return '/manager';
        }
        
        if ($this->hasRole('cliente')) {
            return '/client/dashboard';
        }
        
        return '/dashboard';
    }

    /**
     * Relación: Un usuario tiene muchas contrataciones
     */
    public function contrataciones(): HasMany
    {
        return $this->hasMany(Contratacion::class, 'id_usuario');
    }

    /**
     * Obtener avances de lecciones a través de contrataciones
     */
    public function getAvancesLeccionesAttribute()
    {
        return AvanceLeccion::whereIn('id_contratacion', $this->contrataciones->pluck('id'))->get();
    }

    /**
     * Relación: Un usuario tiene muchos trámites de licencia
     */
    public function tramitesLicencia(): HasMany
    {
        return $this->hasMany(TramiteLicencia::class, 'id_usuario');
    }

    /**
     * Relación: Un usuario tiene muchas lecciones individuales
     */
    public function leccionesIndividuales(): HasMany
    {
        return $this->hasMany(LeccionIndividual::class, 'id_usuario');
    }
}
