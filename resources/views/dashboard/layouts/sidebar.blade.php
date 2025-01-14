<!-- Sidebar Toggle Button (Mobile) -->
<button id="sidebarToggle" class="md:tw-hidden tw-fixed tw-top-4 tw-right-4 tw-z-50 tw-bg-white tw-p-2 tw-rounded-lg tw-shadow-md">
    <svg class="tw-w-6 tw-h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
    </svg>
</button>

<!-- Sidebar -->
<div id="sidebar" class="max-md:tw-bg-[var(--winter-gray-1)] tw-fixed md:tw-sticky md:tw-top-0 tw-w-64 tw-bg-transparent tw-border-r tw-border-gray-100 tw-h-screen tw-min-h-screen tw-overflow-y-auto tw-transition-transform tw-duration-300 tw-ease-in-out tw-transform -tw-translate-x-full md:tw-translate-x-0 tw-z-40">
    <div class="tw-flex tw-flex-col tw-h-full">
        <!-- Profile & Company Section -->
        <div class="tw-p-4">
            <!-- Profile -->
            <div class="tw-relative" x-data="{ isOpen: false }">
                <button 
                    @click="isOpen = !isOpen"
                    class="tw-flex tw-items-center tw-gap-3 tw-mb-4 tw-w-full tw-p-1 tw-px-1.5 tw-rounded-xl tw-transition-all tw-duration-300"
                >
                    <img 
                        src="{{ asset('/assets/images/avatars/1.gif') }}" 
                        alt="Profile" 
                        class="tw-object-cover tw-aspect-square tw-size-12 tw-rounded-full tw-bg-gray-200"
                    >
                    <div class="tw-flex-1">
                        <span class="tw-block tw-text-sm tw-text-left tw-text-gray-500">Welcome</span>
                        <div class="tw-flex tw-items-center tw-gap-1">
                            <span class="tw-text-sm tw-text-gray-500">back,</span>
                            <span class="tw-text-sm tw-font-semibold">Lingga!</span>
                        </div>
                    </div>
                    <svg class="tw-w-4 tw-h-4 tw-text-gray-500 tw-transition-transform tw-duration-300" 
                         :class="{ 'tw-rotate-180': isOpen }"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div x-show="isOpen"
                     x-transition:enter="tw-transition-all tw-ease-out tw-duration-300"
                     x-transition:enter-start="tw-opacity-0 tw-max-h-0 tw-scale-95 tw-translate-y-[-10px]"
                     x-transition:enter-end="tw-opacity-100 tw-max-h-[500px] tw-scale-100 tw-translate-y-0"
                     x-transition:leave="tw-transition-all tw-ease-in tw-duration-200"
                     x-transition:leave-start="tw-opacity-100 tw-max-h-[500px] tw-scale-100 tw-translate-y-0"
                     x-transition:leave-end="tw-opacity-0 tw-max-h-0 tw-scale-95 tw-translate-y-[-10px]"
                     class="tw-absolute tw-left-0 tw-right-0 tw-mt-[-10px] tw-mb-4 tw-overflow-hidden tw-bg-white tw-rounded-xl tw-shadow-lg tw-z-50"
                >
                    <div class="tw-py-1">
                        <div class="tw-px-4 tw-py-3 tw-border-b tw-border-gray-100">
                            <p class="tw-text-sm tw-font-medium">Alexander Ling</p>
                            <p class="tw-text-sm tw-text-gray-500">lingga@example.com</p>
                        </div>
                        
                        <a 
                            href="{{ route('dashboard.profile.index') }}" 
                            data-ajax="true"
                            class="tw-flex tw-items-center tw-gap-2 tw-px-4 tw-py-2 tw-text-sm tw-text-gray-700 hover:tw-bg-gray-50"
                        >
                            <svg class="tw-w-5 tw-h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            View Profile
                        </a>
                        
                        <a 
                            href="{{ route('dashboard.settings.index') }}" 
                            data-ajax="true"
                            class="tw-flex tw-items-center tw-gap-2 tw-px-4 tw-py-2 tw-text-sm tw-text-gray-700 hover:tw-bg-gray-50"
                        >
                            <svg class="tw-w-5 tw-h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Settings
                        </a>

                        <div class="tw-border-t tw-border-gray-100 tw-my-1"></div>
                        
                        <a href="#" class="tw-flex tw-items-center tw-gap-2 tw-px-4 tw-py-2 tw-text-sm tw-text-red-600 hover:tw-bg-gray-50">
                            <svg class="tw-w-5 tw-h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            Sign Out
                        </a>
                    </div>
                </div>
            </div>

            <!-- Company -->
            <div class="tw-relative" x-data="{ isOpen: false }">
                <button 
                    @click="isOpen = !isOpen"
                    class="tw-w-full tw-bg-white tw-p-1 tw-px-1.5 tw-rounded-xl tw-flex tw-items-center tw-gap-2"
                >
                    <div class="tw-bg-gray-200 tw-size-11 tw-rounded-full tw-flex tw-items-center tw-justify-center">
                        <span class="">LS</span>
                    </div>
                    <div class="tw-flex-1 tw-flex tw-justify-between tw-items-center">
                        <div class="tw-flex tw-flex-col">
                            <span class="tw-block tw-text-xs tw-text-gray-500">Company</span>
                            <span class="tw-text-sm tw-font-medium">Load Swift NYC</span>
                        </div>
                        <div class="tw-flex tw-items-center tw-gap-2">
                            <svg class="tw-w-4 tw-h-4 tw-text-gray-500 tw-transition-transform tw-duration-300" 
                                 :class="{ 'tw-rotate-180': isOpen }"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>
                    </div>
                </button>
                
                <div x-show="isOpen"
                     x-transition:enter="tw-transition-all tw-ease-out tw-duration-300"
                     x-transition:enter-start="tw-opacity-0 tw-max-h-0 tw-scale-95 tw-translate-y-[-10px]"
                     x-transition:enter-end="tw-opacity-100 tw-max-h-[500px] tw-scale-100 tw-translate-y-0"
                     x-transition:leave="tw-transition-all tw-ease-in tw-duration-200"
                     x-transition:leave-start="tw-opacity-100 tw-max-h-[500px] tw-scale-100 tw-translate-y-0"
                     x-transition:leave-end="tw-opacity-0 tw-max-h-0 tw-scale-95 tw-translate-y-[-10px]"
                     class="tw-absolute tw-left-0 tw-right-0 tw-mt-2 tw-overflow-hidden tw-bg-white tw-rounded-xl tw-shadow-lg tw-z-50"
                >
                    <div class="tw-py-1">
                        <a href="#" class="tw-flex tw-items-center tw-gap-3 tw-px-4 tw-py-2 hover:tw-bg-gray-50">
                            <div class="tw-bg-gray-200 tw-size-10 tw-rounded-full tw-flex tw-items-center tw-justify-center">
                                <span class="tw-text-sm">LS</span>
                            </div>
                            <span class="tw-text-sm tw-font-medium">Load Swift NYC</span>
                        </a>
                        <a href="#" class="tw-flex tw-items-center tw-gap-3 tw-px-4 tw-py-2 hover:tw-bg-gray-50">
                            <div class="tw-bg-gray-200 tw-size-10 tw-rounded-full tw-flex tw-items-center tw-justify-center">
                                <span class="tw-text-sm">PS</span>
                            </div>
                            <span class="tw-text-sm tw-font-medium">Pandawa Shankara</span>
                        </a>
                        <div class="tw-border-t tw-border-gray-100 tw-my-1"></div>
                        <a href="#" class="tw-flex tw-items-center tw-gap-2 tw-px-4 tw-py-2 tw-text-sm tw-text-gray-700 hover:tw-bg-gray-50">
                            <svg class="tw-w-5 tw-h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Add New Company
                        </a>
                        <a href="#" class="tw-flex tw-items-center tw-gap-2 tw-px-4 tw-py-2 tw-text-sm tw-text-gray-700 hover:tw-bg-gray-50">
                            <svg class="tw-w-5 tw-h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Add New Company
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <div class="tw-p-4" x-data="{ activeDropdown: null }">
            <nav class="tw-bg-white tw-rounded-2xl tw-flex-1 tw-p-1.5 tw-space-y-2">
                <!-- Dashboard -->
                <div class="tw-relative">
                    <button 
                        @click="activeDropdown = (activeDropdown === 'dashboard' ? null : 'dashboard')" 
                        class="tw-w-full tw-flex tw-items-center tw-justify-between tw-px-3 tw-py-2 tw-text-gray-700 hover:tw-bg-gray-50 focus:tw-bg-red-500 focus:tw-text-white tw-transition-all tw-duration-500 tw-group tw-rounded-xl"
                        :class="{ 'tw-bg-red-500 tw-text-white hover:tw-bg-red-500 hover:tw-text-white': activeDropdown === 'dashboard' }"
                    >
                        <div class="tw-flex tw-items-center">
                            <svg class="tw-size-5 tw-mr-2 tw-flex-shrink-0 tw-transition-transform tw-duration-300 group-hover:tw-rotate-[-15deg]" 
                                 :class="{ 'tw-rotate-[-15deg]': activeDropdown === 'dashboard' }"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                            <span class="tw-transition-all tw-duration-200 group-hover:tw-translate-x-1" :class="{ 'tw-translate-x-1': activeDropdown === 'dashboard' }">
                                Dashboard
                            </span>
                        </div>
                        <svg class="tw-w-4 tw-h-4 tw-transition-transform tw-duration-300" 
                             :class="{ 'tw-rotate-180': activeDropdown === 'dashboard' }" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    
                    <div x-show="activeDropdown === 'dashboard'"
                         x-transition:enter="tw-transition-all tw-ease-in-out tw-duration-500"
                         x-transition:enter-start="tw-opacity-0 tw-max-h-0 tw-scale-95 tw-translate-y-[-10px]"
                         x-transition:enter-end="tw-opacity-100 tw-max-h-[500px] tw-scale-100 tw-translate-y-0"
                         x-transition:leave="tw-transition-all tw-ease-in-out tw-duration-500"
                         x-transition:leave-start="tw-opacity-100 tw-max-h-[500px] tw-scale-100 tw-translate-y-0"
                         x-transition:leave-end="tw-opacity-0 tw-max-h-0 tw-scale-95 tw-translate-y-[-10px]"
                         class="tw-overflow-hidden tw-bg-white tw-rounded-xl tw-mt-1 tw-transform">
                        <div class="tw-py-1 tw-px-3 tw-border tw-border-gray-100 tw-rounded-xl tw-shadow-md tw-space-y-1">
                            <a 
                               href="{{ route('dashboard.index') ?? 'javascript:void(0)' }}" 
                               data-ajax="true"
                               class="tw-block tw-px-3 tw-py-2 tw-text-sm tw-text-gray-700 hover:tw-bg-gray-50 focus:tw-bg-red-500 focus:tw-text-white tw-transition-all tw-duration-500 tw-group tw-rounded-xl"
                            >
                                Home
                            </a>
                            <a href="javascript:void(0)" class="tw-block tw-px-3 tw-py-2 tw-text-sm tw-text-gray-700 hover:tw-bg-gray-50 focus:tw-bg-red-500 focus:tw-text-white tw-transition-all tw-duration-500 tw-group tw-rounded-xl">
                                Overview
                            </a>
                            <a href="javascript:void(0)" class="tw-block tw-px-3 tw-py-2 tw-text-sm tw-text-gray-700 hover:tw-bg-gray-50 focus:tw-bg-red-500 focus:tw-text-white tw-transition-all tw-duration-500 tw-group tw-rounded-xl">
                                Analytics
                            </a>
                            <a href="javascript:void(0)" class="tw-block tw-px-3 tw-py-2 tw-text-sm tw-text-gray-700 hover:tw-bg-gray-50 focus:tw-bg-red-500 focus:tw-text-white tw-transition-all tw-duration-500 tw-group tw-rounded-xl">
                                Reports
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Shipment -->
                <div class="tw-relative">
                    <button 
                        @click="activeDropdown = (activeDropdown === 'shipment' ? null : 'shipment')"
                        class="tw-w-full tw-flex tw-items-center tw-justify-between tw-px-3 tw-py-2 tw-text-gray-700 hover:tw-bg-gray-50 focus:tw-bg-red-500 focus:tw-text-white tw-transition-all tw-duration-500 tw-group tw-rounded-xl"
                        :class="{ 'tw-bg-red-500 tw-text-white hover:tw-bg-red-500 hover:tw-text-white': activeDropdown === 'shipment' }"
                    >
                        <div class="tw-flex tw-items-center">
                            <svg class="tw-size-5 tw-mr-2 tw-flex-shrink-0 tw-transition-transform tw-duration-300 group-hover:tw-rotate-[-15deg]" 
                                 :class="{ 'tw-rotate-[-15deg]': activeDropdown === 'shipment' }"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                            </svg>
                            <span class="tw-transition-all tw-duration-200 group-hover:tw-translate-x-1" :class="{ 'tw-translate-x-1': activeDropdown === 'shipment' }">
                                Shipment
                            </span>
                        </div>
                        <svg class="tw-w-4 tw-h-4 tw-transition-transform tw-duration-300" 
                             :class="{ 'tw-rotate-180': activeDropdown === 'shipment' }" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    
                    <div x-show="activeDropdown === 'shipment'"
                         x-transition:enter="tw-transition-all tw-ease-in-out tw-duration-300"
                         x-transition:enter-start="tw-opacity-0 tw-max-h-0 tw-scale-95 tw-translate-y-[-10px]"
                         x-transition:enter-end="tw-opacity-100 tw-max-h-[500px] tw-scale-100 tw-translate-y-0"
                         x-transition:leave="tw-transition-all tw-ease-in tw-duration-200"
                         x-transition:leave-start="tw-opacity-100 tw-max-h-[500px] tw-scale-100 tw-translate-y-0"
                         x-transition:leave-end="tw-opacity-0 tw-max-h-0 tw-scale-95 tw-translate-y-[-10px]"
                         class="tw-overflow-hidden tw-bg-white tw-rounded-xl tw-mt-1 tw-transform">
                        <div class="tw-py-1 tw-px-3 tw-border tw-border-gray-100 tw-rounded-xl tw-shadow-md tw-space-y-1">
                            <a href="javascript:void(0)" class="tw-block tw-px-3 tw-py-2 tw-text-sm tw-text-gray-700 hover:tw-bg-gray-50 focus:tw-bg-red-500 focus:tw-text-white tw-transition-all tw-duration-500 tw-group tw-rounded-xl">
                                New Shipment
                            </a>
                            <a href="javascript:void(0)" class="tw-block tw-px-3 tw-py-2 tw-text-sm tw-text-gray-700 hover:tw-bg-gray-50 focus:tw-bg-red-500 focus:tw-text-white tw-transition-all tw-duration-500 tw-group tw-rounded-xl">
                                Track Shipment
                            </a>
                            <a href="javascript:void(0)" class="tw-block tw-px-3 tw-py-2 tw-text-sm tw-text-gray-700 hover:tw-bg-gray-50 focus:tw-bg-red-500 focus:tw-text-white tw-transition-all tw-duration-500 tw-group tw-rounded-xl">
                                Shipment History
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Customer -->
                <div class="tw-relative">
                    <button 
                        @click="activeDropdown = (activeDropdown === 'customer' ? null : 'customer')"
                        class="tw-w-full tw-flex tw-items-center tw-justify-between tw-px-3 tw-py-2 tw-text-gray-700 hover:tw-bg-gray-50 focus:tw-bg-red-500 focus:tw-text-white tw-transition-all tw-duration-500 tw-group tw-rounded-xl"
                        :class="{ 'tw-bg-red-500 tw-text-white hover:tw-bg-red-500 hover:tw-text-white': activeDropdown === 'customer' }"
                    >
                        <div class="tw-flex tw-items-center">
                            <svg class="tw-size-5 tw-mr-2 tw-flex-shrink-0 tw-transition-transform tw-duration-300 group-hover:tw-rotate-[-15deg]" 
                                 :class="{ 'tw-rotate-[-15deg]': activeDropdown === 'customer' }"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                            <span class="tw-transition-all tw-duration-200 group-hover:tw-translate-x-1" :class="{ 'tw-translate-x-1': activeDropdown === 'customer' }">
                                Customer
                            </span>
                        </div>
                        <svg class="tw-w-4 tw-h-4 tw-transition-transform tw-duration-300" 
                             :class="{ 'tw-rotate-180': activeDropdown === 'customer' }" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    
                    <div x-show="activeDropdown === 'customer'"
                         x-transition:enter="tw-transition-all tw-ease-out tw-duration-300"
                         x-transition:enter-start="tw-opacity-0 tw-max-h-0 tw-scale-95 tw-translate-y-[-10px]"
                         x-transition:enter-end="tw-opacity-100 tw-max-h-[500px] tw-scale-100 tw-translate-y-0"
                         x-transition:leave="tw-transition-all tw-ease-in tw-duration-200"
                         x-transition:leave-start="tw-opacity-100 tw-max-h-[500px] tw-scale-100 tw-translate-y-0"
                         x-transition:leave-end="tw-opacity-0 tw-max-h-0 tw-scale-95 tw-translate-y-[-10px]"
                         class="tw-overflow-hidden tw-bg-white tw-rounded-xl tw-mt-1 tw-transform">
                        <div class="tw-py-1 tw-px-3 tw-border tw-border-gray-100 tw-rounded-xl tw-shadow-md tw-space-y-1">
                            <a href="javascript:void(0)" class="tw-block tw-px-3 tw-py-2 tw-text-sm tw-text-gray-700 hover:tw-bg-gray-50 focus:tw-bg-red-500 focus:tw-text-white tw-transition-all tw-duration-500 tw-group tw-rounded-xl">
                                Add Customer
                            </a>
                            <a href="javascript:void(0)" class="tw-block tw-px-3 tw-py-2 tw-text-sm tw-text-gray-700 hover:tw-bg-gray-50 focus:tw-bg-red-500 focus:tw-text-white tw-transition-all tw-duration-500 tw-group tw-rounded-xl">
                                Customer List
                            </a>
                            <a href="javascript:void(0)" class="tw-block tw-px-3 tw-py-2 tw-text-sm tw-text-gray-700 hover:tw-bg-gray-50 focus:tw-bg-red-500 focus:tw-text-white tw-transition-all tw-duration-500 tw-group tw-rounded-xl">
                                Customer Groups
                            </a>
                        </div>
                    </div>
                </div>

                <!-- History -->
                <div class="tw-relative">
                    <button 
                        @click="activeDropdown = (activeDropdown === 'history' ? null : 'history')"
                        class="tw-w-full tw-flex tw-items-center tw-justify-between tw-px-3 tw-py-2 tw-text-gray-700 hover:tw-bg-gray-50 focus:tw-bg-red-500 focus:tw-text-white tw-transition-all tw-duration-500 tw-group tw-rounded-xl"
                        :class="{ 'tw-bg-red-500 tw-text-white hover:tw-bg-red-500 hover:tw-text-white': activeDropdown === 'history' }"
                    >
                        <div class="tw-flex tw-items-center">
                            <svg class="tw-size-5 tw-mr-2 tw-flex-shrink-0 tw-transition-transform tw-duration-300 group-hover:tw-rotate-[-15deg]" 
                                 :class="{ 'tw-rotate-[-15deg]': activeDropdown === 'history' }"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="tw-transition-all tw-duration-200 group-hover:tw-translate-x-1" :class="{ 'tw-translate-x-1': activeDropdown === 'history' }">
                                History
                            </span>
                        </div>
                        <svg class="tw-w-4 tw-h-4 tw-transition-transform tw-duration-300" 
                             :class="{ 'tw-rotate-180': activeDropdown === 'history' }" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    
                    <div x-show="activeDropdown === 'history'"
                         x-transition:enter="tw-transition-all tw-ease-out tw-duration-300"
                         x-transition:enter-start="tw-opacity-0 tw-max-h-0 tw-scale-95 tw-translate-y-[-10px]"
                         x-transition:enter-end="tw-opacity-100 tw-max-h-[500px] tw-scale-100 tw-translate-y-0"
                         x-transition:leave="tw-transition-all tw-ease-in tw-duration-200"
                         x-transition:leave-start="tw-opacity-100 tw-max-h-[500px] tw-scale-100 tw-translate-y-0"
                         x-transition:leave-end="tw-opacity-0 tw-max-h-0 tw-scale-95 tw-translate-y-[-10px]"
                         class="tw-overflow-hidden tw-bg-white tw-rounded-xl tw-mt-1 tw-transform">
                        <div class="tw-py-1 tw-px-3 tw-border tw-border-gray-100 tw-rounded-xl tw-shadow-md tw-space-y-1">
                            <a 
                                href="javascript:void(0)" 
                                class="tw-block tw-px-3 tw-py-2 tw-text-sm tw-text-gray-700 hover:tw-bg-gray-50 focus:tw-bg-red-500 focus:tw-text-white tw-transition-all tw-duration-500 tw-group tw-rounded-xl"
                            >
                                Transaction History
                            </a>
                            <a 
                                href="javascript:void(0)" 
                                class="tw-block tw-px-3 tw-py-2 tw-text-sm tw-text-gray-700 hover:tw-bg-gray-50 focus:tw-bg-red-500 focus:tw-text-white tw-transition-all tw-duration-500 tw-group tw-rounded-xl"
                            >
                                Activity Log
                            </a>
                            <a 
                                href="javascript:void(0)" 
                                class="tw-block tw-px-3 tw-py-2 tw-text-sm tw-text-gray-700 hover:tw-bg-gray-50 focus:tw-bg-red-500 focus:tw-text-white tw-transition-all tw-duration-500 tw-group tw-rounded-xl"
                            >
                                System Logs
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Analysis -->
                <a 
                    href="javascript:void(0)" 
                    @click="activeDropdown = (activeDropdown === 'analysis' ? null : 'analysis')"
                    class="tw-w-full tw-flex tw-items-center tw-justify-between tw-px-3 tw-py-2 tw-text-gray-700 hover:tw-bg-gray-50 focus:tw-bg-red-500 focus:tw-text-white tw-transition-all tw-duration-500 tw-group tw-rounded-xl"
                    :class="{ 'tw-bg-red-500 tw-text-white hover:tw-bg-red-500 hover:tw-text-white': activeDropdown === 'analysis' }"
                >
                    <div class="tw-flex tw-items-center">
                        <svg 
                            class="tw-size-5 tw-mr-2 tw-flex-shrink-0 tw-transition-transform tw-duration-300 group-hover:tw-rotate-[-15deg] group-focus:tw-rotate-[-15deg]"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            :class="{ 'tw-rotate-[-15deg]': activeDropdown === 'analysis' }"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        <span 
                            class="tw-transition-all tw-duration-200 group-hover:tw-translate-x-1 group-focus:tw-translate-x-1"
                            :class="{ 'tw-translate-x-1': activeDropdown === 'analysis' }"
                        >
                            Analysis
                        </span>
                    </div>
                    <div 
                        class="tw-flex tw-items-center tw-gap-0.5 tw-text-red-500 tw-text-xs group-focus:tw-text-white"
                        :class="{ 'tw-text-white': activeDropdown === 'analysis' }"
                    >
                        <div 
                            class="tw-flex tw-items-center tw-justify-center tw-size-4 tw-p-0.5 tw-bg-red-500 group-focus:tw-bg-white tw-text-white group-focus:tw-text-red-500 tw-rounded-full"
                            :class="{ 'tw-bg-white !tw-text-red-500': activeDropdown === 'analysis' }"
                        >
                            <svg class="tw-size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                            </svg>
                        </div>
                        <span class="tw-text-sm">+20%</span>
                    </div>
                </a>

                <!-- Notification -->
                <a 
                    href="javascript:void(0)" 
                    @click="activeDropdown = (activeDropdown === 'notification' ? null : 'notification')"
                    class="tw-w-full tw-flex tw-items-center tw-justify-between tw-px-3 tw-py-2 tw-text-gray-700 hover:tw-bg-gray-50 focus:tw-bg-red-500 focus:tw-text-white tw-transition-all tw-duration-500 tw-group tw-rounded-xl"
                    :class="{ 'tw-bg-red-500 tw-text-white hover:tw-bg-red-500 hover:tw-text-white': activeDropdown === 'notification' }"
                >
                    <div class="tw-flex tw-items-center">
                        <svg class="tw-size-5 tw-mr-2 tw-flex-shrink-0 tw-transition-transform tw-duration-300 group-hover:tw-rotate-[-15deg]" 
                             :class="{ 'tw-rotate-[-15deg]': activeDropdown === 'notification' }"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        <span 
                            class="tw-transition-all tw-duration-200 group-hover:tw-translate-x-1 group-focus:tw-translate-x-1"
                            :class="{ 'tw-translate-x-1': activeDropdown === 'notification' }"
                        >
                            Notification
                        </span>
                    </div>
                    <span class="tw-p-3 tw-flex tw-items-center tw-justify-center tw-size-4 tw-bg-red-500 group-focus:tw-bg-white group-focus:tw-text-red-500 tw-text-white tw-rounded-full tw-text-xs">
                        99+
                    </span>
                </a>

                <!-- Single menu items -->

                <!-- Settings -->
                <a href="javascript:void(0)"
                   @click="activeDropdown = (activeDropdown === 'settings' ? null : 'settings')"
                   class="tw-flex tw-items-center tw-justify-between tw-px-3 tw-py-2 tw-text-gray-700 hover:tw-bg-gray-50 focus:tw-bg-red-500 focus:tw-text-white tw-transition-all tw-duration-500 tw-group tw-rounded-xl"
                   :class="{ 'tw-bg-red-500 tw-text-white hover:tw-bg-red-500 hover:tw-text-white': activeDropdown === 'settings' }"
                >
                    <div class="tw-flex tw-items-center">
                        <svg 
                            class="tw-size-5 tw-mr-2 tw-flex-shrink-0 tw-transition-transform tw-duration-300 group-hover:tw-rotate-[-15deg] group-focus:tw-rotate-[-15deg]"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            :class="{ 'tw-rotate-[-15deg]': activeDropdown === 'settings' }"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span 
                            class="tw-transition-all tw-duration-200 group-hover:tw-translate-x-1 group-focus:tw-translate-x-1"
                            :class="{ 'tw-translate-x-1': activeDropdown === 'settings' }"
                        >
                            Settings
                        </span>
                    </div>
                </a>

                <!-- Help Center -->
                <a href="javascript:void(0)"
                   @click="activeDropdown = (activeDropdown === 'help' ? null : 'help')"
                   class="tw-flex tw-items-center tw-justify-between tw-px-3 tw-py-2 tw-text-gray-700 hover:tw-bg-gray-50 focus:tw-bg-red-500 focus:tw-text-white tw-transition-all tw-duration-500 tw-group tw-rounded-xl"
                   :class="{ 'tw-bg-red-500 tw-text-white hover:tw-bg-red-500 hover:tw-text-white': activeDropdown === 'help' }"
                >
                    <div class="tw-flex tw-items-center">
                        <svg 
                            class="tw-size-5 tw-mr-2 tw-flex-shrink-0 tw-transition-transform tw-duration-300 group-hover:tw-rotate-[-15deg] group-focus:tw-rotate-[-15deg]" 
                            fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            :class="{ 'tw-rotate-[-15deg]': activeDropdown === 'help' }"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span 
                            class="tw-transition-all tw-duration-200 group-hover:tw-translate-x-1 group-focus:tw-translate-x-1"
                            :class="{ 'tw-translate-x-1': activeDropdown === 'help' }"
                        >
                            Help Center
                        </span>
                    </div>
                </a>

                <!-- Logout -->
                <a href="javascript:void(0)"
                   @click="activeDropdown = (activeDropdown === 'logout' ? null : 'logout')"
                   class="tw-flex tw-items-center tw-justify-between tw-px-3 tw-py-2 tw-text-gray-700 hover:tw-bg-gray-50 focus:tw-bg-red-500 focus:tw-text-white tw-transition-all tw-duration-500 tw-group tw-rounded-xl"
                   :class="{ 'tw-bg-red-500 tw-text-white hover:tw-bg-red-500 hover:tw-text-white': activeDropdown === 'logout' }"
                >
                    <div class="tw-flex tw-items-center">
                        <svg 
                            class="tw-size-5 tw-mr-2 tw-flex-shrink-0 tw-transition-transform tw-duration-300 group-hover:tw-rotate-[-15deg] group-focus:tw-rotate-[-15deg]" 
                            fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            :class="{ 'tw-rotate-[-15deg]': activeDropdown === 'logout' }"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        <span 
                            class="tw-transition-all tw-duration-200 group-hover:tw-translate-x-1 group-focus:tw-translate-x-1"
                            :class="{ 'tw-translate-x-1': activeDropdown === 'logout' }"
                        >
                            Logout
                        </span>
                    </div>
                </a>

                <!-- Documentation -->
                <a href="javascript:void(0)"
                   @click="activeDropdown = (activeDropdown === 'documentation' ? null : 'documentation')"
                   class="tw-flex tw-items-center tw-justify-between tw-px-3 tw-py-2 tw-text-gray-700 hover:tw-bg-gray-50 focus:tw-bg-red-500 focus:tw-text-white tw-transition-all tw-duration-500 tw-group tw-rounded-xl"
                   :class="{ 'tw-bg-red-500 tw-text-white hover:tw-bg-red-500 hover:tw-text-white': activeDropdown === 'documentation' }"
                >
                    <div class="tw-flex tw-items-center">
                        <svg 
                            class="tw-size-5 tw-mr-2 tw-flex-shrink-0 tw-transition-transform tw-duration-300 group-hover:tw-rotate-[-15deg] group-focus:tw-rotate-[-15deg]" 
                            fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            :class="{ 'tw-rotate-[-15deg]': activeDropdown === 'documentation' }"
                        >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                        </svg>
                        <span 
                            class="tw-transition-all tw-duration-200 group-hover:tw-translate-x-1 group-focus:tw-translate-x-1"
                            :class="{ 'tw-translate-x-1': activeDropdown === 'documentation' }"
                        >
                            Documentation
                        </span>
                    </div>
                    <span class="tw-px-2 tw-py-0.5 tw-text-xs tw-font-medium tw-bg-red-100 tw-text-red-600 tw-rounded-full">New</span>
                </a>

                <!-- Users Management Menu -->
                <a 
                   href="{{ route('dashboard.users.index') ?? 'javascript:void(0)' }}" 
                   data-ajax="true"
                   @click="activeDropdown = (activeDropdown === 'users' ? null : 'users')"
                   class="tw-flex tw-items-center tw-justify-between tw-px-3 tw-py-2 tw-text-gray-700 hover:tw-bg-gray-50 focus:tw-bg-red-500 focus:tw-text-white tw-transition-all tw-duration-500 tw-group tw-rounded-xl"
                   :class="{ 'tw-bg-red-500 tw-text-white hover:tw-bg-red-500 hover:tw-text-white': activeDropdown === 'users' }"
                >
                    <div class="tw-flex tw-items-center">
                        <svg 
                            class="tw-size-5 tw-mr-2 tw-flex-shrink-0 tw-transition-transform tw-duration-300 group-hover:tw-rotate-[-15deg] group-focus:tw-rotate-[-15deg]" 
                            fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            :class="{ 'tw-rotate-[-15deg]': activeDropdown === 'users' }"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        <span 
                            class="tw-transition-all tw-duration-200 group-hover:tw-translate-x-1"
                            :class="{ 'tw-translate-x-1': activeDropdown === 'users' }"
                        >
                            Users Management
                        </span>
                        <span class="tw-px-2 tw-py-0.5 tw-text-xs tw-font-medium tw-bg-red-100 tw-text-red-600 tw-rounded-full">New</span>
                    </div>
                </a>
            </nav>
        </div>

        <!-- Recent Trips -->
        <div class="tw-p-4">
            <div class="tw-bg-red-500 tw-text-white tw-rounded-2xl tw-px-4 tw-py-2">
                <div class="tw-flex tw-justify-between tw-items-center tw-mb-4">
                    <span class="tw-text-4xl tw-leading-8">Recent trips</span>
                    <span class="tw-flex-shrink-0 tw-bg-red-400/50 tw-px-2 tw-py-0.5 tw-rounded-full tw-text-xs">28 Oct</span>
                </div>
                <div class="tw-space-y-2">
                    <div class="tw-bg-white tw-w-fit tw-flex tw-items-center tw-px-3 tw-py-1 tw-rounded-lg">
                        <span class="tw-text-sm tw-font-medium tw-text-red-500">Duration</span>
                    </div>
                    <div class="tw-flex tw-items-center tw-px-3 tw-py-1">
                        <span class="tw-text-sm tw-font-medium">Speed</span>
                    </div>
                    <div class="tw-flex tw-justify-between tw-items-center tw-gap-2">
                        <div class="tw-flex tw-items-center tw-px-3 tw-py-1">
                            <span class="tw-text-sm tw-font-medium">Stops</span>
                        </div>
                        <span class="tw-text-lg">1246 KM</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Icon Bar -->
        <div class="tw-p-4">
            <div class="tw-bg-white tw-rounded-full tw-px-2 tw-py-1 tw-flex tw-items-center tw-gap-2 tw-w-full tw-shadow-sm">
                <button class="tw-p-1 hover:tw-bg-gray-50 tw-rounded-lg tw-transition-all tw-duration-500 tw-group">
                    <svg class="tw-w-6 tw-h-6 tw-text-gray-500 group-hover:tw-text-red-500 group-hover:tw-scale-105 group-hover:tw-transition-all group-hover:tw-duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </button>
                
                <button class="tw-p-1 hover:tw-bg-gray-50 tw-rounded-lg tw-transition-all tw-duration-500 tw-group">
                    <svg class="tw-w-6 tw-h-6 tw-text-gray-500 group-hover:tw-text-red-500 group-hover:tw-scale-105 group-hover:tw-transition-all group-hover:tw-duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V7a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                    </svg>
                </button>
                
                <button class="tw-p-1 hover:tw-bg-gray-50 tw-rounded-lg tw-transition-all tw-duration-500 tw-group">
                    <svg class="tw-w-6 tw-h-6 tw-text-gray-500 group-hover:tw-text-red-500 group-hover:tw-scale-105 group-hover:tw-transition-all group-hover:tw-duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </button>
                
                <button class="tw-p-1 hover:tw-bg-gray-50 tw-rounded-lg tw-transition-all tw-duration-500 tw-group">
                    <svg class="tw-w-6 tw-h-6 tw-text-gray-500 group-hover:tw-text-red-500 group-hover:tw-scale-105 group-hover:tw-transition-all group-hover:tw-duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </button>
                
                <button class="tw-p-1 hover:tw-bg-gray-50 tw-rounded-lg tw-transition-all tw-duration-500 tw-group">
                    <svg class="tw-w-6 tw-h-6 tw-text-gray-500 group-hover:tw-text-red-500 group-hover:tw-scale-105 group-hover:tw-transition-all group-hover:tw-duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Bottom Section -->
        <div class="tw-p-4 tw-mt-auto">
            <!-- Create New Request -->
            <div class="tw-border-2 tw-border-dashed tw-border-red-500 tw-rounded-xl tw-p-4 tw-flex tw-flex-col tw-items-center tw-justify-center">
                <button class="tw-w-8 tw-h-8 tw-flex tw-items-center tw-justify-center tw-bg-red-500 tw-text-white tw-rounded-full">
                    <svg class="tw-w-5 tw-h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </button>
                <span class="tw-text-sm tw-mt-2">Create new Request</span>
            </div>
        </div>
    </div>
</div>

<!-- Overlay for mobile -->
<div id="sidebarOverlay" class="tw-fixed tw-inset-0 tw-bg-black tw-bg-opacity-50 tw-z-30 tw-hidden" onclick="toggleSidebar()"></div>

@push('scripts')
    <script>
        // Delay loading for 2 seconds
        setTimeout(() => {
            document.getElementById('sidebar').classList.remove('-tw-translate-x-full');
        }, 2000);

        let sidebarOpen = false;
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const sidebarToggle = document.getElementById('sidebarToggle');

        function toggleSidebar() {
            sidebarOpen = !sidebarOpen;
            
            if (sidebarOpen) {
                sidebar.classList.remove('-tw-translate-x-full');
                sidebarOverlay.classList.remove('tw-hidden');
                document.body.classList.add('tw-overflow-hidden');
            } else {
                sidebar.classList.add('-tw-translate-x-full');
                sidebarOverlay.classList.add('tw-hidden');
                document.body.classList.remove('tw-overflow-hidden');
            }
        }

        // Toggle sidebar when button is clicked
        sidebarToggle.addEventListener('click', toggleSidebar);

        // Close sidebar when window is resized to desktop view
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768) { // md breakpoint
                sidebarOpen = false;
                sidebar.classList.add('-tw-translate-x-full');
                sidebarOverlay.classList.add('tw-hidden');
                document.body.classList.remove('tw-overflow-hidden');
            }
        });

        // Close sidebar when clicking outside (for mobile)
        document.addEventListener('click', (e) => {
            if (sidebarOpen && 
                !sidebar.contains(e.target) && 
                !sidebarToggle.contains(e.target)) {
                toggleSidebar();
            }
        });

        // Add AJAX navigation
        $(document).ready(function() {
            // Intercept all navigation links
            $(document).on('click', 'a[data-ajax="true"]', function(e) {
                e.preventDefault();
                const url = $(this).attr('href');
                
                if (url !== 'javascript:void(0)' && url !== '#') {
                    // Show loading state
                    $('#mainContent').html(`
                        <div class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-min-h-screen">
                            <div class="tw-animate-spin tw-rounded-full tw-h-12 tw-w-12 tw-border-t-2 tw-border-b-2 tw-border-red-500"></div>
                            <span class="tw-text-sm tw-mt-2">Please wait<span class="dots"></span></span>
                        </div>
                    `);

                    // Update URL without refresh
                    window.history.pushState({}, '', url);

                    // Fetch content via AJAX
                    setTimeout(() => {
                        $.ajax({
                            url: url,
                            type: 'GET',
                            success: function(response) {
                            // Extract content from response
                            const content = $(response).find('#mainContent').html();
                            $('#mainContent').html(content);

                            // Close sidebar on mobile after navigation
                            if (window.innerWidth < 768 && sidebarOpen) {
                                toggleSidebar();
                            }
                        },
                        error: function() {
                                $('#mainContent').html('<div class="tw-text-center tw-py-8"><p class="tw-text-red-500">Error loading content. Please try again.</p></div>');
                            }
                        });
                    }, 1000);
                }
            });

            // Handle browser back/forward buttons
            window.onpopstate = function() {
                loadContent(window.location.href);
            };
        });
    </script>
@endpush