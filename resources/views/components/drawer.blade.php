@props([
    'title' => '',
    'isOpen' => false,
])

<div x-show="drawerOpen" 
     x-cloak
     @close-drawer.window="drawerOpen = false"
     class="fixed inset-0 overflow-hidden z-50" 
     aria-labelledby="slide-over-title" 
     role="dialog" 
     aria-modal="true">
    
    <!-- Background overlay -->
    <div x-show="drawerOpen"
         x-cloak
         x-transition:enter="transition-opacity ease-in-out duration-500"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-in-out duration-500"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
         @click="drawerOpen = false">
    </div>

    <div class="fixed inset-x-0 bottom-0 max-h-[95vh] sm:max-h-[90vh] flex">
        <div x-show="drawerOpen"
             x-transition:enter="transform transition ease-in-out duration-500"
             x-transition:enter-start="translate-y-full"
             x-transition:enter-end="translate-y-0"
             x-transition:leave="transform transition ease-in-out duration-500"
             x-transition:leave-start="translate-y-0"
             x-transition:leave-end="translate-y-full"
             class="w-full max-h-[90vh] flex flex-col"
             :style="isDragging ? `transform: translateY(${currentHeight}px)` : ''">
            
            <div class="cursor-grab flex flex-col bg-white shadow-xl rounded-t-3xl h-full"
                @mousedown="
                    isDragging = true;
                    startY = $event.pageY;
                    initialHeight = currentHeight;
                    
                    const mouseMoveHandler = (e) => {
                        if (isDragging) {
                            const delta = e.pageY - startY;
                            const maxUpward = -window.innerHeight * 0.0;
                            const maxDownward = window.innerHeight * 1;
                            currentHeight = Math.min(Math.max(delta, maxUpward), maxDownward);
                        }
                    };
                    
                    const mouseUpHandler = () => {
                        isDragging = false;
                        if (currentHeight > window.innerHeight * 0.2) {
                            drawerOpen = false;
                        }
                        currentHeight = 0;
                        window.removeEventListener('mousemove', mouseMoveHandler);
                        window.removeEventListener('mouseup', mouseUpHandler);
                    };
                    
                    window.addEventListener('mousemove', mouseMoveHandler);
                    window.addEventListener('mouseup', mouseUpHandler);
                "
                @mouseleave="if (!isDragging) currentHeight = 0"
            >
                <!-- Drag Handle -->
                <div class="py-2 flex justify-center flex-shrink-0">
                    <div class="w-10 h-1 bg-gray-300 rounded-full"></div>
                </div>

                <!-- Header -->
                <div class="px-4 py-6 sm:px-6 flex-shrink-0">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-medium" id="slide-over-title">
                            {{ $title }}
                        </h2>
                        <button @click="drawerOpen = false" class="hover:text-gray-200">
                            <span class="sr-only">Close panel</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Content -->
                <div class="flex-1 overflow-y-auto">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</div> 