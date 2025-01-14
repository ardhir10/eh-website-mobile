@props(['href' => '#'])

<a href="{{ $href }}" 
   {{ $attributes->merge(['class' => 'tw-block tw-px-4 tw-py-2 tw-text-sm tw-text-gray-700 hover:tw-bg-gray-50']) }}>
    {{ $slot }}
</a> 