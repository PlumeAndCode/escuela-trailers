<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        // Define permissions
        $permissions = [
            // User management
            'create_users',
            'edit_users',
            'delete_users',
            'view_users',

            // Service management
            'create_services',
            'edit_services',
            'delete_services',
            'view_services',

            // Hiring management
            'create_hierings',
            'edit_hierings',
            'delete_hierings',
            'view_hierings',

            // Course management
            'create_courses',
            'edit_courses',
            'delete_courses',
            'view_courses',

            // Lesson management
            'create_lessons',
            'edit_lessons',
            'delete_lessons',
            'view_lessons',

            // License procedures
            'create_license_procedures',
            'edit_license_procedures',
            'delete_license_procedures',
            'view_license_procedures',

            // Trailer management
            'create_trailers',
            'edit_trailers',
            'delete_trailers',
            'view_trailers',

            // Trailer rentals
            'create_rentals',
            'edit_rentals',
            'delete_rentals',
            'view_rentals',

            // Payments
            'create_payments',
            'edit_payments',
            'delete_payments',
            'view_payments',

            // Reports
            'view_reports',

            // Dashboard
            'view_dashboard',
        ];

        // Create permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Create roles
        $adminRole = Role::firstOrCreate(['name' => 'administrador', 'guard_name' => 'web']);
        $managerRole = Role::firstOrCreate(['name' => 'encargado', 'guard_name' => 'web']);
        $clientRole = Role::firstOrCreate(['name' => 'cliente', 'guard_name' => 'web']);

        // Assign all permissions to admin
        $adminRole->syncPermissions($permissions);

        // Assign permissions to manager (encargado)
        $managerPermissions = [
            'view_users',
            'view_services',
            'create_hierings',
            'edit_hierings',
            'view_hierings',
            'create_courses',
            'edit_courses',
            'view_courses',
            'create_lessons',
            'edit_lessons',
            'view_lessons',
            'create_license_procedures',
            'edit_license_procedures',
            'view_license_procedures',
            'view_trailers',
            'create_rentals',
            'edit_rentals',
            'view_rentals',
            'view_payments',
            'view_reports',
            'view_dashboard',
        ];
        $managerRole->syncPermissions($managerPermissions);

        // Assign permissions to client (cliente)
        $clientPermissions = [
            'view_services',
            'view_hierings',
            'view_courses',
            'view_lessons',
            'view_rentals',
            'view_payments',
            'view_dashboard',
        ];
        $clientRole->syncPermissions($clientPermissions);
    }
}
