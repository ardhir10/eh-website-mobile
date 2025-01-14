@props([
    'title' => '',
    'isOpen' => false,
])

<div x-show="drawerOpen" 
     x-cloak
     @close-drawer.window="drawerOpen = false"
     class="tw-fixed tw-inset-0 tw-overflow-hidden tw-z-50" 
     aria-labelledby="slide-over-title" 
     role="dialog" 
     aria-modal="true">
    
    <!-- Background overlay -->
    <div x-show="drawerOpen"
         x-cloak
         x-transition:enter="tw-transition-opacity tw-ease-in-out tw-duration-500"
         x-transition:enter-start="tw-opacity-0"
         x-transition:enter-end="tw-opacity-100"
         x-transition:leave="tw-transition-opacity tw-ease-in-out tw-duration-500"
         x-transition:leave-start="tw-opacity-100"
         x-transition:leave-end="tw-opacity-0"
         class="tw-fixed tw-inset-0 tw-bg-gray-500 tw-bg-opacity-75 tw-transition-opacity"
         @click="drawerOpen = false">
    </div>

    <div class="tw-fixed tw-inset-x-0 tw-bottom-0 tw-max-h-[95vh] sm:tw-max-h-[90vh] tw-flex">
        <div x-show="drawerOpen"
             x-transition:enter="tw-transform tw-transition tw-ease-in-out tw-duration-500"
             x-transition:enter-start="tw-translate-y-full"
             x-transition:enter-end="tw-translate-y-0"
             x-transition:leave="tw-transform tw-transition tw-ease-in-out tw-duration-500"
             x-transition:leave-start="tw-translate-y-0"
             x-transition:leave-end="tw-translate-y-full"
             class="tw-w-full tw-max-h-[90vh] tw-flex tw-flex-col"
             :style="isDragging ? `transform: translateY(${currentHeight}px)` : ''">
            
            <div class="tw-cursor-grab tw-flex tw-flex-col tw-bg-white tw-shadow-xl tw-rounded-t-3xl tw-h-full"
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
                <div class="tw-py-2 tw-flex tw-justify-center tw-flex-shrink-0">
                    <div class="tw-w-10 tw-h-1 tw-bg-gray-300 tw-rounded-full"></div>
                </div>

                <!-- Header -->
                <div class="tw-px-4 tw-py-6 tw-sm:px-6 tw-flex-shrink-0">
                    <div class="tw-flex tw-items-center tw-justify-between">
                        <h2 class="tw-text-lg tw-font-medium" id="slide-over-title">
                            {{ $title }}
                        </h2>
                        <button @click="drawerOpen = false" class="hover:tw-text-gray-200">
                            <span class="tw-sr-only">Close panel</span>
                            <svg class="tw-h-6 tw-w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Content -->
                <div class="tw-flex-1 tw-overflow-y-auto">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</div> 