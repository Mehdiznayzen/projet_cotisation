@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'bg-green-50 border border-green-200 rounded-xl p-4']) }}>
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-green-800">{{ $status }}</p>
            </div>
        </div>
    </div>
@endif