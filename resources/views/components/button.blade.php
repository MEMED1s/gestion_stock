@props(['variant' => 'primary'])

@php
$variants = [
    'primary' => 'bg-blue-500 hover:bg-blue-700 text-white',
    'secondary' => 'bg-gray-500 hover:bg-gray-700 text-white',
    'success' => 'bg-green-500 hover:bg-green-700 text-white',
    'danger' => 'bg-red-500 hover:bg-red-700 text-white',
];

$classes = $variants[$variant] . ' font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-150 ease-in-out';
@endphp

<button {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</button> 