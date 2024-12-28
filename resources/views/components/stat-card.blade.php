@props(['title', 'value', 'color' => 'blue'])

<div class="bg-{{ $color }}-50 border border-{{ $color }}-200 rounded-lg p-6 hover:shadow-lg transition-shadow duration-200">
    <div class="flex items-center">
        <div class="flex-1">
            <h3 class="text-{{ $color }}-600 text-lg font-semibold mb-2">{{ $title }}</h3>
            <p class="text-3xl font-bold text-gray-900">{{ $value }}</p>
        </div>
        {{ $slot ?? '' }}
    </div>
</div> 