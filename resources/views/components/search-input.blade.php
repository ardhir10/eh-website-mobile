@props([
    'placeholder' => 'Search...',
    'name' => 'search',
    'value' => '',
    'width' => 'auto',
])

<div class="tw-relative tw-w-full sm:tw-w-{{ $width }}">
    <input 
        {{ $attributes->merge([
            'type' => 'text',
            'name' => $name,
            'placeholder' => $placeholder,
            'value' => $value,
            'class' => 'tw-w-full sm:tw-w-auto tw-pl-10 tw-pr-4 tw-py-2 tw-border tw-border-gray-200 tw-rounded-xl tw-text-sm focus:tw-outline-none focus:tw-ring-2 focus:tw-ring-red-500/20 focus:tw-border-red-500 tw-transition-all tw-duration-200'
        ]) }}
    >
    <svg 
        class="tw-absolute tw-left-3 tw-top-1/2 tw-transform -tw-translate-y-1/2 tw-text-gray-400 tw-size-5" 
        fill="none" 
        stroke="currentColor" 
        viewBox="0 0 24 24"
    >
        <path 
            stroke-linecap="round" 
            stroke-linejoin="round" 
            stroke-width="2" 
            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
        />
    </svg>

    <!-- Optional Clear Button -->
    <button 
        type="button"
        @click="$el.previousElementSibling.previousElementSibling.value = ''; $el.previousElementSibling.previousElementSibling.dispatchEvent(new Event('input'))"
        class="tw-absolute tw-right-3 tw-top-1/2 tw-transform -tw-translate-y-1/2 tw-text-gray-400 hover:tw-text-gray-600 tw-hidden"
        x-show="$el.previousElementSibling.previousElementSibling.value.length > 0"
    >
        <svg class="tw-size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
    </button>
</div> 