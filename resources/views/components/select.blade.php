@props([
    'label' => '',
    'name' => '',
    'placeholder' => 'Select an option',
    'error' => '',
    'options' => [],
    'selected' => ''
])

<div class="tw-mb-4">
    @if($label)
        <label class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-1">{{ $label }}</label>
    @endif

    <select 
        name="{{ $name }}"
        {{ $attributes->merge(['class' => 'tw-w-full tw-rounded-lg tw-border tw-bg-white tw-px-3 tw-py-2 tw-text-sm tw-outline-none focus:tw-ring-2 focus:tw-ring-blue-500/20 ' . ($error ? 'tw-border-red-500' : 'tw-border-gray-300')]) }}
    >
        @if($placeholder)
            <option value="">{{ $placeholder }}</option>
        @endif
        
        @foreach($options as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>
                {{ $label }}
            </option>
        @endforeach
    </select>

    @if($error)
        <p class="tw-mt-1 tw-text-sm tw-text-red-500">{{ $error }}</p>
    @endif
</div> 