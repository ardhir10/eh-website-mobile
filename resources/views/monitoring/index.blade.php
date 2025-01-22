@extends('monitoring.partials.app')

@section('content')
    <div class="flex flex-col gap-4 w-full ">
        <div class="flex flex-col gap-1">
            <h1 class="mt-2 text-xl font-semibold text-gray-900">Water Quality Monitoring</h1>
            <p class="mt-0.5 text-xs text-gray-600">Real-time monitoring of water quality parameters</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Temperature Card -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-700">Temperature</h3>
                    <div class="p-2 bg-blue-100 rounded-full">
                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                </div>
                <div class="text-3xl font-bold text-gray-900">25°C</div>
                <div class="text-sm text-gray-500 mt-2">Last updated: 5 mins ago</div>
            </div>

            <!-- pH Level Card -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-700">pH Level</h3>
                    <div class="p-2 bg-green-100 rounded-full">
                        <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                </div>
                <div class="text-3xl font-bold text-gray-900">7.2</div>
                <div class="text-sm text-gray-500 mt-2">Optimal range: 6.5 - 7.5</div>
            </div>

            <!-- Turbidity Card -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-700">Turbidity</h3>
                    <div class="p-2 bg-purple-100 rounded-full">
                        <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                        </svg>
                    </div>
                </div>
                <div class="text-3xl font-bold text-gray-900">2.4 NTU</div>
                <div class="text-sm text-gray-500 mt-2">Clear water condition</div>
            </div>
        </div>
    </div>
@endsection
