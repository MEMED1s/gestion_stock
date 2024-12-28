<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-900">{{ $title }}</h2>
        @if(isset($description))
            <p class="mt-1 text-sm text-gray-600">{{ $description }}</p>
        @endif
    </div>

    <form {{ $attributes }}>
        {{ $slot }}
    </form>
</div> 