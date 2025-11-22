<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Manager - Escuela Trailers')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen bg-gray-100">
    @include('components.admin.navbar')

    <div class="flex">
        <!-- Menu lateral del encargado -->
        <aside class="w-64 bg-gray-800 border-r min-h-screen p-4">
            @php
                $currentUser = $user ?? auth()->user() ?? (object)[
                    'nombre_completo' => 'Encargado',
                    'email' => 'demo@local',
                    'profile_photo_url' => 'https://ui-avatars.com/api/?name=Encargado+Invitado&background=0D8ABC&color=fff',
                    'rol' => 'encargado',
                ];

                $managerMenuItems = [
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
        </aside>

        <!-- Contenido principal -->
        <main class="flex-1 p-6">
            {{ $slot }}
        </main>
    </div>

    @livewireScripts
</body>
</html>