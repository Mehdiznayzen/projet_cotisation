@extends('layouts.adminlayout')

@section('content')
    <div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5">
            {{-- Alerts --}}
            @if(session('success'))
                <div class="mb-6 animate-slide-down">
                    <div class="border-green-200 bg-green-50 dark:bg-green-950 dark:border-green-800 p-4 rounded-lg border">
                        <div class="flex items-center">
                            <svg class="h-4 w-4 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="text-green-800 dark:text-green-200">{{ session('success') }}</span>
                        </div>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 animate-slide-down">
                    <div class="border-red-200 bg-red-50 dark:bg-red-950 dark:border-red-800 p-4 rounded-lg border">
                        <div class="flex items-center">
                            <svg class="h-4 w-4 text-red-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="text-red-800 dark:text-red-200">{{ session('error') }}</span>
                        </div>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 stagger-animation">
                {{-- Gestion des cotisations et dépenses --}}
                <div class="animate-fade-in-up" style="animation-delay: 0.1s">
                    <div class="h-full bg-white/60 dark:bg-slate-800/60 backdrop-blur-sm border-slate-200 dark:border-slate-700 hover:shadow-xl transition-all duration-300 rounded-lg border shadow-sm hover-scale">
                        <div class="flex flex-col space-y-1.5 p-6 pb-4">
                            <h3 class="font-semibold tracking-tight flex items-center gap-3 text-xl">
                                <div class="bg-gradient-to-r from-green-500 to-emerald-500 p-2 rounded-lg">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                    </svg>
                                </div>
                                Gestion Financière
                            </h3>
                            <p class="text-sm text-muted-foreground">
                                Gérez les cotisations et dépenses de l'organisation
                            </p>
                        </div>
                        <div class="p-6 pt-0 space-y-4">
                            {{-- Bouton Modal Nouvelle Cotisation --}}
                            <button onclick="openCotisationModal()" class="w-full inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white shadow-lg hover:shadow-xl transition-all duration-300 h-11 px-8 hover-scale">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Nouvelle Cotisation
                            </button>
                            
                            {{-- Bouton Modal Nouvelle Dépense --}}
                            <button onclick="openDepenseModal()" class="w-full inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border-2 border-purple-200 hover:border-purple-300 hover:bg-purple-50 dark:border-purple-700 dark:hover:bg-purple-900/20 transition-all duration-300 h-11 px-8 hover-scale">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Nouvelle Dépense
                            </button>

                            <div class="grid grid-cols-2 gap-3 pt-4">
                                <div class="bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-950 dark:to-blue-900 p-3 rounded-lg hover-scale">
                                    <svg class="w-5 h-5 text-blue-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                    </svg>
                                    <p class="text-xs text-blue-600 dark:text-blue-400 font-medium">Rapports</p>
                                </div>
                                <div class="bg-gradient-to-br from-green-50 to-green-100 dark:from-green-950 dark:to-green-900 p-3 rounded-lg hover-scale">
                                    <svg class="w-5 h-5 text-green-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    <p class="text-xs text-green-600 dark:text-green-400 font-medium">Historique</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Gestion des Administrateurs --}}
                <div class="animate-fade-in-up" style="animation-delay: 0.2s">
                    <div class="h-full bg-white/60 dark:bg-slate-800/60 backdrop-blur-sm border-slate-200 dark:border-slate-700 hover:shadow-xl transition-all duration-300 rounded-lg border shadow-sm hover-scale">
                        <div class="flex flex-col space-y-1.5 p-6 pb-4">
                            <h3 class="font-semibold tracking-tight flex items-center gap-3 text-xl">
                                <div class="bg-gradient-to-r from-purple-500 to-indigo-500 p-2 rounded-lg">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                                    </svg>
                                </div>
                                Gestion des Administrateurs
                            </h3>
                            <p class="text-sm text-muted-foreground">
                                Promouvoir un utilisateur au rôle d'administrateur
                            </p>
                        </div>
                        <div class="p-6 pt-0 space-y-6">
                            <form action="{{ route('admin.promote') }}" method="POST" id="promoteForm">
                                @csrf
                                @method('POST')
                                <div class="space-y-4">
                                    <div>
                                        <label class="text-sm font-medium text-slate-700 dark:text-slate-300 mb-2 block">
                                            Sélectionner un utilisateur
                                        </label>
                                        <select name="email" class="flex h-10 items-center justify-between rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 w-full hover:cursor-pointer" required>
                                            <option value="">-- Sélectionnez un utilisateur --</option>
                                            @foreach($users as $user)
                                                @if($user->email !== 'admin@admin.com')
                                                    <option value="{{ $user->email }}">
                                                        @if(in_array($user->email, $adminEmails)) ✅ @endif{{ $user->email }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                                            L'utilisateur doit déjà avoir un compte sur la plateforme
                                        </p>
                                    </div>

                                    <button type="submit" class="w-full inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white shadow-lg hover:shadow-xl transition-all duration-300 h-11 px-8 hover-scale">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                                        </svg>
                                        Promouvoir en Administrateur
                                    </button>
                                    
                                    <p class="text-xs text-center text-slate-500 dark:text-slate-400">
                                        Cette action nécessite une confirmation
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Liste des cotisations --}}
                <div class="lg:col-span-2 animate-fade-in-up" style="animation-delay: 0.3s">
                    <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-sm border-slate-200 dark:border-slate-700 hover:shadow-xl transition-all duration-300 rounded-lg border shadow-sm hover-scale">
                        <div class="flex flex-col space-y-1.5 p-6">
                            <h3 class="font-semibold tracking-tight flex items-center gap-3 text-xl">
                                <div class="bg-gradient-to-r from-green-500 to-emerald-500 p-2 rounded-lg">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293H15M6 10a2 2 0 00-2 2v6a2 2 0 002 2h12a2 2 0 002-2v-6a2 2 0 00-2-2"/>
                                    </svg>
                                </div>
                                Cotisations créées
                            </h3>
                            <p class="text-sm text-muted-foreground">
                                Historique des cotisations avec les informations de création
                            </p>
                        </div>
                        <div class="p-6 pt-0">
                            @if(isset($cotisations) && count($cotisations) > 0)
                                <div class="space-y-4">
                                    @foreach($cotisations as $index => $cotisation)
                                        <div class="bg-gradient-to-r from-slate-50 to-slate-100 dark:from-slate-700 dark:to-slate-800 p-4 rounded-lg border border-slate-200 dark:border-slate-600 hover:shadow-md transition-all duration-300 animate-fade-in-up hover-scale" style="animation-delay: {{ 0.1 * $index }}s">
                                            <div class="flex items-start justify-between">
                                                <div class="flex-1">
                                                    <div class="flex items-center gap-3 mb-2">
                                                        <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-1.5 rounded">
                                                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293H15M6 10a2 2 0 00-2 2v6a2 2 0 002 2h12a2 2 0 002-2v-6a2 2 0 00-2-2"/>
                                                            </svg>
                                                        </div>
                                                        <h3 class="font-semibold text-slate-800 dark:text-slate-200">
                                                            {{ number_format($cotisation->montant, 2) }} €
                                                        </h3>
                                                        <span class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold
                                                            @if($cotisation->type === 'mensuelle') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                                                            @elseif($cotisation->type === 'trimestrielle') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                                            @elseif($cotisation->type === 'annuelle') bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200
                                                            @else bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200
                                                            @endif">
                                                            {{ ucfirst($cotisation->type) }}
                                                        </span>
                                                    </div>
                                                    <p class="text-sm text-slate-600 dark:text-slate-400 mb-3">
                                                        {{ $cotisation->description }}
                                                    </p>
                                                    <div class="flex items-center gap-4 text-xs text-slate-500 dark:text-slate-400">
                                                        <div class="flex items-center gap-1">
                                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                            </svg>
                                                            Date: {{ \Carbon\Carbon::parse($cotisation->date)->format('d/m/Y') }}
                                                        </div>
                                                        <div class="flex items-center gap-1">
                                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                                                            </svg>
                                                            Créée par: {{ $cotisation->created_by }}
                                                        </div>
                                                        <div class="flex items-center gap-1">
                                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                            </svg>
                                                            Le: {{ \Carbon\Carbon::parse($cotisation->created_at)->format('d/m/Y') }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-8 text-slate-500 dark:text-slate-400">
                                    <svg class="w-12 h-12 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293H15M6 10a2 2 0 00-2 2v6a2 2 0 002 2h12a2 2 0 002-2v-6a2 2 0 00-2-2"/>
                                    </svg>
                                    <p>Aucune cotisation créée pour le moment</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Administrateurs actuels --}}
                <div class="lg:col-span-2 animate-fade-in-up" style="animation-delay: 0.4s">
                    <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-sm border-slate-200 dark:border-slate-700 hover:shadow-xl transition-all duration-300 rounded-lg border shadow-sm hover-scale">
                        <div class="flex flex-col space-y-1.5 p-6">
                            <h3 class="font-semibold tracking-tight flex items-center gap-3 text-xl">
                                <div class="bg-gradient-to-r from-orange-500 to-red-500 p-2 rounded-lg">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    </svg>
                                </div>
                                Administrateurs actuels
                            </h3>
                            @if(isset($adminUsers) && count($adminUsers) > 0)
                                <p class="text-sm text-muted-foreground">
                                    Liste des utilisateurs ayant des privilèges administrateur :
                                </p>
                            @else
                                <p class="text-sm text-muted-foreground">
                                    Aucun utilisateur avec des privilèges administrateur pour le moment.
                                </p>
                            @endif
                        </div>
                        <div class="p-6 pt-0">
                            @if(isset($adminUsers) && count($adminUsers) > 0)
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                                    @foreach($adminUsers as $index => $admin)
                                        <div class="bg-gradient-to-br from-slate-50 to-slate-100 dark:from-slate-700 dark:to-slate-800 p-4 rounded-lg border border-slate-200 dark:border-slate-600 animate-fade-in-up hover-scale" style="animation-delay: {{ 0.1 * $index }}s">
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center gap-3">
                                                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                    <span class="font-medium text-slate-700 dark:text-slate-200">
                                                        {{ $admin->email }}
                                                    </span>
                                                </div>
                                                @if($admin->email !== 'admin@admin.com')
                                                    <form action="{{ route('admin.remove') }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="email" value="{{ $admin->email }}">
                                                        <button type="submit" class="text-red-500 hover:text-red-700 transition-colors hover-scale">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            <div class="bg-gradient-to-r from-blue-50 to-purple-50 dark:from-blue-950 dark:to-purple-950 p-6 rounded-lg border border-blue-200 dark:border-blue-800">
                                <h4 class="font-semibold text-slate-800 dark:text-slate-200 mb-3 flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    Privilèges Administrateur :
                                </h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                    <div class="flex items-center gap-2 text-sm text-slate-600 dark:text-slate-400">
                                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                        </svg>
                                        Gestion des cotisations et dépenses
                                    </div>
                                    <div class="flex items-center gap-2 text-sm text-slate-600 dark:text-slate-400">
                                        <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                                        </svg>
                                        Accès aux rapports financiers
                                    </div>
                                    <div class="flex items-center gap-2 text-sm text-slate-600 dark:text-slate-400">
                                        <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                                        </svg>
                                        Validation des comptes utilisateurs
                                    </div>
                                    <div class="flex items-center gap-2 text-sm text-slate-600 dark:text-slate-400">
                                        <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        Configuration des paramètres système
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Nouvelle Cotisation --}}
    <div id="cotisationModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm">
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow-xl w-full max-w-md mx-4 transform transition-all duration-300 scale-95 opacity-0" id="cotisationModalContent">
            <div class="p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-2 rounded-lg">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293H15M6 10a2 2 0 00-2 2v6a2 2 0 002 2h12a2 2 0 002-2v-6a2 2 0 00-2-2"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-200">Nouvelle Cotisation</h3>
                        <p class="text-sm text-slate-600 dark:text-slate-400">Créer une nouvelle cotisation pour l'organisation</p>
                    </div>
                    <button onclick="closeCotisationModal()" class="ml-auto text-slate-400 hover:text-slate-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <form action="/cotisations/create" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="cotisation_montant" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                                Montant (€) *
                            </label>
                            <input 
                                type="number" 
                                step="0.01" 
                                min="0" 
                                name="montant" 
                                id="cotisation_montant" 
                                placeholder="0.00"
                                class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-slate-700 dark:text-slate-200"
                                required
                            >
                        </div>
                        <div>
                            <label for="cotisation_date" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                                Date *
                            </label>
                            <input 
                                type="date" 
                                name="date" 
                                id="cotisation_date"
                                class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-slate-700 dark:text-slate-200"
                                required
                            >
                        </div>
                    </div>
                    
                    <div>
                        <label for="cotisation_type" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                            Type de cotisation
                        </label>
                        <select 
                            name="type" 
                            id="cotisation_type"
                            class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-slate-700 dark:text-slate-200"
                        >
                            <option value="mensuelle">📅 Mensuelle</option>
                            <option value="trimestrielle">📊 Trimestrielle</option>
                            <option value="annuelle">🗓️ Annuelle</option>
                            <option value="exceptionnelle">⭐ Exceptionnelle</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="cotisation_description" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                            Description *
                        </label>
                        <textarea 
                            name="description" 
                            id="cotisation_description" 
                            rows="3"
                            placeholder="Description de la cotisation..."
                            class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-slate-700 dark:text-slate-200"
                            required
                        ></textarea>
                    </div>
                    
                    <div class="flex justify-end space-x-3 pt-4">
                        <button 
                            type="button" 
                            onclick="closeCotisationModal()"
                            class="px-4 py-2 text-sm font-medium text-slate-600 bg-slate-100 hover:bg-slate-200 dark:bg-slate-700 dark:text-slate-300 dark:hover:bg-slate-600 rounded-md transition-colors"
                        >
                            Annuler
                        </button>
                        <button 
                            type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 rounded-md transition-all duration-300 shadow-lg hover:shadow-xl"
                        >
                            Créer la cotisation
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Nouvelle Dépense --}}
    <div id="depenseModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm">
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow-xl w-full max-w-lg mx-4 transform transition-all duration-300 scale-95 opacity-0" id="depenseModalContent">
            <div class="p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="bg-gradient-to-r from-red-500 to-orange-500 p-2 rounded-lg">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-200">Nouvelle Dépense</h3>
                        <p class="text-sm text-slate-600 dark:text-slate-400">Enregistrer une nouvelle dépense de l'organisation</p>
                    </div>
                    <button onclick="closeDepenseModal()" class="ml-auto text-slate-400 hover:text-slate-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <form action="/depenses/create" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="depense_montant" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                                Montant (€) *
                            </label>
                            <input 
                                type="number" 
                                step="0.01" 
                                min="0" 
                                name="montant" 
                                id="depense_montant" 
                                placeholder="0.00"
                                class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 dark:bg-slate-700 dark:text-slate-200"
                                required
                            >
                        </div>
                        <div>
                            <label for="depense_date" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                                Date *
                            </label>
                            <input 
                                type="date" 
                                name="date" 
                                id="depense_date"
                                class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 dark:bg-slate-700 dark:text-slate-200"
                                required
                            >
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="depense_categorie" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                                Catégorie *
                            </label>
                            <select 
                                name="categorie" 
                                id="depense_categorie"
                                class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 dark:bg-slate-700 dark:text-slate-200"
                                required
                            >
                                <option value="">Sélectionnez une catégorie</option>
                                <option value="bureau">🏢 Fournitures de bureau</option>
                                <option value="equipement">💻 Équipement</option>
                                <option value="transport">🚗 Transport</option>
                                <option value="communication">📱 Communication</option>
                                <option value="formation">📚 Formation</option>
                                <option value="marketing">📢 Marketing</option>
                                <option value="maintenance">🔧 Maintenance</option>
                                <option value="autre">📦 Autre</option>
                            </select>
                        </div>

                        <div>
                            <label for="depense_fournisseur" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                                Fournisseur
                            </label>
                            <input 
                                type="text" 
                                name="fournisseur" 
                                id="depense_fournisseur"
                                placeholder="Nom du fournisseur"
                                class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 dark:bg-slate-700 dark:text-slate-200"
                            >
                        </div>
                    </div>
                    
                    <div>
                        <label for="depense_description" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                            Description *
                        </label>
                        <textarea 
                            name="description" 
                            id="depense_description" 
                            rows="3"
                            placeholder="Description de la dépense..."
                            class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 dark:bg-slate-700 dark:text-slate-200"
                            required
                        ></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="depense_methode_paiement" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                                Méthode de paiement
                            </label>
                            <select 
                                name="methode_paiement" 
                                id="depense_methode_paiement"
                                class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 dark:bg-slate-700 dark:text-slate-200"
                            >
                                <option value="especes">💵 Espèces</option>
                                <option value="carte">💳 Carte bancaire</option>
                                <option value="virement">🏦 Virement</option>
                                <option value="cheque">📄 Chèque</option>
                                <option value="autre">🔄 Autre</option>
                            </select>
                        </div>

                        <div>
                            <label for="depense_statut" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                                Statut
                            </label>
                            <select 
                                name="statut" 
                                id="depense_statut"
                                class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 dark:bg-slate-700 dark:text-slate-200"
                            >
                                <option value="paye">✅ Payé</option>
                                <option value="en_attente">⏳ En attente</option>
                                <option value="annule">❌ Annulé</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="depense_justificatif" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                            Justificatif (optionnel)
                        </label>
                        <input 
                            type="file" 
                            name="justificatif" 
                            id="depense_justificatif"
                            accept=".pdf,.jpg,.jpeg,.png,.doc,.docx"
                            class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 dark:bg-slate-700 dark:text-slate-200"
                        >
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                            PDF, JPG, PNG, DOC (Max: 10MB)
                        </p>
                    </div>
                    
                    <div class="flex justify-end space-x-3 pt-4">
                        <button 
                            type="button" 
                            onclick="closeDepenseModal()"
                            class="px-4 py-2 text-sm font-medium text-slate-600 bg-slate-100 hover:bg-slate-200 dark:bg-slate-700 dark:text-slate-300 dark:hover:bg-slate-600 rounded-md transition-colors"
                        >
                            Annuler
                        </button>
                        <button 
                            type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-red-500 to-orange-500 hover:from-red-600 hover:to-orange-600 rounded-md transition-all duration-300 shadow-lg hover:shadow-xl"
                        >
                            Enregistrer la dépense
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- CSS Styles --}}
    <style>
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideDown {
            from { 
                opacity: 0; 
                transform: translateY(-20px); 
            }
            to { 
                opacity: 1; 
                transform: translateY(0); 
            }
        }

        @keyframes fadeInUp {
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
            animation: fadeIn 0.6s ease-out;
        }

        .animate-slide-down {
            animation: slideDown 0.5s ease-out;
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.5s ease-out forwards;
            opacity: 0;
        }

        .hover-scale {
            transition: transform 0.2s ease-out;
        }

        .hover-scale:hover {
            transform: scale(1.02);
        }

        .stagger-animation > * {
            animation-fill-mode: forwards;
        }

        #cotisationModal.show, #depenseModal.show {
            display: flex !important;
        }

        #cotisationModal.show #cotisationModalContent,
        #depenseModal.show #depenseModalContent {
            transform: scale(1);
            opacity: 1;
        }
    </style>

    {{-- JavaScript --}}
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Form submission confirmation
        const promoteForm = document.getElementById('promoteForm');
        if (promoteForm) {
            promoteForm.addEventListener('submit', function(e) {
                const userEmail = this.querySelector('select[name="email"]').value;
                if (!userEmail) {
                    e.preventDefault();
                    alert('Veuillez sélectionner un utilisateur');
                    return false;
                }
                
                if (!confirm(`Êtes-vous sûr de vouloir promouvoir ${userEmail} au rôle d'administrateur ?`)) {
                    e.preventDefault();
                    return false;
                }
            });
        }
    });

    // Fonctions pour le modal de cotisation
    function openCotisationModal() {
        const modal = document.getElementById('cotisationModal');
        modal.style.display = 'flex';
        setTimeout(() => {
            modal.classList.add('show');
        }, 10);
    }

    function closeCotisationModal() {
        const modal = document.getElementById('cotisationModal');
        modal.classList.remove('show');
        setTimeout(() => {
            modal.style.display = 'none';
        }, 300);
    }

    // Fonctions pour le modal de dépense
    function openDepenseModal() {
        const modal = document.getElementById('depenseModal');
        modal.style.display = 'flex';
        setTimeout(() => {
            modal.classList.add('show');
        }, 10);
    }

    function closeDepenseModal() {
        const modal = document.getElementById('depenseModal');
        modal.classList.remove('show');
        setTimeout(() => {
            modal.style.display = 'none';
        }, 300);
    }

    // Fermer les modals en cliquant à l'extérieur
    document.getElementById('cotisationModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeCotisationModal();
        }
    });

    document.getElementById('depenseModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeDepenseModal();
        }
    });

    // Fermer les modals avec la touche Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeCotisationModal();
            closeDepenseModal();
        }
    });

    function confirmRemoval(email) {
        return confirm(`Êtes-vous sûr de vouloir retirer ${email} du rôle d'administrateur ?`);
    }

    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        const alerts = document.querySelectorAll('.animate-slide-down');
        alerts.forEach(alert => {
            alert.style.transition = 'opacity 0.5s ease-out';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        });
    }, 5000);
    </script>
@endsection