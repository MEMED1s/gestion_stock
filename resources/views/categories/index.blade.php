@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8" x-data="categoriesManager()">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Catégories</h1>
        <a href="{{ route('categories.create') }}" class="btn-primary">
            Nouvelle Catégorie
        </a>
    </div>

    <div class="bg-white shadow-sm rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produits</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($categories as $categorie)
                <tr id="category-{{ $categorie->id }}" x-show="!deletedCategories.includes({{ $categorie->id }})"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0">
                    <td class="px-6 py-4 whitespace-nowrap">{{ $categorie->nom }}</td>
                    <td class="px-6 py-4">{{ $categorie->description }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $categorie->produits_count }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('categories.edit', $categorie) }}" 
                           class="inline-flex items-center px-3 py-2 text-indigo-600 hover:text-indigo-900 mr-3 rounded-md hover:bg-indigo-50">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            <span>Modifier</span>
                        </a>
                        <button @click="deleteCategory({{ $categorie->id }})" 
                                class="text-red-600 hover:text-red-900"
                                :disabled="isDeleting">
                            <span x-show="!isDeleting">Supprimer</span>
                            <span x-show="isDeleting" class="inline-flex items-center">
                                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Suppression...
                            </span>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $categories->links() }}
    </div>
</div>

@push('scripts')
<script>
function categoriesManager() {
    return {
        isDeleting: false,
        deletedCategories: [],
        
        async deleteCategory(id) {
            if (!confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?')) {
                return;
            }

            this.isDeleting = true;

            try {
                const response = await fetch(`/categories/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();

                if (response.ok) {
                    this.deletedCategories.push(id);
                    // Afficher une notification de succès
                    this.$dispatch('notify', {
                        type: 'success',
                        message: data.message
                    });
                } else {
                    throw new Error(data.message || 'Une erreur est survenue');
                }
            } catch (error) {
                // Afficher une notification d'erreur
                this.$dispatch('notify', {
                    type: 'error',
                    message: error.message
                });
            } finally {
                this.isDeleting = false;
            }
        }
    }
}
</script>
@endpush
@endsection 