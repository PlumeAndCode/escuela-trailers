<?php

return [

    //Explicación de las relaciones entre tablas:
    //users (1)  ─ many ─> model_has_roles (tabla pivote) ─ many ─> roles
    //roles (1)  ─ many ─> role_has_permissions (tabla pivote) ─ many ─> permissions
    //users (1)  ─ many ─> model_has_permissions (tabla pivote) ─ many ─> permissions


    // Modelos
    'models' => [

        'permission' => Spatie\Permission\Models\Permission::class,

        'role' => Spatie\Permission\Models\Role::class,

    ],

    // Nombres de tablas
    'table_names' => [

        'roles' => 'roles',

        'permissions' => 'permissions',


        'model_has_permissions' => 'model_has_permissions',


        'model_has_roles' => 'model_has_roles',


        'role_has_permissions' => 'role_has_permissions',
    ],

    // Nombres de columnas
    'column_names' => [
        /*
         * Change this if you want to name the related pivots other than defaults
         */
        'role_pivot_key' => null, // default 'role_id',
        'permission_pivot_key' => null, // default 'permission_id',


        'model_morph_key' => 'model_id',


        'team_foreign_key' => 'team_id',
    ],

    'register_permission_check_method' => true,
    'register_octane_reset_listener' => false,
    'events_enabled' => false,
    'teams' => false,
    'team_resolver' => \Spatie\Permission\DefaultTeamResolver::class,
    'use_passport_client_credentials' => false,
    'display_permission_in_exception' => false,
    'display_role_in_exception' => false,
    'enable_wildcard_permission' => false,



    'cache' => [

        'expiration_time' => \DateInterval::createFromDateString('24 hours'),

        'key' => 'spatie.permission.cache',

        'store' => 'default',
    ],
];
