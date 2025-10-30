<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Reed Code Laundry') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
</head>
<body class="bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 text-gray-100" style="font-family: 'Inter', sans-serif;">
    <!-- Animated Background Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-96 h-96 bg-cyan-500/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-purple-500/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 700ms;"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-pink-500/5 rounded-full blur-3xl animate-pulse" style="animation-delay: 1400ms;"></div>
    </div>

    <!-- Background Pattern -->
    <div class="fixed inset-0 opacity-5 pointer-events-none">
        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 1px 1px, rgb(255 255 255 / 0.15) 1px, transparent 0); background-size: 40px 40px;"></div>
    </div>

    <div class="min-h-screen flex flex-col justify-center items-center px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Logo -->
        <div class="mb-8 animate-fade-in">
            <a href="/" class="flex items-center space-x-3 group">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-cyan-500 to-purple-500 rounded-xl blur-md opacity-75 group-hover:opacity-100 transition-opacity"></div>
                    <img src="https://www.svgrepo.com/show/195928/laundry.svg" alt="Reed Code Laundry Logo" class="h-14 w-14 relative z-10 transform group-hover:scale-110 transition-transform duration-300">
                </div>
                <div class="flex flex-col">
                    <span class="text-2xl font-bold bg-gradient-to-r from-cyan-400 to-purple-400 bg-clip-text text-transparent">Reed Code</span>
                    <span class="text-sm text-gray-400 -mt-1">Laundry</span>
                </div>
            </a>
        </div>

        <!-- Auth Card -->
        <div class="w-full max-w-lg animate-slide-up">
            <div class="relative group">
                <!-- Glow Effect -->
                <div class="absolute -inset-0.5 bg-gradient-to-r from-cyan-500 to-purple-500 rounded-2xl blur opacity-20 group-hover:opacity-30 transition duration-500"></div>
                
                <!-- Card Content -->
                <div class="relative bg-gradient-to-br from-slate-800/90 to-slate-900/90 backdrop-blur-xl rounded-2xl border border-white/10 overflow-hidden">
                    {{ $slot }}
                </div>
            </div>
        </div>

        <!-- Back to Home -->
        <div class="mt-8 animate-fade-in" style="animation-delay: 200ms;">
            <a href="/" class="group flex items-center space-x-2 text-gray-400 hover:text-cyan-400 transition-all duration-300">
                <i data-feather="arrow-left" class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform"></i>
                <span>Kembali ke Halaman Utama</span>
            </a>
        </div>
    </div>

    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slide-up {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.6s ease-out forwards;
        }

        .animate-slide-up {
            animation: slide-up 0.6s ease-out forwards;
        }
    </style>

    <script>
        feather.replace();
    </script>
</body>
</html>