@props([
    'label' => '',
    'type' => 'text',
    'name',
    'value' => '',
    'required' => false,
])
<div class="mb-4">
    @if($label)
        <label for="{{ $name }}" class="block mb-1 font-semibold">{{ $label }}</label>
    @endif
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ old($name, $value) }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'border rounded px-3 py-2 w-full']) }}
    >
</div>
