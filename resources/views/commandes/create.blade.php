@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-4">Nouvelle Commande</h2>

    <form action="{{ route('commandes.store') }}" method="POST" id="commande-form">
        @csrf

        <div class="mb-4">
            <label for="client_id" class="block text-gray-700 text-sm font-bold mb-2">Client</label>
            <select name="client_id" id="client_id" required
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">Sélectionnez un client</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                        {{ $client->nom }} {{ $client->prenom }}
                    </option>
                @endforeach
            </select>
            @error('client_id')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="date_commande" class="block text-gray-700 text-sm font-bold mb-2">Date de commande</label>
            <input type="date" name="date_commande" id="date_commande" value="{{ old('date_commande', date('Y-m-d')) }}" required
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('date_commande')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <h3 class="text-lg font-semibold mb-2">Produits</h3>
            <div id="produits-container">
                <div class="produit-item grid grid-cols-3 gap-4 mb-4">
                    <div>
                        <select name="produits[0][id]" required
                            class="produit-select shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="">Sélectionnez un produit</option>
                            @foreach($produits as $produit)
                                <option value="{{ $produit->id }}" data-prix="{{ $produit->prix }}" data-stock="{{ $produit->quantite_stock }}">
                                    {{ $produit->nom }} (Stock: {{ $produit->quantite_stock }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <input type="number" name="produits[0][quantite]" min="1" placeholder="Quantité" required
                            class="quantite-input shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="flex items-center">
                        <span class="prix-unitaire mr-2">0.00 €</span>
                        <button type="button" class="remove-produit text-red-600 hover:text-red-800" style="display: none;">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <button type="button" id="add-produit" class="mt-2 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Ajouter un produit
            </button>
        </div>

        <div class="flex items-center justify-between mt-6">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Créer la commande
            </button>
            <a href="{{ route('commandes.index') }}" class="text-gray-600 hover:text-gray-800">Annuler</a>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let produitCount = 1;
    const container = document.getElementById('produits-container');
    const addButton = document.getElementById('add-produit');

    function updatePrixUnitaire(select, priceSpan) {
        const option = select.options[select.selectedIndex];
        if (option && option.dataset.prix) {
            priceSpan.textContent = `${parseFloat(option.dataset.prix).toFixed(2)} €`;
        } else {
            priceSpan.textContent = '0.00 €';
        }
    }

    function createProduitItem() {
        const template = container.children[0].cloneNode(true);
        const select = template.querySelector('select');
        const quantiteInput = template.querySelector('input');
        const removeButton = template.querySelector('.remove-produit');
        const priceSpan = template.querySelector('.prix-unitaire');

        select.name = `produits[${produitCount}][id]`;
        select.value = '';
        quantiteInput.name = `produits[${produitCount}][quantite]`;
        quantiteInput.value = '';
        removeButton.style.display = 'block';

        select.addEventListener('change', () => updatePrixUnitaire(select, priceSpan));
        removeButton.addEventListener('click', () => template.remove());

        container.appendChild(template);
        produitCount++;
    }

    addButton.addEventListener('click', createProduitItem);

    // Setup initial event listeners
    const initialSelect = container.querySelector('select');
    const initialPriceSpan = container.querySelector('.prix-unitaire');
    initialSelect.addEventListener('change', () => updatePrixUnitaire(initialSelect, initialPriceSpan));
});
</script>
@endpush
@endsection 