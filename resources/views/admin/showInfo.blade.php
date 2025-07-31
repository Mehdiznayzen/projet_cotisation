@extends('layouts.adminlayout')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-indigo-50 via-purple-50 to-teal-50 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900">
    <div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-700 sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center justify-center w-10 h-10 rounded-lg bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm border border-slate-200 dark:border-slate-700 hover:bg-white dark:hover:bg-slate-800 transition-all duration-300 hover-scale">
                    <svg class="w-5 h-5 text-slate-600 dark:text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                </a>
                <div>
                    <h1 class="text-2xl font-bold bg-gradient-to-r from-indigo-600 via-purple-600 to-teal-600 bg-clip-text text-transparent">
                        Tableau de bord
                    </h1>
                    <p class="text-slate-600 dark:text-slate-400 text-sm">
                        Cotisations, dépenses et solde de l'organisation
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-6 py-8">
        @if(session('success'))
            <div class="mb-6 animate-slide-down">
                <div class="border-green-200 bg-green-50 dark:bg-green-950 dark:border-green-800 p-4 rounded-lg border">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-green-800 dark:text-green-200 font-medium">{{ session('success') }}</span>
                    </div>
                </div>
            </div>
        @endif

        {{-- Filtres par date --}}
        <div class="mb-6 animate-fade-in">
            <div class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-sm rounded-xl shadow-lg border border-slate-200 dark:border-slate-700 p-4">
                <div class="flex flex-col md:flex-row gap-4 items-center">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.707A1 1 0 013 7V4z"/>
                        </svg>
                        <span class="font-medium text-slate-700 dark:text-slate-300">Filtrer par période :</span>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-3 flex-1">
                        <div class="flex items-center gap-2">
                            <label for="date_debut" class="text-sm text-slate-600 dark:text-slate-400">Du :</label>
                            <input 
                                type="date" 
                                id="date_debut" 
                                class="px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-slate-700 dark:text-slate-200"
                            >
                        </div>
                        <div class="flex items-center gap-2">
                            <label for="date_fin" class="text-sm text-slate-600 dark:text-slate-400">Au :</label>
                            <input 
                                type="date" 
                                id="date_fin" 
                                class="px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-slate-700 dark:text-slate-200"
                            >
                        </div>
                        <div class="flex gap-2">
                            <button 
                                onclick="applyDateFilter()" 
                                class="px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white text-sm font-medium rounded-md transition-colors"
                            >
                                Filtrer
                            </button>
                            <button 
                                onclick="clearDateFilter()" 
                                class="px-4 py-2 bg-slate-500 hover:bg-slate-600 text-white text-sm font-medium rounded-md transition-colors"
                            >
                                Effacer
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Solde actuel --}}
        <div class="mb-8 animate-fade-in">
            @php
                $totalCotisations = $cotisations->sum('montant') ?? 0;
                $totalDepenses = $depenses->sum('montant') ?? 0;
                $solde = $totalCotisations - $totalDepenses;
            @endphp
            
            <div class="bg-gradient-to-r from-indigo-500 via-purple-500 to-teal-500 rounded-2xl p-8 text-white shadow-2xl">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    {{-- Solde principal --}}
                    <div class="md:col-span-2 text-center">
                        <h2 class="text-sm font-medium text-indigo-100 mb-2">SOLDE ACTUEL</h2>
                        <div class="solde-principal text-4xl md:text-5xl font-bold mb-2 {{ $solde >= 0 ? 'text-green-300' : 'text-red-300' }}">
                            {{ number_format($solde, 2, ',', ' ') }} €
                        </div>
                        <div class="flex items-center justify-center gap-2 text-sm text-indigo-100">
                            @if($solde >= 0)
                                <svg class="w-4 h-4 text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                                </svg>
                                Solde positif
                            @else
                                <svg class="w-4 h-4 text-red-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"/>
                                </svg>
                                Solde négatif
                            @endif
                        </div>
                    </div>

                    {{-- Total cotisations --}}
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 text-center">
                        <div class="flex items-center justify-center gap-2 mb-2">
                            <svg class="w-5 h-5 text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            <span class="text-xs font-medium text-green-200">COTISATIONS</span>
                        </div>
                        <div class="total-cotisations text-2xl font-bold text-green-300">
                            {{ number_format($totalCotisations, 2, ',', ' ') }} €
                        </div>
                        <div class="count-cotisations text-xs text-green-100 mt-1">
                            {{ $cotisations->count() }} entrées
                        </div>
                    </div>

                    {{-- Total dépenses --}}
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 text-center">
                        <div class="flex items-center justify-center gap-2 mb-2">
                            <svg class="w-5 h-5 text-red-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                            </svg>
                            <span class="text-xs font-medium text-red-200">DÉPENSES</span>
                        </div>
                        <div class="total-depenses text-2xl font-bold text-red-300">
                            {{ number_format($totalDepenses, 2, ',', ' ') }} €
                        </div>
                        <div class="count-depenses text-xs text-red-100 mt-1">
                            {{ $depenses->count() }} entrées
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
            {{-- Section Cotisations --}}
            <div class="animate-fade-in-up" style="animation-delay: 0.1s">
                <div class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200 dark:border-slate-700 overflow-hidden">
                    {{-- Header Cotisations --}}
                    <div class="bg-gradient-to-r from-green-500 to-emerald-500 p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="bg-white/20 p-2 rounded-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold text-white">Cotisations</h3>
                                    <p class="text-green-100 text-sm">{{ $cotisations->count() }} cotisations enregistrées</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-2xl font-bold text-white">
                                    {{ number_format($totalCotisations, 0, ',', ' ') }} €
                                </div>
                                <div class="text-xs text-green-100">Total</div>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 max-h-96 overflow-y-auto">
                        @if($cotisations->count() > 0)
                            <div class="space-y-4">
                                @foreach($cotisations as $index => $cotisation)
                                    <div class="cotisation-item bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-950 dark:to-emerald-950 p-4 rounded-lg border border-green-200 dark:border-green-800 hover:shadow-md transition-all duration-300 animate-fade-in-up hover-scale" 
                                         style="animation-delay: {{ 0.1 * $index }}s"
                                         data-date="{{ $cotisation->date }}"
                                         data-montant="{{ $cotisation->montant }}">
                                        <div class="flex items-start justify-between">
                                            <div class="flex-1">
                                                <div class="flex items-center gap-3 mb-2">
                                                    <div class="bg-gradient-to-r from-green-500 to-emerald-500 p-1.5 rounded">
                                                        <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                                        </svg>
                                                    </div>
                                                    <h4 class="font-semibold text-green-800 dark:text-green-200 text-lg">
                                                        +{{ number_format($cotisation->montant, 2, ',', ' ') }} €
                                                    </h4>
                                                    <span class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                        Cotisation
                                                    </span>
                                                </div>
                                                @if($cotisation->Motif)
                                                    <p class="text-sm text-green-700 dark:text-green-300 mb-3 font-medium">
                                                        {{ $cotisation->Motif }}
                                                    </p>
                                                @endif
                                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 text-xs text-green-600 dark:text-green-400">
                                                    <div class="flex items-center gap-1">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                        </svg>
                                                        {{ \Carbon\Carbon::parse($cotisation->date)->format('d/m/Y') }}
                                                    </div>
                                                    <div class="flex items-center gap-1">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                        </svg>
                                                        {{ $cotisation->user->name ?? $cotisation->user->email }}
                                                    </div>
                                                    <div class="flex items-center gap-1">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                        </svg>
                                                        {{ \Carbon\Carbon::parse($cotisation->created_at)->format('H:i') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8 text-green-500 dark:text-green-400">
                                <svg class="w-16 h-16 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                <p class="text-lg font-medium">Aucune cotisation</p>
                                <p class="text-sm opacity-75">Les cotisations apparaîtront ici</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Section Dépenses --}}
            <div class="animate-fade-in-up" style="animation-delay: 0.2s">
                <div class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200 dark:border-slate-700 overflow-hidden">
                    {{-- Header Dépenses --}}
                    <div class="bg-gradient-to-r from-red-500 to-orange-500 p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="bg-white/20 p-2 rounded-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold text-white">Dépenses</h3>
                                    <p class="text-red-100 text-sm">{{ $depenses->count() }} dépenses enregistrées</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-2xl font-bold text-white">
                                    {{ number_format($totalDepenses, 0, ',', ' ') }} €
                                </div>
                                <div class="text-xs text-red-100">Total</div>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 max-h-96 overflow-y-auto">
                        @if($depenses->count() > 0)
                            <div class="space-y-4">
                                @foreach($depenses as $index => $depense)
                                    <div class="depense-item bg-gradient-to-r from-red-50 to-orange-50 dark:from-red-950 dark:to-orange-950 p-4 rounded-lg border border-red-200 dark:border-red-800 hover:shadow-md transition-all duration-300 animate-fade-in-up hover-scale" 
                                         style="animation-delay: {{ 0.1 * $index }}s"
                                         data-date="{{ $depense->date }}"
                                         data-montant="{{ $depense->montant }}">
                                        <div class="flex items-start justify-between">
                                            <div class="flex-1">
                                                <div class="flex items-center gap-3 mb-2">
                                                    <div class="bg-gradient-to-r from-red-500 to-orange-500 p-1.5 rounded">
                                                        <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                                                        </svg>
                                                    </div>
                                                    <h4 class="font-semibold text-red-800 dark:text-red-200 text-lg">
                                                        -{{ number_format($depense->montant, 2, ',', ' ') }} €
                                                    </h4>
                                                    <span class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                                        Dépense
                                                    </span>
                                                </div>
                                                <p class="text-sm text-red-700 dark:text-red-300 mb-2 font-medium">
                                                    <strong>Motif:</strong> {{ $depense->motif }}
                                                </p>
                                                @if($depense->description)
                                                    <p class="text-sm text-red-600 dark:text-red-400 mb-3">
                                                        {{ $depense->description }}
                                                    </p>
                                                @endif
                                                @if($depense->justificatif)
                                                    <div class="mb-3">
                                                        <a 
                                                            href="{{ route('admin.depenses.download', $depense->id) }}" 
                                                            class="inline-flex items-center gap-1 text-xs text-red-600 dark:text-red-400 bg-red-100 dark:bg-red-900/30 hover:bg-red-200 dark:hover:bg-red-900/50 px-2 py-1 rounded transition-colors cursor-pointer"
                                                            target="_blank"
                                                        >
                                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                            </svg>
                                                            Télécharger le justificatif
                                                        </a>
                                                    </div>
                                                @endif
                                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 text-xs text-red-600 dark:text-red-400">
                                                    <div class="flex items-center gap-1">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                        </svg>
                                                        {{ \Carbon\Carbon::parse($depense->date)->format('d/m/Y') }}
                                                    </div>
                                                    <div class="flex items-center gap-1">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                        </svg>
                                                        {{ $depense->user->name ?? $depense->user->email }}
                                                    </div>
                                                    <div class="flex items-center gap-1">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                        </svg>
                                                        {{ \Carbon\Carbon::parse($depense->created_at)->format('H:i') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8 text-red-500 dark:text-red-400">
                                <svg class="w-16 h-16 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                                </svg>
                                <p class="text-lg font-medium">Aucune dépense</p>
                                <p class="text-sm opacity-75">Les dépenses apparaîtront ici</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Statistiques --}}
        <div class="mt-8 animate-fade-in-up" style="animation-delay: 0.3s">
            <div class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200 dark:border-slate-700 p-6">
                <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-200 mb-6 flex items-center gap-2">
                    <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    Statistiques détaillées
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-gradient-to-br from-green-50 to-emerald-50 dark:from-green-950 dark:to-emerald-950 p-4 rounded-lg border border-green-200 dark:border-green-800">
                        <div class="text-center">
                            <div class="text-sm text-green-600 dark:text-green-400 mb-1">Cotisation moyenne</div>
                            <div class="avg-cotisations text-2xl font-bold text-green-700 dark:text-green-300">
                                {{ $cotisations->count() > 0 ? number_format($cotisations->avg('montant'), 2, ',', ' ') : '0,00' }} €
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-red-50 to-orange-50 dark:from-red-950 dark:to-orange-950 p-4 rounded-lg border border-red-200 dark:border-red-800">
                        <div class="text-center">
                            <div class="text-sm text-red-600 dark:text-red-400 mb-1">Dépense moyenne</div>
                            <div class="avg-depenses text-2xl font-bold text-red-700 dark:text-red-300">
                                {{ $depenses->count() > 0 ? number_format($depenses->avg('montant'), 2, ',', ' ') : '0,00' }} €
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-indigo-50 to-purple-50 dark:from-indigo-950 dark:to-purple-950 p-4 rounded-lg border border-indigo-200 dark:border-indigo-800">
                        <div class="text-center">
                            <div class="text-sm text-indigo-600 dark:text-indigo-400 mb-1">Ratio Cotisations/Dépenses</div>
                            <div class="ratio-element text-2xl font-bold text-indigo-700 dark:text-indigo-300">
                                @if($totalDepenses > 0)
                                    {{ number_format(($totalCotisations / $totalDepenses), 2, ',', ' ') }}
                                @else
                                    ∞
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

.overflow-y-auto::-webkit-scrollbar {
    width: 6px;
}

.overflow-y-auto::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 3px;
}

.overflow-y-auto::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 3px;
}

.overflow-y-auto::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}

.dark .overflow-y-auto::-webkit-scrollbar-track {
    background: #334155;
}

.dark .overflow-y-auto::-webkit-scrollbar-thumb {
    background: #64748b;
}

.dark .overflow-y-auto::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}
</style>

{{-- JavaScript --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        const alerts = document.querySelectorAll('.animate-slide-down');
        alerts.forEach(alert => {
            alert.style.transition = 'opacity 0.5s ease-out';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        });
    }, 5000);

    // Smooth scroll for long lists
    const scrollElements = document.querySelectorAll('.overflow-y-auto');
    scrollElements.forEach(element => {
        element.style.scrollBehavior = 'smooth';
    });
});

// Fonction pour appliquer le filtre par date
function applyDateFilter() {
    const dateDebut = document.getElementById('date_debut').value;
    const dateFin = document.getElementById('date_fin').value;
    
    if (!dateDebut && !dateFin) {
        alert('Veuillez sélectionner au moins une date');
        return;
    }
    
    // Filtrer les cotisations
    filterItems('.cotisation-item', dateDebut, dateFin);
    // Filtrer les dépenses
    filterItems('.depense-item', dateDebut, dateFin);
    
    // Recalculer les totaux
    updateTotals();
}

// Fonction pour effacer les filtres
function clearDateFilter() {
    document.getElementById('date_debut').value = '';
    document.getElementById('date_fin').value = '';
    
    // Afficher tous les éléments
    document.querySelectorAll('.cotisation-item, .depense-item').forEach(item => {
        item.style.display = 'block';
    });
    
    // Recalculer les totaux
    updateTotals();
}

// Fonction utilitaire pour filtrer les éléments
function filterItems(selector, dateDebut, dateFin) {
    const items = document.querySelectorAll(selector);
    
    items.forEach(item => {
        const itemDate = item.dataset.date;
        let showItem = true;
        
        if (dateDebut && itemDate < dateDebut) {
            showItem = false;
        }
        if (dateFin && itemDate > dateFin) {
            showItem = false;
        }
        
        item.style.display = showItem ? 'block' : 'none';
    });
}

// Fonction pour recalculer les totaux après filtrage
function updateTotals() {
    let totalCotisations = 0;
    let totalDepenses = 0;
    let countCotisations = 0;
    let countDepenses = 0;
    
    // Calculer les cotisations visibles
    document.querySelectorAll('.cotisation-item').forEach(item => {
        if (item.style.display !== 'none') {
            totalCotisations += parseFloat(item.dataset.montant) || 0;
            countCotisations++;
        }
    });
    
    // Calculer les dépenses visibles
    document.querySelectorAll('.depense-item').forEach(item => {
        if (item.style.display !== 'none') {
            totalDepenses += parseFloat(item.dataset.montant) || 0;
            countDepenses++;
        }
    });
    
    // Mettre à jour les totaux dans l'interface
    const solde = totalCotisations - totalDepenses;
    
    // Mettre à jour le solde principal
    const soldeElement = document.querySelector('.solde-principal');
    if (soldeElement) {
        soldeElement.textContent = new Intl.NumberFormat('fr-FR', {
            style: 'currency',
            currency: 'EUR'
        }).format(solde);
        soldeElement.className = `solde-principal text-4xl md:text-5xl font-bold mb-2 ${solde >= 0 ? 'text-green-300' : 'text-red-300'}`;
    }
    
    // Mettre à jour les totaux dans les cards
    const totalCotisationsElement = document.querySelector('.total-cotisations');
    if (totalCotisationsElement) {
        totalCotisationsElement.textContent = new Intl.NumberFormat('fr-FR', {
            style: 'currency',
            currency: 'EUR'
        }).format(totalCotisations);
    }
    
    const totalDepensesElement = document.querySelector('.total-depenses');
    if (totalDepensesElement) {
        totalDepensesElement.textContent = new Intl.NumberFormat('fr-FR', {
            style: 'currency',
            currency: 'EUR'
        }).format(totalDepenses);
    }
    
    // Mettre à jour les compteurs
    const countCotisationsElement = document.querySelector('.count-cotisations');
    if (countCotisationsElement) {
        countCotisationsElement.textContent = `${countCotisations} entrées`;
    }
    
    const countDepensesElement = document.querySelector('.count-depenses');
    if (countDepensesElement) {
        countDepensesElement.textContent = `${countDepenses} entrées`;
    }
    
    // Mettre à jour les moyennes
    const avgCotisationsElement = document.querySelector('.avg-cotisations');
    if (avgCotisationsElement && countCotisations > 0) {
        avgCotisationsElement.textContent = new Intl.NumberFormat('fr-FR', {
            style: 'currency',
            currency: 'EUR'
        }).format(totalCotisations / countCotisations);
    }
    
    const avgDepensesElement = document.querySelector('.avg-depenses');
    if (avgDepensesElement && countDepenses > 0) {
        avgDepensesElement.textContent = new Intl.NumberFormat('fr-FR', {
            style: 'currency',
            currency: 'EUR'
        }).format(totalDepenses / countDepenses);
    }
    
    // Mettre à jour le ratio
    const ratioElement = document.querySelector('.ratio-element');
    if (ratioElement) {
        if (totalDepenses > 0) {
            ratioElement.textContent = (totalCotisations / totalDepenses).toFixed(2);
        } else {
            ratioElement.textContent = '∞';
        }
    }
}
</script>
@endsection