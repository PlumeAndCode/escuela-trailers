<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed roles and permissions first
        $this->call(RoleAndPermissionSeeder::class);

        // Create an admin user
        $adminUser = User::factory()->create([
            'nombre_completo' => 'Administrador',
            'email' => 'admin@escuela-trailers.com',
            'rol' => 'administrador',
            'estado_usuario' => true,
        ]);
        $adminUser->assignRole('administrador');

        // Create a manager user
        $managerUser = User::factory()->create([
            'nombre_completo' => 'Encargado',
            'email' => 'manager@escuela-trailers.com',
            'rol' => 'encargado',
            'estado_usuario' => true,
        ]);
        $managerUser->assignRole('encargado');

        // Create a client user
        $clientUser = User::factory()->create([
            'nombre_completo' => 'Cliente',
            'email' => 'client@escuela-trailers.com',
            'rol' => 'cliente',
            'estado_usuario' => true,
        ]);
        $clientUser->assignRole('cliente');

        // Seed additional users for testing
        User::factory(5)->create()->each(function ($user) {
            $user->assignRole('cliente');
        });

        // Seed servicios y trailers (tablas independientes)
        $this->call([
            ServiciosSeeder::class,
            TrailersSeeder::class,
        ]);

        // Seed contrataciones (depende de users y servicios)
        $this->call(ContratacionesSeeder::class);

        // Seed cursos y lecciones (dependen de contrataciones)
        $this->call([
            CursosSeeder::class,
            LeccionesSeeder::class,
            AvanceLeccionSeeder::class,
        ]);

        // Seed lecciones individuales (dependen de contrataciones)
        $this->call(LeccionesIndividualesSeeder::class);

        // Seed trámites de licencia (dependen de contrataciones)
        $this->call(TramitesLicenciaSeeder::class);

        // Seed rentas de tráiler (dependen de contrataciones y trailers)
        $this->call(RentasTrailerSeeder::class);

        // Seed pagos (dependen de contrataciones)
        $this->call(PagosSeeder::class);
    }
}

