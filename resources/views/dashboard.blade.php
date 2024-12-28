<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div class="bg-blue-100 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold mb-2">Produits</h3>
                            <p class="text-3xl font-bold">{{ \App\Models\Produit::count() }}</p>
                        </div>
                        
                        <div class="bg-green-100 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold mb-2">Clients</h3>
                            <p class="text-3xl font-bold">{{ \App\Models\Client::count() }}</p>
                        </div>
                        
                        <div class="bg-yellow-100 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold mb-2">Commandes</h3>
                            <p class="text-3xl font-bold">{{ \App\Models\Commande::count() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
