@extends('layouts.app')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
    <!-- Left Section - Shipment Details -->
    <div class="lg:col-span-12">  
        <!-- Map Card -->
        <div 
            class="bg-cover bg-center rounded-xl p-6 shadow-sm mb-6"
            style="background-image: url('{{ asset('assets/images/hero.gif') }}');"
        >
            <!-- Map Controls -->
            <div class="flex flex-wrap items-center gap-4 mb-6">
                <div class="flex gap-2">
                    <button class="px-3 py-0.5 bg-red-500 text-white rounded-lg">Tracking</button>
                    <button class="px-3 py-0.5 text-red-500 bg-transparent border border-red-500 hover:bg-red-500 hover:text-white transition-all duration-300 rounded-lg">Traffic jams</button>
                    <button class="px-3 py-0.5 text-red-500 bg-transparent border border-red-500 hover:bg-red-500 hover:text-white transition-all duration-300 rounded-lg">POI</button>
                </div>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-1 gap-8">
                <div class="bg-gray-100 w-fit rounded-xl px-4 py-2 shadow-sm">
                    <span class="text-gray-600 text-sm">Distance to arrival</span>
                    <div class="text-red-500">
                        <span class="text-2xl font-medium">120</span>
                        <span class="text-sm">km</span>
                        <span class="mx-2">/</span>
                        <span class="text-2xl font-medium">1h</span>
                        <span class="text-sm">50</span>
                        <span class="text-sm">min</span>
                    </div>
                </div>
                <div class="bg-gray-100 w-fit rounded-xl px-4 py-2 shadow-sm">
                    <span class="text-gray-600 text-sm">Traffic and route optimization</span>
                    <div class="flex flex-col gap-2">
                        <div class="flex justify-between items-center gap-2">
                            <div class="flex items-end">
                                <span class="text-4xl leading-none font-medium text-red-500">85</span>
                                <span class="text-red-500">%</span>
                            </div>
                            
                            <div class="relative flex-1">
                                <div class="bg-gray-500 rounded-full h-0.5 w-full">
                                    <div 
                                        class="bg-red-500 h-0.5 rounded-full" 
                                        style="width: 85%"
                                    ></div>
                                </div>
                            </div>
                        </div>
                        <div class="flex gap-2 mt-2">
                            <button class="px-3 py-1 bg-red-500 text-white rounded-md text-sm">Optimize</button>
                            <button class="px-3 py-1 border border-gray-200 rounded-md text-sm">View all</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Map Area -->
            {{-- <img src="{{ asset('assets/images/hero.gif') }}" alt="Map" class="w-full h-64 object-cover rounded-lg"> --}}
        </div>
    </div>

    <div class="lg:col-span-8">
        <!-- Shipment Details -->
        <div class="bg-white rounded-xl p-6 shadow-sm">
            <div class="flex justify-between items-center mb-6">
                <div class="flex items-center gap-4">
                    <h2 class="text-lg font-medium">Shipment details</h2>
                </div>
                <a href="#" class="text-sm underline underline-offset-4">Read more</a>
            </div>

            <!-- Driver Info -->
            <div class="flex items-center gap-2 mb-6">
                <img 
                    src="{{ asset('assets/images/avatars/3.gif') }}" 
                    alt="Driver" 
                    class="object-cover size-10 rounded-full bg-gray-200"
                >
                <div>
                    <p class="font-medium">Alexander Ling</p>
                    <p class="text-sm text-gray-500">ID#UA12/RB8255/048 - Ukraine</p>
                </div>
                <div class="ml-auto flex items-center">
                    <span class="text-sm mr-2">Rating</span>
                    <span class="bg-red-500 text-white rounded-full px-2 py-0.5 text-xs">4.8</span>
                </div>
            </div>

            <!-- Shipment Info Grid -->
            <div class="grid grid-cols-3 border-2 divide-x-2 border-gray-200 [&>div]:px-4 [&>div]:py-2 rounded-xl">
                <div class="flex flex-col justify-between">
                    <div class="flex flex-col">
                        <h3>Novaposhta parcels</h3>
                        <p class="text-red-500">Have been paid</p>
                    </div>
                    <p class="text-3xl text-red-500 font-medium mt-2">$ 520.45</p>
                </div>
                <div class="w-4/5 flex flex-col justify-between">
                    <h3>Parcels Loading</h3>
                    <div class="flex justify-between items-center gap-4 mt-2">
                        <span>Kyiv</span>
                        <span>Rivne</span>
                    </div>
                    <div class="bg-gray-500 h-0.5 rounded-full mt-2">
                        <div class="bg-red-500 h-0.5 rounded-full" style="width: 60%"></div>
                    </div>
                    <h3 class="mt-10">Date of arrival</h3>
                    <p class="text-3xl text-red-500">28.10.23</p>
                </div>
                <div class="flex flex-col justify-between">
                    <div class="flex flex-col justify-between">
                        <h3>Status</h3>
                        <span class="w-fit bg-red-500 text-white px-3 py-1 rounded-full text-sm mt-2 inline-block">Delivered</span>
                    </div>
                    <div class="flex flex-col justify-between">
                        <h3>Type of Parcels</h3>
                        <span class="w-fit bg-red-500 text-white px-3 py-1 rounded-full text-sm mt-2 inline-block">Household chemicals</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Section -->
    <div class="lg:col-span-4 space-y-6">
        <!-- Truck Capacity Card -->
        <div class="bg-white rounded-xl p-6 shadow-sm">
            <div class="flex justify-between items-center mb-6">
                <div class="flex items-center gap-4">
                    <h2 class="text-lg font-medium">Current truck capacity</h2>
                </div>
                <a href="#" class="text-sm underline underline-offset-4">Read more</a>
            </div>
            <div class="flex justify-center mb-6">
                <img 
                    src="{{ asset('assets/images/avatars/2.gif') }}" 
                    alt="Truck" 
                    class="w-full h-32 object-cover rounded-lg"
                >
            </div>
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <h3 class="text-sm text-gray-500">Truck ID</h3>
                    <p class="mt-2">AL - 223965406</p>
                </div>
                <div>
                    <h3 class="text-sm text-gray-500">Status</h3>
                    <p class="text-red-500 mt-2">On-Route</p>
                </div>
                <div>
                    <h3 class="text-sm text-gray-500">Max Load</h3>
                    <p class="mt-2">8,453 KG</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bottom Section -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">
    <!-- Shipment Trends -->
    <div class="bg-white rounded-xl p-6 shadow-sm">
        <h3 class="font-medium mb-4">Shipment trends</h3>
        <!-- Add chart here -->
    </div>

    <!-- Route Efficiency -->
    <div class="bg-red-500 rounded-xl p-6 text-white">
        <div class="flex justify-between items-center">
            <div>
                <h3 class="font-medium mb-2">Route efficiency</h3>
                <p class="text-4xl font-medium">96<span class="text-xl">%</span></p>
            </div>
            <button class="text-sm underline">Send the best route to the driver's email</button>
        </div>
    </div>

    <!-- Chat Section -->
    <div class="bg-white rounded-xl p-6 shadow-sm">
        <h3 class="font-medium mb-4">Chat</h3>
        <!-- Add chat interface here -->
    </div>
</div>
@endsection

