@props([
    'variant' => 'primary', // primary, secondary, danger, success, warning
    'size' => 'md', // sm, md, lg
    'fullWidth' => false,
    'type' => 'button',
    'disabled' => false,
])

@php
    // Base classes
    $baseClasses = 'inline-flex items-center justify-center font-medium rounded-xl transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed';

    // Size classes
    $sizeClasses = match($size) {
        'sm' => 'px-3 py-1.5 text-xs',
        'lg' => 'px-6 py-3 text-base',
        default => 'px-4 py-2 text-sm', // md
    };

    // Variant classes
    $variantClasses = match($variant) {
        'secondary' => 'bg-white hover:bg-white/80 text-gray-700 px-4 py-2 rounded-xl text-sm transition-all duration-200 outline-none focus:outline-none focus:ring-0 focus:ring-offset-0 focus:ring-transparent focus:border-transparent',
        'danger' => 'bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl text-sm transition-all duration-200 outline-none focus:outline-none focus:ring-0 focus:ring-offset-0 focus:ring-transparent focus:border-transparent',
        'success' => 'bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-xl text-sm transition-all duration-200 outline-none focus:outline-none focus:ring-0 focus:ring-offset-0 focus:ring-transparent focus:border-transparent',
        'warning' => 'bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-xl text-sm transition-all duration-200 outline-none focus:outline-none focus:ring-0 focus:ring-offset-0 focus:ring-transparent focus:border-transparent',
        default => 'w-full sm:w-auto bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl text-sm transition-all duration-200 outline-none focus:outline-none focus:ring-0 focus:ring-offset-0 focus:ring-transparent focus:border-transparent', // primary
    };

    // Width classes
    $widthClasses = $fullWidth ? 'w-full' : '';

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