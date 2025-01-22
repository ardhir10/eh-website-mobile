@props([
    'align' => 'right',
    'width' => '100', // width dalam pixel
    'contentClasses' => 'py-1',
])

@php
$alignmentClasses = match ($align) {
    'left' => 'left-0 origin-top-left',
    'right' => 'right-0 origin-top-right',
    default => 'right-0 origin-top-right',
};
@endphp

<div class="relative" x-data="{ open: false }">
    <!-- Trigger -->
    <div @click="open = !open">
        {{ $trigger }}
    </div>

    <!-- Dropdown Content -->
    <div x-show="open"
         @click.away="open = false"
         x-transition:enter="transition-all ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95 translate-y-[-10px]"
         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
         x-transition:leave="transition-all ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100 translate-y-0"
         x-transition:leave-end="opacity-0 scale-95 translate-y-[-10px]"
         class="absolute {{ $alignmentClasses }} mt-2 bg-white rounded-xl shadow-lg border border-gray-100 z-10"
         :style="{ width: '{{ $width }}px' }"
         x-cloak>
        <div class="{{ $contentClasses }}">
            {{ $slot }}
        </div>
    </div>
</div> 