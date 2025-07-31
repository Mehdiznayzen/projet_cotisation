<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'CotisationPro') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            @keyframes slide-down {
                from {
                    opacity: 0;
                    transform: translateY(-20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @keyframes fade-in-left {
                from {
                    opacity: 0;
                    transform: translateX(-20px);
                }
                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }

            @keyframes fade-in-right {
                from {
                    opacity: 0;
                    transform: translateX(20px);
                }
                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }

            @keyframes fade-in {
                from {
                    opacity: 0;
                }
                to {
                    opacity: 1;
                }
            }

            @keyframes scale-in {
                from {
                    opacity: 0;
                    transform: scale(0.95);
                }
                to {
                    opacity: 1;
                    transform: scale(1);
                }
            }

            .animate-slide-down {
                animation: slide-down 0.5s ease-out;
            }

            .animate-fade-in-left {
                animation: fade-in-left 0.6s ease-out;
            }

            .animate-fade-in-right {
                animation: fade-in-right 0.6s ease-out;
            }

            .animate-fade-in {
                animation: fade-in 0.6s ease-out;
            }

            .animate-scale-in {
                animation: scale-in 0.2s ease-out;
            }

            #search-input:focus {
                transform: translateY(-1px);
                box-shadow: 0 10px 25px rgba(147, 51, 234, 0.1);
            }

            button:hover {
                transform: translateY(-1px);
            }

            .backdrop-blur {
                backdrop-filter: blur(8px);
            }
        </style>

    </head>
    <body class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 dark:from-slate-900 dark:to-slate-800">
        <div class="min-h-screen">
            <!-- Header Dashboard Admin -->
            <header class="bg-white shadow-lg border-b border-gray-200 sticky top-0 z-50 animate-slide-dow py-1">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center h-16">
                        
                        <!-- Logo et titre -->
                        <div class="flex items-center space-x-4">
                            <div class="bg-gradient-to-r from-blue-600 to-purple-600 p-2 rounded-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                                    {{ __('Dashboard Administrateur') }}
                                </h1>
                                <p class="text-sm text-slate-600 dark:text-slate-400">Gestion des cotisations et dépenses</p>
                            </div>
                        </div>

                        <!-- Actions et profil -->
                        <div class="flex items-center space-x-4 animate-fade-in-right">
                            
                            <!-- Boutons d'action rapide -->
                            <div class="hidden lg:flex space-x-2">
                                <button class="relative p-2 text-gray-400 hover:text-purple-600 hover:bg-purple-50 rounded-lg transition-all duration-200 group">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                    <span class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs rounded py-1 px-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap">
                                        Nouvelle cotisation
                                    </span>
                                </button>
                                
                                <button class="relative p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all duration-200 group">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                                    </svg>
                                    <span class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs rounded py-1 px-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap">
                                        Nouvelle dépense
                                    </span>
                                </button>
                            </div>

                            <!-- Notifications -->
                            <div class="relative">
                                <button class="p-2 text-gray-400 hover:text-purple-600 hover:bg-purple-50 rounded-lg transition-all duration-200 relative"
                                        onclick="toggleNotifications()">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                    </svg>
                                    <!-- Badge de notification -->
                                    <span class="absolute -top-1 -right-1 h-4 w-4 bg-red-500 text-white text-xs rounded-full flex items-center justify-center animate-pulse">
                                        3
                                    </span>
                                </button>
                                
                                <!-- Dropdown notifications -->
                                <div id="notifications-dropdown" class="hidden absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg border border-gray-200 z-50 animate-scale-in">
                                    <div class="p-4 border-b border-gray-200">
                                        <h3 class="text-sm font-medium text-gray-900">Notifications</h3>
                                    </div>
                                    <div class="max-h-64 overflow-y-auto">
                                        <div class="p-3 hover:bg-gray-50 border-b border-gray-100 transition-colors">
                                            <div class="flex items-start space-x-3">
                                                <div class="w-2 h-2 bg-green-500 rounded-full mt-2"></div>
                                                <div class="flex-1">
                                                    <p class="text-sm text-gray-900">Nouvelle cotisation reçue</p>
                                                    <p class="text-xs text-gray-500">Marie Dubois - €50.00</p>
                                                    <p class="text-xs text-gray-400">Il y a 5 minutes</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-3 hover:bg-gray-50 border-b border-gray-100 transition-colors">
                                            <div class="flex items-start space-x-3">
                                                <div class="w-2 h-2 bg-blue-500 rounded-full mt-2"></div>
                                                <div class="flex-1">
                                                    <p class="text-sm text-gray-900">Nouveau membre inscrit</p>
                                                    <p class="text-xs text-gray-500">Pierre Martin</p>
                                                    <p class="text-xs text-gray-400">Il y a 1 heure</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-3 hover:bg-gray-50 transition-colors">
                                            <div class="flex items-start space-x-3">
                                                <div class="w-2 h-2 bg-yellow-500 rounded-full mt-2"></div>
                                                <div class="flex-1">
                                                    <p class="text-sm text-gray-900">Dépense en attente</p>
                                                    <p class="text-xs text-gray-500">Matériel bureau - €180.50</p>
                                                    <p class="text-xs text-gray-400">Il y a 2 heures</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-3 border-t border-gray-200">
                                        <button class="w-full text-center text-sm text-purple-600 hover:text-purple-500 font-medium">
                                            Voir toutes les notifications
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Menu utilisateur -->
                            <div class="relative">
                                <button class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-50 transition-all duration-200"
                                        onclick="toggleUserMenu()">
                                    <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-purple-600 rounded-full flex items-center justify-center">
                                        <span class="text-sm font-medium text-white">{{ substr(auth()->guard('admin')->user()->name ?? 'A', 0, 1) }}</span>
                                    </div>
                                    <div class="hidden md:block text-left">
                                        <p class="text-sm font-medium text-gray-900">{{ auth()->guard('admin')->user()->name ?? 'Admin' }}</p>
                                        <p class="text-xs text-gray-500">Administrateur</p>
                                    </div>
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>
                                
                                <!-- Dropdown utilisateur -->
                                <div id="user-dropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 z-50 animate-scale-in">
                                    <div class="py-1">
                                        <div class="border-t border-gray-100"></div>
                                        <form method="POST" action="{{ route('admin.logout') }}">
                                            @csrf
                                            <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-red-700 hover:bg-red-50 transition-colors">
                                                <svg class="w-4 h-4 mr-3 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                                </svg>
                                                Déconnexion
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Menu mobile -->
                            <button class="md:hidden p-2 text-gray-400 hover:text-purple-600 hover:bg-purple-50 rounded-lg transition-all duration-200"
                                    onclick="toggleMobileMenu()">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Barre de recherche mobile -->
                    <div class="md:hidden px-4 pb-4">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                            <input type="text" 
                                class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200"
                                placeholder="Rechercher...">
                        </div>
                    </div>
                </div>

                <!-- Menu mobile -->
                <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-200 animate-slide-down">
                    <div class="px-4 py-2 space-y-1">
                        <a href="#" class="flex items-center px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-lg transition-colors">
                            <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Nouvelle cotisation
                        </a>
                        <a href="#" class="flex items-center px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-lg transition-colors">
                            <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                            </svg>
                            Nouvelle dépense
                        </a>
                    </div>
                </div>
            </header>

            <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
                @yield('content')
            </main>

        </div>
        <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
        <script>
            function toggleNotifications() {
                const dropdown = document.getElementById('notifications-dropdown');
                dropdown.classList.toggle('hidden');
                
                document.getElementById('user-dropdown').classList.add('hidden');
            }

            function toggleUserMenu() {
                const dropdown = document.getElementById('user-dropdown');
                dropdown.classList.toggle('hidden');
                
                document.getElementById('notifications-dropdown').classList.add('hidden');
            }

            function toggleMobileMenu() {
                const menu = document.getElementById('mobile-menu');
                menu.classList.toggle('hidden');
            }

            document.addEventListener('click', function(event) {
                const notificationsButton = event.target.closest('[onclick="toggleNotifications()"]');
                const userButton = event.target.closest('[onclick="toggleUserMenu()"]');
                const mobileButton = event.target.closest('[onclick="toggleMobileMenu()"]');
                
                if (!notificationsButton) {
                    document.getElementById('notifications-dropdown').classList.add('hidden');
                }
                
                if (!userButton) {
                    document.getElementById('user-dropdown').classList.add('hidden');
                }
                
                if (!mobileButton) {
                    document.getElementById('mobile-menu').classList.add('hidden');
                }
            });

            document.getElementById('search-input')?.addEventListener('focus', function() {
                this.parentElement.classList.add('ring-2', 'ring-purple-500');
            });

            document.getElementById('search-input')?.addEventListener('blur', function() {
                this.parentElement.classList.remove('ring-2', 'ring-purple-500');
            });
        </script>
    </body>
</html>