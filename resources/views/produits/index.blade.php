@extends('layouts.app')

@section('content')
<div class="animate-fade-in">
    <div class="card shadow-soft hover-scale">
        <div class="card-header">
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">Liste des Produits</h2>
                <a href="{{ route('produits.create') }}" class="btn-primary">
                    Nouveau Produit
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="table-container">
                <table class="table">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prix</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catégorie</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($produits as $produit)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $produit->nom }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ number_format($produit->prix, 2) }} €</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $produit->quantite_stock }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $produit->categorie->nom }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('produits.edit', $produit) }}" class="text-indigo-600 hover:text-indigo-900">Modifier</a>
                                <form action="{{ route('produits.destroy', $produit) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="ml-2 text-red-600 hover:text-red-900">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection 