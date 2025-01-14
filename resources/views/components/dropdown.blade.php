@props([
    'align' => 'right',
    'width' => '100', // width dalam pixel
    'contentClasses' => 'tw-py-1',
])

@php
$alignmentClasses = match ($align) {
    'left' => 'tw-left-0 tw-origin-top-left',
    'right' => 'tw-right-0 tw-origin-top-right',
    default => 'tw-right-0 tw-origin-top-right',
};
@endphp

<div class="tw-relative" x-data="{ open: false }">
    <!-- Trigger -->
    <div @click="open = !open">
        {{ $trigger }}
    </div>

    <!-- Dropdown Content -->
    <div x-show="open"
         @click.away="open = false"
         x-transition:enter="tw-transition-all tw-ease-out tw-duration-300"
         x-transition:enter-start="tw-opacity-0 tw-scale-95 tw-translate-y-[-10px]"
         x-transition:enter-end="tw-opacity-100 tw-scale-100 tw-translate-y-0"
         x-transition:leave="tw-transition-all tw-ease-in tw-duration-200"
         x-transition:leave-start="tw-opacity-100 tw-scale-100 tw-translate-y-0"
         x-transition:leave-end="tw-opacity-0 tw-scale-95 tw-translate-y-[-10px]"
         class="tw-absolute {{ $alignmentClasses }} tw-mt-2 tw-bg-white tw-rounded-xl tw-shadow-lg tw-border tw-border-gray-100 tw-z-10"
         :style="{ width: '{{ $width }}px' }"
         x-cloak>
        <div class="{{ $contentClasses }}">
            {{ $slot }}
        </div>
    </div>
</div> 