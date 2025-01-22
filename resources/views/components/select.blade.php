@props([
    'label' => '',
    'name' => '',
    'placeholder' => 'Select an option',
    'error' => '',
    'options' => [],
    'selected' => ''
])

<div class="mb-4">
    @if($label)
        <label class="block text-sm font-medium text-gray-700 mb-1">{{ $label }}</label>
    @endif

    <select 
        name="{{ $name }}"
        {{ $attributes->merge(['class' => 'w-full rounded-lg border bg-white px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-blue-500/20 ' . ($error ? 'border-red-500' : 'border-gray-300')]) }}
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
        <p class="mt-1 text-sm text-red-500">{{ $error }}</p>
    @endif
</div> 