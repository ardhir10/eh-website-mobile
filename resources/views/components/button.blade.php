@props([
    'variant' => 'primary', // primary, secondary, danger, success, warning
    'size' => 'md', // sm, md, lg
    'fullWidth' => false,
    'type' => 'button',
    'disabled' => false,
])

@php
    // Base classes
    $baseClasses = 'tw-inline-flex tw-items-center tw-justify-center tw-font-medium tw-rounded-xl tw-transition-all tw-duration-200 focus:tw-outline-none focus:tw-ring-2 focus:tw-ring-offset-2 disabled:tw-opacity-50 disabled:tw-cursor-not-allowed';

    // Size classes
    $sizeClasses = match($size) {
        'sm' => 'tw-px-3 tw-py-1.5 tw-text-xs',
        'lg' => 'tw-px-6 tw-py-3 tw-text-base',
        default => 'tw-px-4 tw-py-2 tw-text-sm', // md
    };

    // Variant classes
    $variantClasses = match($variant) {
        'secondary' => 'tw-bg-white hover:tw-bg-white/80 tw-text-gray-700 tw-px-4 tw-py-2 tw-rounded-xl tw-text-sm tw-transition-all tw-duration-200 tw-outline-none focus:tw-outline-none focus:tw-ring-0 focus:tw-ring-offset-0 focus:tw-ring-transparent focus:tw-border-transparent',
        'danger' => 'tw-bg-red-500 hover:tw-bg-red-600 tw-text-white tw-px-4 tw-py-2 tw-rounded-xl tw-text-sm tw-transition-all tw-duration-200 tw-outline-none focus:tw-outline-none focus:tw-ring-0 focus:tw-ring-offset-0 focus:tw-ring-transparent focus:tw-border-transparent',
        'success' => 'tw-bg-green-500 hover:tw-bg-green-600 tw-text-white tw-px-4 tw-py-2 tw-rounded-xl tw-text-sm tw-transition-all tw-duration-200 tw-outline-none focus:tw-outline-none focus:tw-ring-0 focus:tw-ring-offset-0 focus:tw-ring-transparent focus:tw-border-transparent',
        'warning' => 'tw-bg-yellow-500 hover:tw-bg-yellow-600 tw-text-white tw-px-4 tw-py-2 tw-rounded-xl tw-text-sm tw-transition-all tw-duration-200 tw-outline-none focus:tw-outline-none focus:tw-ring-0 focus:tw-ring-offset-0 focus:tw-ring-transparent focus:tw-border-transparent',
        default => 'tw-w-full sm:tw-w-auto tw-bg-red-500 hover:tw-bg-red-600 tw-text-white tw-px-4 tw-py-2 tw-rounded-xl tw-text-sm tw-transition-all tw-duration-200 tw-outline-none focus:tw-outline-none focus:tw-ring-0 focus:tw-ring-offset-0 focus:tw-ring-transparent focus:tw-border-transparent', // primary
    };

    // Width classes
    $widthClasses = $fullWidth ? 'tw-w-full' : '';

    $classes = "{$baseClasses} {$sizeClasses} {$variantClasses} {$widthClasses}";
@endphp

<button 
    {{ $attributes->merge([
        'type' => $type,
        'class' => $classes,
        'disabled' => $disabled
    ]) }}
>
    {{ $slot }}
</button> 