@props([
    'type' => 'submit',
    'color' => 'primary'
])
@php
    $colors = [
        'primary' => 'bg-indigo-600 hover:bg-indigo-700 text-white',
        'secondary' => 'bg-gray-200 hover:bg-gray-300 text-gray-800',
        'danger' => 'bg-red-600 hover:bg-red-700 text-white',
    ];
@endphp
<button type="{{ $type }}" {{ $attributes->merge(['class' => 'px-4 py-2 rounded ' . ($colors[$color] ?? $colors['primary'])]) }}>
    {{ $slot }}
</button>
