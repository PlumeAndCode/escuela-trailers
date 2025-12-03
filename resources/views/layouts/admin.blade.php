<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'DriveMaster Pro') }} - Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased bg-gray-100 overflow-hidden">
    <div class="h-screen flex">
        <!-- Sidebar -->
        <div class="w-64 bg-slate-800 text-white h-screen flex-shrink-0 p-6 overflow-hidden">
            <!-- Logo -->
            <div class="text-2xl font-bold text-center mb-8">
                Drive<span class="text-amber-500">Master</span> Pro
            </div>

            @php
                $currentUser = $user ?? auth()->user() ?? (object)[
                    'nombre_completo' => 'Admin',
                    'email' => 'admin@local',
                    'profile_photo_url' => 'https://ui-avatars.com/api/?name=Administrador+Invitado&background=FF7A00&color=fff',
                    'rol' => 'administrador',
                ];

                $adminMenuItems = [
                    [
                        'label' => 'Inicio',
                        'url' => route('admin.dashboard'),
                        'routeName' => 'admin.dashboard',
                    ],
                    [
                        'label' => 'Usuarios',
                        'url' => route('admin.users.index'),
                        'routeName' => 'admin.users.index',
                    ],
                    [
                        'label' => 'Pagos',
                        'url' => route('admin.pagos.index'),
                        'routeName' => 'admin.pagos.index',
                    ],
                    [
                        'label' => 'Reportes',
                        'url' => route('admin.reportes.index'),
                        'routeName' => 'admin.reportes.index',
                    ],
                    [
                        'label' => 'Control',
                        'url' => route('admin.control.index'),
                        'routeName' => 'admin.control.index',
                    ],
                ];
            @endphp

            @include('components.admin.user-info', ['user' => $currentUser])
            <div class="mt-6">
                @include('components.admin.user-menu', ['user' => $currentUser, 'menuItems' => $adminMenuItems])
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-y-auto">
            <main class="p-8">
                {{ $slot }}
            </main>
        </div>
    </div>

    @livewireScripts
</body>
</html>