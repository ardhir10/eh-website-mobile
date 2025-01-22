@props([
    'placeholder' => 'Search...',
    'name' => 'search',
    'value' => '',
    'width' => 'auto',
])

<div class="relative w-full sm:w-{{ $width }}">
    <input 
        {{ $attributes->merge([
            'type' => 'text',
            'name' => $name,
            'placeholder' => $placeholder,
            'value' => $value,
            'class' => 'w-full sm:w-auto pl-10 pr-4 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all duration-200'
        ]) }}
    >
    <svg 
        class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 size-5" 
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
        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 hidden"
        x-show="$el.previousElementSibling.previousElementSibling.value.length > 0"
    >
        <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
    </button>
</div> 