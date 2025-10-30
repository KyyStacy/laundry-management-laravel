<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Reed Code Laundry') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Feather Icons -->
        <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 text-gray-100" style="font-family: 'Inter', sans-serif;">
        <div class="min-h-screen flex flex-col">
            @if(auth()->check() && auth()->user()->role === 'admin')
                @include('layouts.navigation') <!-- Layout untuk admin -->
            @elseif(auth()->check() && auth()->user()->role === 'karyawan')
                @include('layouts.navigation') <!-- Layout untuk karyawan, jika berbeda, sesuaikan -->
            @elseif(auth()->check() && auth()->user()->role === 'pelanggan')
                @include('layouts.second-nav') <!-- Layout untuk pelanggan -->
            @endif

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-gradient-to-r from-slate-800/50 to-slate-900/50 backdrop-blur-sm border-b border-white/10 shadow-lg">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="flex-grow mt-20">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>