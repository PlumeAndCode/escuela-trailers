<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'DriveMaster Pro') }} - Encargado</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div class="w-64 bg-slate-800 text-white min-h-screen p-6">
            <!-- Logo -->
            <div class="text-2xl font-bold text-center mb-8">
                Drive<span class="text-amber-500">Master</span> Pro
            </div>

            @php
                $currentUser = $user ?? auth()->user() ?? (object)[
                    'nombre_completo' => 'Encargado',
                    'email' => 'demo@local',
                    'profile_photo_url' => 'https://ui-avatars.com/api/?name=Encargado+Invitado&background=0D8ABC&color=fff',
                    'rol' => 'encargado',
                ];

                $managerMenuItems = [
                    [
                        'label' => 'Inicio',
                        'url' => route('manager.dashboard'),
                        'routeName' => 'manager.dashboard',
                    ],
                    [
                        'label' => 'Lecciones',
                        'url' => route('manager.lecciones.index'),
                        'routeName' => 'manager.lecciones.index',
                    ],
                    [
                        'label' => 'Trailers',
                        'url' => route('manager.trailers.index'),
                        'routeName' => 'manager.trailers.index',
                    ],
                    [
                        'label' => 'Reportes',
                        'url' => route('manager.reportes.index'),
                        'routeName' => 'manager.reportes.index',
                    ],
                ];
            @endphp

            @include('components.admin.user-info', ['user' => $currentUser])
            <div class="mt-6">
                @include('components.admin.user-menu', ['user' => $currentUser, 'menuItems' => $managerMenuItems])
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1">
            <main class="p-8">
                {{ $slot }}
            </main>
        </div>
    </div>

    @livewireScripts
</body>
</html>