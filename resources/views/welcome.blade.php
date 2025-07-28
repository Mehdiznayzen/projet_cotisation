<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CotisationPro - Gestion des Cotisations</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased">
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50">
        
        @if (Route::has('login'))
            <div class="fixed top-0 right-0 z-50 p-6">
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white/80 backdrop-blur-sm border border-gray-200 rounded-lg hover:bg-white hover:shadow-lg transition-all duration-300">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 transition-colors">
                            Se connecter
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-blue-700 rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-300 shadow-lg hover:shadow-xl">
                                S'inscrire
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        @endif

        <section class="relative overflow-hidden min-h-screen">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-600/10 via-purple-600/10 to-pink-600/10 animate-gradient"></div>
            
            <div class="relative container mx-auto px-4 py-20 lg:py-32">
                <div class="text-center space-y-8">
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

                    <div class="space-y-4 animate-fadeInUp delay-100">
                        <h1 class="text-4xl lg:text-6xl font-bold text-gray-900 leading-tight">
                            Gérez vos cotisations
                            <span class="block bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 bg-clip-text text-transparent">
                                en toute simplicité
                            </span>
                        </h1>
                        <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                            La plateforme moderne pour gérer les cotisations de votre organisation. 
                            Automatisez les paiements, suivez les membres et générez des rapports détaillés.
                        </p>
                    </div>

                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4 animate-fadeInUp delay-200">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="inline-flex items-center px-8 py-3 text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 group">
                                Commencer maintenant
                                <svg class="ml-2 h-4 w-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="inline-flex items-center px-8 py-3 text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 group">
                                Commencer maintenant
                                <svg class="ml-2 h-4 w-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
</html>