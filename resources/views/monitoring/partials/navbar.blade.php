<nav class="bg-white shadow-md">
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <img class="h-8 w-auto" src="{{ asset('assets/logo/logo-eh-2.png') }}" alt="Logo">
                </div>
                <!-- Navigation Links (Desktop) -->
                <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                    <a href="#" class="border-b-2 border-blue-500 text-gray-900 inline-flex items-center px-1 pt-1 text-sm font-medium">
                        Overview
                    </a>

                    @if(auth()->user()->role == \App\Models\User::ROLE_SUPER_ADMIN)
                    {{-- Back To Admin --}}
                    <a href="{{ route('dashboard.index') }}" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        Back To Admin
                    </a>
                    @endif
                </div>
            </div>

            <!-- Mobile menu button -->
            <div class="flex items-center sm:hidden">
                <button type="button" class="mobile-menu-button inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500" aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <!-- Icon when menu is closed -->
                    <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <!-- Icon when menu is open -->
                    <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- User Menu -->
            <div class="hidden sm:flex sm:items-center">
                <div class="ml-3 relative" x-data="{ isOpen: false }">
                    <div class="flex items-center cursor-pointer" @click="isOpen = !isOpen">
                        <span class="text-gray-700 mr-2">{{ auth()->user()->name }}</span>
                        @if(auth()->user()->avatar)
                            <img class="h-8 w-8 rounded-full object-cover" src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="User avatar" onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                            <div class="h-8 w-8 rounded-full bg-gray-200 items-center justify-center hidden">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                        @else
                            <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                        @endif
                    </div>

                    <!-- Dropdown menu -->
                    <div x-show="isOpen"
                         @click.away="isOpen = false"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 z-50">
                        
                        <form method="POST" action="{{ route('auth.logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Sign Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state -->
    <div class="sm:hidden hidden" id="mobile-menu">
        <div class="pt-2 pb-3 space-y-1">
            <a href="#" class="bg-blue-50 border-blue-500 text-blue-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">Dashboard</a>
        </div>
        <!-- Mobile user menu -->
        <div class="pt-4 pb-3 border-t border-gray-200">
            <div class="flex items-center px-4">
                <div class="flex-shrink-0">
                    @if(auth()->user()->avatar)
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="User avatar" onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                        <div class="h-10 w-10 rounded-full bg-gray-200 items-center justify-center hidden">
                            <i class="fas fa-user text-gray-400"></i>
                        </div>
                    @else
                        <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                            <i class="fas fa-user text-gray-400"></i>
                        </div>
                    @endif
                </div>
                <div class="ml-3">
                    <div class="text-base font-medium text-gray-800">{{ auth()->user()->name }}</div>
                    <div class="text-sm font-medium text-gray-500">{{ auth()->user()->email }}</div>
                </div>
            </div>
            <div class="mt-3 space-y-1">
                <form method="POST" action="{{ route('auth.logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">
                        Sign Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>