<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Primero crear roles y permisos
        $this->call(RoleAndPermissionSeeder::class);

        // 2. Crear usuarios (3 admin, 3 encargados, 3 clientes)
        $this->call(UserSeeder::class);

        // 3. Crear catálogos base
        $this->call([
            ServiciosSeeder::class,
            TrailersSeeder::class,
        ]);

        // 4. Crear contrataciones (solo para clientes)
        $this->call(ContratacionesSeeder::class);

        // 5. Crear cursos y lecciones
        $this->call([
            CursosSeeder::class,
            LeccionesSeeder::class,
            AvanceLeccionSeeder::class,
        ]);

        // 6. Crear datos adicionales
        $this->call([
            LeccionesIndividualesSeeder::class,
            TramitesLicenciaSeeder::class,
            RentasTrailerSeeder::class,
        ]);

        // 7. Crear pagos (pagados, pendientes, vencidos)
        $this->call(PagosSeeder::class);

        $this->command->info('');
        $this->command->info('========================================');
        $this->command->info('✅ BASE DE DATOS POBLADA EXITOSAMENTE');
        $this->command->info('========================================');
        $this->command->info('');
        $this->command->info('📧 CREDENCIALES DE ACCESO (contraseña: secreta123)');
        $this->command->info('');
        $this->command->info('👤 ADMINISTRADORES (3):');
        $this->command->info('   - admin@gmail.com');
        $this->command->info('   - maria.ruiz@gmail.com');
        $this->command->info('   - carlos.mendoza@gmail.com');
        $this->command->info('');
        $this->command->info('👷 ENCARGADOS (3):');
        $this->command->info('   - encargado@gmail.com');
        $this->command->info('   - ana.lopez@gmail.com');
        $this->command->info('   - pedro.ramirez@gmail.com');
        $this->command->info('');
        $this->command->info('🎓 CLIENTES (15):');
        $this->command->info('   - usuario@gmail.com (principal)');
        $this->command->info('   - luis.martinez@gmail.com');
        $this->command->info('   - sofia.gonzalez@gmail.com');
        $this->command->info('   - miguel.torres@gmail.com');
        $this->command->info('   - alejandra.hernandez@gmail.com');
        $this->command->info('   - fernando.sanchez@gmail.com');
        $this->command->info('   - patricia.ramirez@gmail.com');
        $this->command->info('   - ricardo.vargas@gmail.com');
        $this->command->info('   - carmen.ruiz@gmail.com');
        $this->command->info('   - jorge.mendez@gmail.com');
        $this->command->info('   - laura.jimenez@gmail.com');
        $this->command->info('   - daniel.ortiz@gmail.com');
        $this->command->info('   - veronica.castro@gmail.com');
        $this->command->info('   - arturo.dominguez@gmail.com');
        $this->command->info('   - gabriela.morales@gmail.com');
        $this->command->info('');
        $this->command->info('📋 Cada cliente tiene de 0 a 3 contrataciones aleatorias');
        $this->command->info('');
    }
}

