@props(['id', 'title'])

<div class="bg-white rounded-lg shadow p-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">{{ $title }}</h3>
    <div class="h-64">
        <canvas id="{{ $id }}"></canvas>
    </div>
</div> 