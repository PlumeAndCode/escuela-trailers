<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'DriveMaster Pro') }}</title>

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

            <!-- User Profile Card (Tarjeta Naranja - Igual que Admin) -->
            <div class="bg-gradient-to-r from-amber-500 to-amber-600 rounded-lg p-4 text-white shadow-md hover:bg-amber-600 transition-all duration-300 hover:shadow-lg hover:shadow-amber-500/50 mb-6">
                <div class="flex items-center gap-3">
                    <img src="{{ auth()->user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->nombre_completo ?? 'Usuario') . '&background=0D8ABC&color=fff' }}" 
                         class="w-16 h-16 rounded-full object-cover border-4 border-white shadow-lg flex-shrink-0" 
                         alt="avatar">
                    <div class="min-w-0 flex-1">
                        <div class="font-bold text-base truncate">{{ auth()->user()->nombre_completo ?? 'Usuario' }}</div>
                        <div class="text-amber-100 text-xs truncate" title="{{ auth()->user()->email ?? '' }}">{{ auth()->user()->email ?? '' }}</div>
                        <div class="text-xs text-amber-50 mt-1 uppercase tracking-wide">CLIENTE</div>
                    </div>
                </div>
            </div>

            <!-- Navigation Menu -->
            <x-client.client-menu :user="auth()->user()" />
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