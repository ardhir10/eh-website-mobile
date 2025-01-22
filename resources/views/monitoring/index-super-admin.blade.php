@extends('monitoring.partials.app')

@section('content')
    <div class="flex flex-col gap-4 w-full">
        <div class="flex flex-col gap-1">
            <h1 class="mt-2 text-xl font-semibold text-gray-900">Company Monitoring Overview</h1>
            <p class="mt-0.5 text-xs text-gray-600">Select a company to view detailed monitoring</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($company as $comp)
                <a href="{{ route('monitoring.show', $comp->id) }}" class="block">
                    <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-16 h-16 rounded-full overflow-hidden bg-gray-100 flex items-center justify-center">
                                @if($comp->company_logo)
                                    <img src="{{ Storage::url($comp->company_logo) }}" 
                                         alt="{{ $comp->company_name }}" 
                                         class="w-full h-full object-cover">
                                @else
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                @endif
                            </div>
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-700">{{ $comp->company_name }}</h3>
                                <p class="text-sm text-gray-500">{{ $comp->company_email }}</p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-100">
                            <div class="text-sm text-gray-600">
                                <span class="font-semibold">Sites:</span> 
                                <span class="text-gray-700">{{ $comp->sitesActive->count() ?? 0 }}</span>
                            </div>
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
