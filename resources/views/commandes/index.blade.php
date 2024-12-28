@extends('layouts.app')

@section('content')
<div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-5 sm:px-6 flex justify-between">
        <h2 class="text-lg leading-6 font-medium text-gray-900">Liste des Commandes</h2>
        <a href="{{ route('commandes.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Nouvelle Commande
        </a>
    </div>
    <div class="border-t border-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">N° Commande</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($commandes as $commande)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">CMD-{{ str_pad($commande->id, 5, '0', STR_PAD_LEFT) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $commande->client->nom }} {{ $commande->client->prenom }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $commande->date_commande->format('d/m/Y') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $commande->statut === 'en_attente' ? 'bg-yellow-100 text-yellow-800' : '' }}
                            {{ $commande->statut === 'validee' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $commande->statut === 'annulee' ? 'bg-red-100 text-red-800' : '' }}">
                            {{ ucfirst(str_replace('_', ' ', $commande->statut)) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ number_format($commande->total, 2) }} €</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('commandes.show', $commande) }}" class="text-blue-600 hover:text-blue-900 mr-3">Voir</a>
                        <form action="{{ route('commandes.destroy', $commande) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="px-4 py-3">
        {{ $commandes->links() }}
    </div>
</div>
@endsection 