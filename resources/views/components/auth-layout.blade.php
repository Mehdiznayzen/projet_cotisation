<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($title) ? $title . ' - ' : '' }}CotisationPro</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-600/5 via-purple-600/5 to-pink-600/5 animate-gradient"></div>
        
        <div class="sm:mx-auto sm:w-full sm:max-w-md relative z-10">
            <a href="{{ route('welcome') }}" class="flex justify-center">
                <div class="inline-flex items-center space-x-3 animate-fadeInUp">
                    <div class="relative">
                        <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-700 rounded-xl flex items-center justify-center animate-pulse-glow">
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3L19 12L5 21V3Z" />
                            </svg>
                        </div>
                    </div>
                    <span class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent">
                        CotisationPro
                    </span>
                </div>
            </a>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md relative z-10">
            <div class="bg-white/80 backdrop-blur-sm py-8 px-4 shadow-xl rounded-2xl sm:px-10 animate-fadeInUp delay-200">
                {{ $slot }}
            </div>
        </div>

        <div class="mt-8 text-center relative z-10">
            <div class="space-y-4 animate-fadeInUp delay-300">
                <p class="text-xs text-gray-500">
                    © 2025 CotisationPro. Tous droits réservés.
                </p>
            </div>
        </div>
    </div>
</body>
</html>