@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Commande N° CMD-{{ str_pad($commande->id, 5, '0', STR_PAD_LEFT) }}
            </h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                Détails de la commande
            </p>
        </div>
        <div class="border-t border-gray-200">
            <dl>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Client</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $commande->client->nom }} {{ $commande->client->prenom }}
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Date de commande</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $commande->date_commande->format('d/m/Y') }}
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Statut</dt>
                    <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $commande->statut === 'en_attente' ? 'bg-yellow-100 text-yellow-800' : '' }}
                            {{ $commande->statut === 'validee' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $commande->statut === 'annulee' ? 'bg-red-100 text-red-800' : '' }}">
                            {{ ucfirst(str_replace('_', ' ', $commande->statut)) }}
                        </span>
                    </dd>
                </div>
            </dl>
        </div>
    </div>

    <div class="mt-6 bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Produits commandés</h3>
        </div>
        <div class="border-t border-gray-200">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produit</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantité</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prix unitaire</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($commande->produits as $produit)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $produit->nom }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $produit->pivot->quantite }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ number_format($produit->pivot->prix_unitaire, 2) }} €</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ number_format($produit->pivot->quantite * $produit->pivot->prix_unitaire, 2) }} €</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-gray-50">
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-right font-bold">Total</td>
                        <td class="px-6 py-4 whitespace-nowrap font-bold">{{ number_format($commande->total, 2) }} €</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="mt-6 flex justify-between">
        <a href="{{ route('commandes.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
            Retour à la liste
        </a>
    </div>
</div>
@endsection 