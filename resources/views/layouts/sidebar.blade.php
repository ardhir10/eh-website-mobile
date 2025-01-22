<!-- Sidebar Toggle Button (Mobile) -->
<button id="sidebarToggle" class="md:hidden fixed top-4 right-4 z-50 bg-white p-2 rounded-lg shadow-md">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
    </svg>
</button>

<!-- Sidebar -->
<div id="sidebar" class=" bg-white  fixed md:sticky md:top-0 w-64 bg-transparent border-r border-gray-100 h-screen min-h-screen overflow-y-auto transition-transform duration-300 ease-in-out transform -translate-x-full md:translate-x-0 z-40">
    <div class="flex flex-col h-full">
        <!-- Profile & Company Section -->
        <div class="p-4">
            <div class="w-full bg-white p-1 px-1.5 rounded-xl flex items-center gap-2 flex flex-col">
                
                {{-- Logo --}}
                <div class="flex items-center gap-3 mb-4 w-full p-1 px-1.5 rounded-xl transition-all duration-300">
                    <img src="{{ asset('/assets/logo/logo-eh-2.png') }}" alt="Logo" class="">
                </div>
                <!-- Profile -->
                <div class="relative" x-data="{ isOpen: false }">
                    <button 
                        @click="isOpen = !isOpen"
                        class="flex items-center gap-3 mb-4 w-full p-1 px-1.5 rounded-xl transition-all duration-300"
                    >
                        <img 
                            src="{{ asset('/assets/images/avatars/1.gif') }}" 
                            alt="Profile" 
                            class="object-cover aspect-square size-12 rounded-full bg-gray-200"
                        >
                        <div class="flex-1">
                            <span class="block text-sm text-left text-gray-500">Welcome</span>
                            <div class="flex items-center gap-1">
                                <span class="text-sm text-gray-500">back,</span>
                                <span class="text-sm font-semibold">Lingga!</span>
                            </div>
                        </div>
                        <svg class="w-4 h-4 text-gray-500 transition-transform duration-300" 
                            :class="{ 'rotate-180': isOpen }"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div x-show="isOpen"
                        x-transition:enter="transition-all ease-out duration-300"
                        x-transition:enter-start="opacity-0 max-h-0 scale-95 translate-y-[-10px]"
                        x-transition:enter-end="opacity-100 max-h-[500px] scale-100 translate-y-0"
                        x-transition:leave="transition-all ease-in duration-200"
                        x-transition:leave-start="opacity-100 max-h-[500px] scale-100 translate-y-0"
                        x-transition:leave-end="opacity-0 max-h-0 scale-95 translate-y-[-10px]"
                        class="absolute left-0 right-0 mt-[-10px] mb-4 overflow-hidden bg-white rounded-xl shadow-lg z-50"
                    >
                        <div class="py-1">
                            <div class="px-4 py-3 border-b border-gray-100">
                                <p class="text-sm font-medium">Alexander Ling</p>
                                <p class="text-sm text-gray-500">lingga@example.com</p>
                            </div>
                            
                            <a 
                                href="{{ route('dashboard.profile.index') }}" 
                                data-ajax="true"
                                class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                View Profile
                            </a>
                            
                            <a 
                                href="{{ route('dashboard.settings.index') }}" 
                                data-ajax="true"
                                class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                Settings
                            </a>

                            <div class="border-t border-gray-100 my-1"></div>
                            
                            <a href="#" class="flex items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-gray-50">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                                Sign Out
                            </a>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Company -->
            <div class="relative" x-data="{ isOpen: false }">
                <button 
                    @click="isOpen = !isOpen"
                    class="w-full bg-white p-1 px-1.5 rounded-xl flex items-center gap-2"
                >
                    <div class="bg-gray-200 size-11 rounded-full flex items-center justify-center">
                        <span class="">LS</span>
                    </div>
                    <div class="flex-1 flex justify-between items-center">
                        <div class="flex flex-col">
                            <span class="block text-xs text-gray-500">Company</span>
                            <span class="text-sm font-medium">Load Swift NYC</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-gray-500 transition-transform duration-300" 
                                 :class="{ 'rotate-180': isOpen }"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>
                    </div>
                </button>
                
                <div x-show="isOpen"
                     x-transition:enter="transition-all ease-out duration-300"
                     x-transition:enter-start="opacity-0 max-h-0 scale-95 translate-y-[-10px]"
                     x-transition:enter-end="opacity-100 max-h-[500px] scale-100 translate-y-0"
                     x-transition:leave="transition-all ease-in duration-200"
                     x-transition:leave-start="opacity-100 max-h-[500px] scale-100 translate-y-0"
                     x-transition:leave-end="opacity-0 max-h-0 scale-95 translate-y-[-10px]"
                     class="absolute left-0 right-0 mt-2 overflow-hidden bg-white rounded-xl shadow-lg z-50"
                >
                    <div class="py-1">
                        <a href="#" class="flex items-center gap-3 px-4 py-2 hover:bg-gray-50">
                            <div class="bg-gray-200 size-10 rounded-full flex items-center justify-center">
                                <span class="text-sm">LS</span>
                            </div>
                            <span class="text-sm font-medium">Load Swift NYC</span>
                        </a>
                        <a href="#" class="flex items-center gap-3 px-4 py-2 hover:bg-gray-50">
                            <div class="bg-gray-200 size-10 rounded-full flex items-center justify-center">
                                <span class="text-sm">PS</span>
                            </div>
                            <span class="text-sm font-medium">Pandawa Shankara</span>
                        </a>
                        <div class="border-t border-gray-100 my-1"></div>
                        <a href="#" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Add New Company
                        </a>
                        <a href="#" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
        <div class="p-4" x-data="{ 
            activeDropdown: '{{ request()->segment(2) }}',
            isCurrentRoute(route) {
                return '{{ request()->route()->getName() }}' === route;
            }
        }">
            <nav class="bg-white rounded-2xl flex-1 p-1.5 space-y-2">
                <!-- Dashboard -->
                <div class="relative">
                    <button 
                        @click="activeDropdown = (activeDropdown === 'dashboard' ? null : 'dashboard')" 
                        class="w-full flex items-center justify-between px-3 py-2 text-gray-700 hover:bg-gray-50 focus:bg-primary focus:text-white transition-all duration-500 group rounded-xl"
                        :class="{ 'bg-primary text-white hover:bg-primary hover:text-white': isCurrentRoute('dashboard.index') || activeDropdown === 'dashboard' }"
                    >
                        <div class="flex items-center">
                            <svg class="size-5 mr-2 flex-shrink-0 transition-transform duration-300 group-hover:rotate-[-15deg]" 
                                 :class="{ 'rotate-[-15deg]': isCurrentRoute('dashboard.index') || activeDropdown === 'dashboard' }"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                            <span class="transition-all duration-200 group-hover:translate-x-1" :class="{ 'translate-x-1': isCurrentRoute('dashboard.index') || activeDropdown === 'dashboard' }">
                                Dashboard
                            </span>
                        </div>
                        <svg class="w-4 h-4 transition-transform duration-300" 
                             :class="{ 'rotate-180': isCurrentRoute('dashboard.index') || activeDropdown === 'dashboard' }" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    
                    <div x-show="activeDropdown === 'dashboard'"
                         x-transition:enter="transition-all ease-in-out duration-500"
                         x-transition:enter-start="opacity-0 max-h-0 scale-95 translate-y-[-10px]"
                         x-transition:enter-end="opacity-100 max-h-[500px] scale-100 translate-y-0"
                         x-transition:leave="transition-all ease-in-out duration-500"
                         x-transition:leave-start="opacity-100 max-h-[500px] scale-100 translate-y-0"
                         x-transition:leave-end="opacity-0 max-h-0 scale-95 translate-y-[-10px]"
                         class="overflow-hidden bg-white rounded-xl mt-1 transform">
                        <div class="py-1 px-3 border border-gray-100 rounded-xl shadow-md space-y-1">
                            <a 
                               href="{{ route('dashboard.index') }}" 
                               data-ajax="true"
                               class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 focus:bg-primary focus:text-white transition-all duration-500 group rounded-xl"
                               :class="{ 'bg-primary text-white': isCurrentRoute('dashboard.index') }"
                            >
                                Home
                            </a>
                            <a href="javascript:void(0)" class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 focus:bg-primary focus:text-white transition-all duration-500 group rounded-xl">
                                Overview
                            </a>
                            <a href="javascript:void(0)" class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 focus:bg-primary focus:text-white transition-all duration-500 group rounded-xl">
                                Analytics
                            </a>
                            <a href="javascript:void(0)" class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 focus:bg-primary focus:text-white transition-all duration-500 group rounded-xl">
                                Reports
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Data Company -->
                <a href="{{ route('data-company.index') }}"
                   @click="activeDropdown = (activeDropdown === 'dataCompany' ? null : 'dataCompany')"
                   class="flex items-center justify-between px-3 py-2 text-gray-700 hover:bg-gray-50 focus:bg-primary focus:text-white transition-all duration-500 group rounded-xl"
                   :class="{ 'bg-primary text-white hover:bg-primary hover:text-white': isCurrentRoute('data-company.index') }"
                >
                    <div class="flex items-center">
                        <svg 
                            class="size-5 mr-2 flex-shrink-0 transition-transform duration-300 group-hover:rotate-[-15deg] group-focus:rotate-[-15deg]" 
                            fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            :class="{ 'rotate-[-15deg]': isCurrentRoute('data-company.index') }"
                        >
                            <path stroke-width="1.5" fill-rule="evenodd" d="M10 2a3 3 0 0 0-3 3v1H5a3 3 0 0 0-3 3v2.382l1.447.723.005.003.027.013.12.056c.108.05.272.123.486.212.429.177 1.056.416 1.834.655C7.481 13.524 9.63 14 12 14c2.372 0 4.52-.475 6.08-.956.78-.24 1.406-.478 1.835-.655a14.028 14.028 0 0 0 .606-.268l.027-.013.005-.002L22 11.381V9a3 3 0 0 0-3-3h-2V5a3 3 0 0 0-3-3h-4Zm5 4V5a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v1h6Zm6.447 7.894.553-.276V19a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3v-5.382l.553.276.002.002.004.002.013.006.041.02.151.07c.13.06.318.144.557.242.478.198 1.163.46 2.01.72C7.019 15.476 9.37 16 12 16c2.628 0 4.98-.525 6.67-1.044a22.95 22.95 0 0 0 2.01-.72 15.994 15.994 0 0 0 .707-.312l.041-.02.013-.006.004-.002.001-.001-.431-.866.432.865ZM12 10a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H12Z" clip-rule="evenodd"/>
                        </svg>
                        <span 
                            class="transition-all duration-200 group-hover:translate-x-1 group-focus:translate-x-1"
                            :class="{ 'translate-x-1': isCurrentRoute('data-company.index') }"
                        >
                            Data Company
                        </span>
                    </div>
                </a>

                

                <!-- Logout -->
                <a href="javascript:void(0)"
                   @click="activeDropdown = (activeDropdown === 'logout' ? null : 'logout')"
                   class="flex items-center justify-between px-3 py-2 text-gray-700 hover:bg-gray-50 focus:bg-primary focus:text-white transition-all duration-500 group rounded-xl"
                   :class="{ 'bg-primary text-white hover:bg-primary hover:text-white': isCurrentRoute('logout') }"
                >
                    <div class="flex items-center">
                        <svg 
                            class="size-5 mr-2 flex-shrink-0 transition-transform duration-300 group-hover:rotate-[-15deg] group-focus:rotate-[-15deg]" 
                            fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            :class="{ 'rotate-[-15deg]': isCurrentRoute('logout') }"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        <span 
                            class="transition-all duration-200 group-hover:translate-x-1 group-focus:translate-x-1"
                            :class="{ 'translate-x-1': isCurrentRoute('logout') }"
                        >
                            Logout
                        </span>
                    </div>
                </a>

                
            </nav>
        </div>
    </div>
</div>

<!-- Overlay for mobile -->
<div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden" onclick="toggleSidebar()"></div>

@push('scripts')
    <script>
        // Delay loading for 2 seconds
        setTimeout(() => {
            document.getElementById('sidebar').classList.remove('-translate-x-full');
        }, 2000);

        let sidebarOpen = false;
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const sidebarToggle = document.getElementById('sidebarToggle');

        function toggleSidebar() {
            sidebarOpen = !sidebarOpen;
            
            if (sidebarOpen) {
                sidebar.classList.remove('-translate-x-full');
                sidebarOverlay.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
                sidebarOverlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }
        }

        // Toggle sidebar when button is clicked
        sidebarToggle.addEventListener('click', toggleSidebar);

        // Close sidebar when window is resized to desktop view
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768) { // md breakpoint
                sidebarOpen = false;
                sidebar.classList.add('-translate-x-full');
                sidebarOverlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
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
                        <div class="flex flex-col items-center justify-center min-h-screen">
                            <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-red-500"></div>
                            <span class="text-sm mt-2">Please wait<span class="dots"></span></span>
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
                                $('#mainContent').html('<div class="text-center py-8"><p class="text-red-500">Error loading content. Please try again.</p></div>');
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