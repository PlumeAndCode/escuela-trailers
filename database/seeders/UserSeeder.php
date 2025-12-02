<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ========================================
        // ADMINISTRADORES (3)
        // ========================================
        $admins = [
            [
                'nombre_completo' => 'Administrador Principal',
                'email' => 'admin@gmail.com',
                'telefono' => '4431234567',
            ],
            [
                'nombre_completo' => 'María Fernanda Ruiz',
                'email' => 'maria.ruiz@gmail.com',
                'telefono' => '4437654321',
            ],
            [
                'nombre_completo' => 'Carlos Mendoza Torres',
                'email' => 'carlos.mendoza@gmail.com',
                'telefono' => '4439876543',
            ],
        ];

        foreach ($admins as $admin) {
            $user = User::create([
                'nombre_completo' => $admin['nombre_completo'],
                'email' => $admin['email'],
                'telefono' => $admin['telefono'],
                'password' => Hash::make('secreta123'),
                'rol' => 'administrador',
                'estado_usuario' => true,
                'email_verified_at' => now(),
            ]);
            $user->assignRole('administrador');
        }

        // ========================================
        // ENCARGADOS (3)
        // ========================================
        $encargados = [
            [
                'nombre_completo' => 'Encargado Principal',
                'email' => 'encargado@gmail.com',
                'telefono' => '4432223344',
            ],
            [
                'nombre_completo' => 'Ana López Hernández',
                'email' => 'ana.lopez@gmail.com',
                'telefono' => '4435556677',
            ],
            [
                'nombre_completo' => 'Pedro Ramírez Castro',
                'email' => 'pedro.ramirez@gmail.com',
                'telefono' => '4438889900',
            ],
        ];

        foreach ($encargados as $encargado) {
            $user = User::create([
                'nombre_completo' => $encargado['nombre_completo'],
                'email' => $encargado['email'],
                'telefono' => $encargado['telefono'],
                'password' => Hash::make('secreta123'),
                'rol' => 'encargado',
                'estado_usuario' => true,
                'email_verified_at' => now(),
            ]);
            $user->assignRole('encargado');
        }

        // ========================================
        // CLIENTES (15)
        // ========================================
        $clientes = [
            // Usuario principal de prueba
            [
                'nombre_completo' => 'Usuario Cliente',
                'email' => 'usuario@gmail.com',
                'telefono' => '4431112233',
            ],
            // Clientes adicionales con nombres mexicanos realistas
            [
                'nombre_completo' => 'Luis Martínez Flores',
                'email' => 'luis.martinez@gmail.com',
                'telefono' => '4431112234',
            ],
            [
                'nombre_completo' => 'Sofía González Ortega',
                'email' => 'sofia.gonzalez@gmail.com',
                'telefono' => '4434445566',
            ],
            [
                'nombre_completo' => 'Miguel Ángel Torres',
                'email' => 'miguel.torres@gmail.com',
                'telefono' => '4437778899',
            ],
            [
                'nombre_completo' => 'Alejandra Hernández Díaz',
                'email' => 'alejandra.hernandez@gmail.com',
                'telefono' => '4432223355',
            ],
            [
                'nombre_completo' => 'Fernando Sánchez Moreno',
                'email' => 'fernando.sanchez@gmail.com',
                'telefono' => '4433334466',
            ],
            [
                'nombre_completo' => 'Patricia Ramírez Luna',
                'email' => 'patricia.ramirez@gmail.com',
                'telefono' => '4434445577',
            ],
            [
                'nombre_completo' => 'Ricardo Vargas Castillo',
                'email' => 'ricardo.vargas@gmail.com',
                'telefono' => '4435556688',
            ],
            [
                'nombre_completo' => 'Carmen Ruiz Delgado',
                'email' => 'carmen.ruiz@gmail.com',
                'telefono' => '4436667799',
            ],
            [
                'nombre_completo' => 'Jorge Méndez Aguirre',
                'email' => 'jorge.mendez@gmail.com',
                'telefono' => '4437778800',
            ],
            [
                'nombre_completo' => 'Laura Jiménez Vega',
                'email' => 'laura.jimenez@gmail.com',
                'telefono' => '4438889911',
            ],
            [
                'nombre_completo' => 'Daniel Ortiz Reyes',
                'email' => 'daniel.ortiz@gmail.com',
                'telefono' => '4439990022',
            ],
            [
                'nombre_completo' => 'Verónica Castro Núñez',
                'email' => 'veronica.castro@gmail.com',
                'telefono' => '4430001133',
            ],
            [
                'nombre_completo' => 'Arturo Domínguez Peña',
                'email' => 'arturo.dominguez@gmail.com',
                'telefono' => '4431112244',
            ],
            [
                'nombre_completo' => 'Gabriela Morales Rivera',
                'email' => 'gabriela.morales@gmail.com',
                'telefono' => '4432223355',
            ],
        ];

        foreach ($clientes as $cliente) {
            $user = User::create([
                'nombre_completo' => $cliente['nombre_completo'],
                'email' => $cliente['email'],
                'telefono' => $cliente['telefono'],
                'password' => Hash::make('secreta123'),
                'rol' => 'cliente',
                'estado_usuario' => true,
                'email_verified_at' => now(),
            ]);
            $user->assignRole('cliente');
        }

        $this->command->info('✅ Usuarios creados: 3 Administradores, 3 Encargados, 15 Clientes');
        $this->command->info('📧 Contraseña para todos: secreta123');
    }
}
