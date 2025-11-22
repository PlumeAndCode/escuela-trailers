<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin - Escuela Trailers')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen bg-gray-100">
    @include('components.admin.navbar')

    <div class="flex">
        <!-- Menu lateral del administrador -->
        <aside class="w-64 bg-gray-800 border-r min-h-screen p-4">
            @php
                $currentUser = $user ?? auth()->user() ?? (object)[
                    'nombre_completo' => 'Admin',
                    'email' => 'admin@local',
                    'profile_photo_url' => 'https://ui-avatars.com/api/?name=Administrador+Invitado&background=FF7A00&color=fff',
                    'rol' => 'administrador',
                ];

                $adminMenuItems = [
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
        </aside>

        <!-- Contenido principal -->
        <main class="flex-1 p-6">
            {{ $slot }}
        </main>
    </div>

    @livewireScripts
</body>
</html>