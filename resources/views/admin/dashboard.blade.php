@extends('layouts.adminlayout')
@section('content')
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="animate-slide-in-left">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Dashboard Administrateur') }}
                </h2>
                <p class="text-sm text-gray-600 mt-1">Gestion des cotisations et dépenses</p>
            </div>
            <div class="flex space-x-3 animate-slide-in-right">
                <button class="bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                    + Nouvelle Cotisation
                </button>
                <button class="bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                    + Nouvelle Dépense
                </button>
            </div>
        </div>
    </x-slot>

    <!-- <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white overflow-hidden shadow-lg rounded-xl hover:shadow-xl transition-all duration-300 animate-fade-in-up" style="animation-delay: 0.1s">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-gradient-to-br from-green-400 to-green-600 rounded-lg flex items-center justify-center shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Cotisations totales</dt>
                                    <dd class="text-2xl font-bold text-gray-900 animate-count-up">€25,430</dd>
                                    <dd class="text-sm text-green-600 font-medium">+12.5% ce mois</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-lg rounded-xl hover:shadow-xl transition-all duration-300 animate-fade-in-up" style="animation-delay: 0.2s">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-gradient-to-br from-red-400 to-red-600 rounded-lg flex items-center justify-center shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Dépenses totales</dt>
                                    <dd class="text-2xl font-bold text-gray-900 animate-count-up">€18,320</dd>
                                    <dd class="text-sm text-red-600 font-medium">+8.2% ce mois</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-lg rounded-xl hover:shadow-xl transition-all duration-300 animate-fade-in-up" style="animation-delay: 0.3s">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-400 to-blue-600 rounded-lg flex items-center justify-center shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Solde actuel</dt>
                                    <dd class="text-2xl font-bold text-green-600 animate-count-up">€7,110</dd>
                                    <dd class="text-sm text-green-600 font-medium">Excédent positif</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-lg rounded-xl hover:shadow-xl transition-all duration-300 animate-fade-in-up" style="animation-delay: 0.4s">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-gradient-to-br from-purple-400 to-purple-600 rounded-lg flex items-center justify-center shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Membres actifs</dt>
                                    <dd class="text-2xl font-bold text-gray-900 animate-count-up">142</dd>
                                    <dd class="text-sm text-blue-600 font-medium">3 nouveaux</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                
                <div class="bg-white overflow-hidden shadow-lg rounded-xl animate-fade-in-up" style="animation-delay: 0.5s">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Tendances Mensuelles</h3>
                        <p class="text-sm text-gray-500">Évolution des cotisations et dépenses</p>
                    </div>
                    <div class="p-6">
                        <div class="h-64 bg-gradient-to-br from-gray-50 to-gray-100 rounded-lg flex items-center justify-center">
                            <div class="text-center">
                                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                                <p class="text-gray-600 font-medium">Graphique des tendances</p>
                                <p class="text-gray-400 text-sm">Données en temps réel</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-lg rounded-xl animate-fade-in-up" style="animation-delay: 0.6s">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Répartition des Dépenses</h3>
                        <p class="text-sm text-gray-500">Par catégorie ce mois</p>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-blue-500 rounded-full mr-3"></div>
                                    <span class="text-sm font-medium text-gray-700">Événements</span>
                                </div>
                                <div class="text-sm font-bold text-gray-900">€8,450</div>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-blue-500 h-2 rounded-full animate-progress" style="width: 46%"></div>
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-green-500 rounded-full mr-3"></div>
                                    <span class="text-sm font-medium text-gray-700">Matériel</span>
                                </div>
                                <div class="text-sm font-bold text-gray-900">€5,230</div>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-green-500 h-2 rounded-full animate-progress" style="width: 28.5%; animation-delay: 0.2s"></div>
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-purple-500 rounded-full mr-3"></div>
                                    <span class="text-sm font-medium text-gray-700">Administration</span>
                                </div>
                                <div class="text-sm font-bold text-gray-900">€3,120</div>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-purple-500 h-2 rounded-full animate-progress" style="width: 17%; animation-delay: 0.4s"></div>
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-yellow-500 rounded-full mr-3"></div>
                                    <span class="text-sm font-medium text-gray-700">Maintenance</span>
                                </div>
                                <div class="text-sm font-bold text-gray-900">€1,520</div>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-yellow-500 h-2 rounded-full animate-progress" style="width: 8.5%; animation-delay: 0.6s"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-lg rounded-xl animate-fade-in-up" style="animation-delay: 0.7s">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Transactions Récentes</h3>
                            <p class="text-sm text-gray-500">Dernières cotisations et dépenses</p>
                        </div>
                        <button class="text-purple-600 hover:text-purple-500 text-sm font-medium transition-colors">
                            Voir tout →
                        </button>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Membre</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Montant</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr class="hover:bg-gray-50 transition-colors animate-table-row" style="animation-delay: 0.1s">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Cotisation
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Cotisation mensuelle Janvier</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Marie Dubois</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-green-600">+€50.00</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">15 Jan 2024</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Validé
                                    </span>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition-colors animate-table-row" style="animation-delay: 0.2s">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Dépense
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Achat matériel bureau</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Admin</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-red-600">-€180.50</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">14 Jan 2024</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        En attente
                                    </span>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition-colors animate-table-row" style="animation-delay: 0.3s">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Cotisation
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Cotisation mensuelle Janvier</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Pierre Martin</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-green-600">+€50.00</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">13 Jan 2024</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Validé
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> -->

    <style>
        @keyframes fade-in-up {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slide-in-left {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slide-in-right {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes progress {
            from {
                width: 0;
            }
        }

        @keyframes table-row {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes count-up {
            from {
                transform: scale(0.8);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .animate-fade-in-up {
            animation: fade-in-up 0.6s ease-out both;
        }

        .animate-slide-in-left {
            animation: slide-in-left 0.6s ease-out;
        }

        .animate-slide-in-right {
            animation: slide-in-right 0.6s ease-out;
        }

        .animate-progress {
            animation: progress 1.5s ease-out both;
        }

        .animate-table-row {
            animation: table-row 0.4s ease-out both;
        }

        .animate-count-up {
            animation: count-up 0.8s ease-out;
        }

        .hover\:scale-105:hover {
            transform: scale(1.05);
        }

        * {
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        }

        .animate-on-scroll {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease-out;
        }

        .animate-on-scroll.visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const elements = document.querySelectorAll('.animate-fade-in-up, .animate-table-row');
            elements.forEach((el, index) => {
                el.style.animationDelay = `${0.1 + (index * 0.1)}s`;
            });

            function animateValue(element, start, end, duration) {
                let startTimestamp = null;
                const step = (timestamp) => {
                    if (!startTimestamp) startTimestamp = timestamp;
                    const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                    const currentValue = Math.floor(progress * (end - start) + start);
                    element.textContent = `€${currentValue.toLocaleString()}`;
                    if (progress < 1) {
                        window.requestAnimationFrame(step);
                    }
                };
                window.requestAnimationFrame(step);
            }

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        
                        const countElement = entry.target.querySelector('.animate-count-up');
                        if (countElement) {
                            const textContent = countElement.textContent;
                            const numericValue = parseInt(textContent.replace(/[€,]/g, ''));
                            if (!isNaN(numericValue)) {
                                animateValue(countElement, 0, numericValue, 1500);
                            }
                        }
                    }
                });
            }, {
                threshold: 0.1
            });

            document.querySelectorAll('.animate-fade-in-up, .animate-count-up').forEach(el => {
                observer.observe(el);
            });
        });
    </script>
@endsection