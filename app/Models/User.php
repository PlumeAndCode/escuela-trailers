<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasApiTokens;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
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
        'two_factor_recovery_codes',
        'two_factor_secret',
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
