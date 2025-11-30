<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed roles and permissions first
        $this->call(RoleAndPermissionSeeder::class);

        // Usuario Admin - Credenciales de prueba
        $adminUser = User::create([
            'nombre_completo' => 'Administrador',
            'email' => 'admin@escuela-trailers.com',
            'telefono' => '4431234567',
            'password' => Hash::make('password123'),
            'rol' => 'administrador',
            'estado_usuario' => true,
            'email_verified_at' => now(),
        ]);
        $adminUser->assignRole('administrador');

        // Usuario Encargado - Credenciales de prueba
        $managerUser = User::create([
            'nombre_completo' => 'Juan Encargado',
            'email' => 'manager@escuela-trailers.com',
            'telefono' => '4431234568',
            'password' => Hash::make('password123'),
            'rol' => 'encargado',
            'estado_usuario' => true,
            'email_verified_at' => now(),
        ]);
        $managerUser->assignRole('encargado');

        // Usuario Cliente - Credenciales de prueba
        $clientUser = User::create([
            'nombre_completo' => 'Carlos Cliente',
            'email' => 'cliente@escuela-trailers.com',
            'telefono' => '4431234569',
            'password' => Hash::make('password123'),
            'rol' => 'cliente',
            'estado_usuario' => true,
            'email_verified_at' => now(),
        ]);
        $clientUser->assignRole('cliente');

        // Seed additional data
        $this->call([
            ServiciosSeeder::class,
            TrailersSeeder::class,
            ContratacionesSeeder::class,
            CursosSeeder::class,
            LeccionesSeeder::class,
            AvanceLeccionSeeder::class,
            LeccionesIndividualesSeeder::class,
            TramitesLicenciaSeeder::class,
            RentasTrailerSeeder::class,
            PagosSeeder::class,
        ]);
    }
}

