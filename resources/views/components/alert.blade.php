@props(['type' => 'success', 'message'])

@php
    $classes = match($type) {
        'success' => 'bg-green-100 border-green-300 text-green-700',
        'error' => 'bg-red-100 border-red-300 text-red-700',
        'warning' => 'bg-yellow-100 border-yellow-300 text-yellow-700',
        default => 'bg-gray-100 border-gray-300 text-gray-700',
    };
@endphp

<div class="border px-4 py-3 rounded-lg mb-4 {{ $classes }}">
    {{ $message }}
</div>