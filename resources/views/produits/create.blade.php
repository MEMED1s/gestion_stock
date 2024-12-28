@extends('layouts.app')

@section('content')
<x-form-section title="Nouveau Produit" action="{{ route('produits.store') }}" method="POST">
    @csrf

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
            <input type="text" name="nom" id="nom" value="{{ old('nom') }}" 
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            @error('nom')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="prix" class="block text-sm font-medium text-gray-700">Prix</label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <span class="text-gray-500 sm:text-sm">€</span>
                </div>
                <input type="number" step="0.01" name="prix" id="prix" value="{{ old('prix') }}"
                    class="pl-7 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>
            @error('prix')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Continuez avec les autres champs... -->

        <div class="col-span-2 mt-6 flex items-center justify-end space-x-3">
            <a href="{{ route('produits.index') }}" class="text-gray-600 hover:text-gray-800">Annuler</a>
            <x-button type="submit">Créer le produit</x-button>
        </div>
    </div>
</x-form-section>
@endsection 