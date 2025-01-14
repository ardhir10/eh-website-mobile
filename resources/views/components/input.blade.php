@props([
    'label' => '',
    'type' => 'text',
    'name' => '',
    'value' => '',
    'placeholder' => '',
    'error' => ''
])

<div class="tw-mb-4">
    @if($label)
        <label class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-1">{{ $label }}</label>
    @endif
    
    <input 
        type="{{ $type }}"
        name="{{ $name }}"
        value="{{ $value }}"
        placeholder="{{ $placeholder }}"
        {{ $attributes->merge(['class' => 'input tw-w-full tw-text-black ' . ($error ? 'tw-border-red-500' : 'tw-border-gray-300')]) }}
    >
    
    @if($error)
        <p class="tw-mt-1 tw-text-sm tw-text-red-500">{{ $error }}</p>
    @endif
</div> 