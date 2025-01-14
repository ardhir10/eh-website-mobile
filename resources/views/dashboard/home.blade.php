@extends('dashboard.layouts.app')

@section('content')
<div class="tw-grid tw-grid-cols-1 lg:tw-grid-cols-12 tw-gap-6">
    <!-- Left Section - Shipment Details -->
    <div class="lg:tw-col-span-12">  
        <!-- Map Card -->
        <div 
            class="tw-bg-cover tw-bg-center tw-rounded-xl tw-p-6 tw-shadow-sm tw-mb-6"
            style="background-image: url('{{ asset('assets/images/hero.gif') }}');"
        >
            <!-- Map Controls -->
            <div class="tw-flex tw-flex-wrap tw-items-center tw-gap-4 tw-mb-6">
                <div class="tw-flex tw-gap-2">
                    <button class="tw-px-3 tw-py-0.5 tw-bg-red-500 tw-text-white tw-rounded-lg">Tracking</button>
                    <button class="tw-px-3 tw-py-0.5 tw-text-red-500 tw-bg-transparent tw-border tw-border-red-500 hover:tw-bg-red-500 hover:tw-text-white tw-transition-all tw-duration-300 tw-rounded-lg">Traffic jams</button>
                    <button class="tw-px-3 tw-py-0.5 tw-text-red-500 tw-bg-transparent tw-border tw-border-red-500 hover:tw-bg-red-500 hover:tw-text-white tw-transition-all tw-duration-300 tw-rounded-lg">POI</button>
                </div>
            </div>

            <!-- Stats -->
            <div class="tw-grid tw-grid-cols-1 tw-gap-8">
                <div class="tw-bg-gray-100 tw-w-fit tw-rounded-xl tw-px-4 tw-py-2 tw-shadow-sm">
                    <span class="tw-text-gray-600 tw-text-sm">Distance to arrival</span>
                    <div class="tw-text-red-500">
                        <span class="tw-text-2xl tw-font-medium">120</span>
                        <span class="tw-text-sm">km</span>
                        <span class="tw-mx-2">/</span>
                        <span class="tw-text-2xl tw-font-medium">1h</span>
                        <span class="tw-text-sm">50</span>
                        <span class="tw-text-sm">min</span>
                    </div>
                </div>
                <div class="tw-bg-gray-100 tw-w-fit tw-rounded-xl tw-px-4 tw-py-2 tw-shadow-sm">
                    <span class="tw-text-gray-600 tw-text-sm">Traffic and route optimization</span>
                    <div class="tw-flex tw-flex-col tw-gap-2">
                        <div class="tw-flex tw-justify-between tw-items-center tw-gap-2">
                            <div class="tw-flex tw-items-end">
                                <span class="tw-text-4xl tw-leading-none tw-font-medium tw-text-red-500">85</span>
                                <span class="tw-text-red-500">%</span>
                            </div>
                            
                            <div class="tw-relative tw-flex-1">
                                <div class="tw-bg-gray-500 tw-rounded-full tw-h-0.5 tw-w-full">
                                    <div 
                                        class="tw-bg-red-500 tw-h-0.5 tw-rounded-full" 
                                        style="width: 85%"
                                    ></div>
                                </div>
                            </div>
                        </div>
                        <div class="tw-flex tw-gap-2 tw-mt-2">
                            <button class="tw-px-3 tw-py-1 tw-bg-red-500 tw-text-white tw-rounded-md tw-text-sm">Optimize</button>
                            <button class="tw-px-3 tw-py-1 tw-border tw-border-gray-200 tw-rounded-md tw-text-sm">View all</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Map Area -->
            {{-- <img src="{{ asset('assets/images/hero.gif') }}" alt="Map" class="tw-w-full tw-h-64 tw-object-cover tw-rounded-lg"> --}}
        </div>
    </div>

    <div class="lg:tw-col-span-8">
        <!-- Shipment Details -->
        <div class="tw-bg-white tw-rounded-xl tw-p-6 tw-shadow-sm">
            <div class="tw-flex tw-justify-between tw-items-center tw-mb-6">
                <div class="tw-flex tw-items-center tw-gap-4">
                    <h2 class="tw-text-lg tw-font-medium">Shipment details</h2>
                </div>
                <a href="#" class="tw-text-sm tw-underline tw-underline-offset-4">Read more</a>
            </div>

            <!-- Driver Info -->
            <div class="tw-flex tw-items-center tw-gap-2 tw-mb-6">
                <img 
                    src="{{ asset('assets/images/avatars/3.gif') }}" 
                    alt="Driver" 
                    class="tw-object-cover tw-size-10 tw-rounded-full tw-bg-gray-200"
                >
                <div>
                    <p class="tw-font-medium">Alexander Ling</p>
                    <p class="tw-text-sm tw-text-gray-500">ID#UA12/RB8255/048 - Ukraine</p>
                </div>
                <div class="tw-ml-auto tw-flex tw-items-center">
                    <span class="tw-text-sm tw-mr-2">Rating</span>
                    <span class="tw-bg-red-500 tw-text-white tw-rounded-full tw-px-2 tw-py-0.5 tw-text-xs">4.8</span>
                </div>
            </div>

            <!-- Shipment Info Grid -->
            <div class="tw-grid tw-grid-cols-3 tw-border-2 tw-divide-x-2 tw-border-gray-200 [&>div]:tw-px-4 [&>div]:tw-py-2 tw-rounded-xl">
                <div class="tw-flex tw-flex-col tw-justify-between">
                    <div class="tw-flex tw-flex-col">
                        <h3>Novaposhta parcels</h3>
                        <p class="tw-text-red-500">Have been paid</p>
                    </div>
                    <p class="tw-text-3xl tw-text-red-500 tw-font-medium tw-mt-2">$ 520.45</p>
                </div>
                <div class="tw-w-4/5 tw-flex tw-flex-col tw-justify-between">
                    <h3>Parcels Loading</h3>
                    <div class="tw-flex tw-justify-between tw-items-center tw-gap-4 tw-mt-2">
                        <span>Kyiv</span>
                        <span>Rivne</span>
                    </div>
                    <div class="tw-bg-gray-500 tw-h-0.5 tw-rounded-full tw-mt-2">
                        <div class="tw-bg-red-500 tw-h-0.5 tw-rounded-full" style="width: 60%"></div>
                    </div>
                    <h3 class="tw-mt-10">Date of arrival</h3>
                    <p class="tw-text-3xl tw-text-red-500">28.10.23</p>
                </div>
                <div class="tw-flex tw-flex-col tw-justify-between">
                    <div class="tw-flex tw-flex-col tw-justify-between">
                        <h3>Status</h3>
                        <span class="tw-w-fit tw-bg-red-500 tw-text-white tw-px-3 tw-py-1 tw-rounded-full tw-text-sm tw-mt-2 tw-inline-block">Delivered</span>
                    </div>
                    <div class="tw-flex tw-flex-col tw-justify-between">
                        <h3>Type of Parcels</h3>
                        <span class="tw-w-fit tw-bg-red-500 tw-text-white tw-px-3 tw-py-1 tw-rounded-full tw-text-sm tw-mt-2 tw-inline-block">Household chemicals</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Section -->
    <div class="lg:tw-col-span-4 tw-space-y-6">
        <!-- Truck Capacity Card -->
        <div class="tw-bg-white tw-rounded-xl tw-p-6 tw-shadow-sm">
            <div class="tw-flex tw-justify-between tw-items-center tw-mb-6">
                <div class="tw-flex tw-items-center tw-gap-4">
                    <h2 class="tw-text-lg tw-font-medium">Current truck capacity</h2>
                </div>
                <a href="#" class="tw-text-sm tw-underline tw-underline-offset-4">Read more</a>
            </div>
            <div class="tw-flex tw-justify-center tw-mb-6">
                <img 
                    src="{{ asset('assets/images/avatars/2.gif') }}" 
                    alt="Truck" 
                    class="tw-w-full tw-h-32 tw-object-cover tw-rounded-lg"
                >
            </div>
            <div class="tw-grid tw-grid-cols-2 tw-gap-6">
                <div>
                    <h3 class="tw-text-sm tw-text-gray-500">Truck ID</h3>
                    <p class="tw-mt-2">AL - 223965406</p>
                </div>
                <div>
                    <h3 class="tw-text-sm tw-text-gray-500">Status</h3>
                    <p class="tw-text-red-500 tw-mt-2">On-Route</p>
                </div>
                <div>
                    <h3 class="tw-text-sm tw-text-gray-500">Max Load</h3>
                    <p class="tw-mt-2">8,453 KG</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bottom Section -->
<div class="tw-grid tw-grid-cols-1 lg:tw-grid-cols-3 tw-gap-6 tw-mt-6">
    <!-- Shipment Trends -->
    <div class="tw-bg-white tw-rounded-xl tw-p-6 tw-shadow-sm">
        <h3 class="tw-font-medium tw-mb-4">Shipment trends</h3>
        <!-- Add chart here -->
    </div>

    <!-- Route Efficiency -->
    <div class="tw-bg-red-500 tw-rounded-xl tw-p-6 tw-text-white">
        <div class="tw-flex tw-justify-between tw-items-center">
            <div>
                <h3 class="tw-font-medium tw-mb-2">Route efficiency</h3>
                <p class="tw-text-4xl tw-font-medium">96<span class="tw-text-xl">%</span></p>
            </div>
            <button class="tw-text-sm tw-underline">Send the best route to the driver's email</button>
        </div>
    </div>

    <!-- Chat Section -->
    <div class="tw-bg-white tw-rounded-xl tw-p-6 tw-shadow-sm">
        <h3 class="tw-font-medium tw-mb-4">Chat</h3>
        <!-- Add chat interface here -->
    </div>
</div>
@endsection

