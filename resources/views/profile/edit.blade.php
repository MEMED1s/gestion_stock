@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="space-y-10">
        <!-- En-tête -->
        <div class="border-b border-gray-200 pb-5">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:leading-9 sm:truncate">
                Profil Utilisateur
            </h2>
            <p class="mt-2 max-w-4xl text-sm text-gray-500">
                Gérez vos informations personnelles et vos préférences de compte.
            </p>
        </div>

        <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
            <!-- Menu latéral -->
            <div class="space-y-6">
                <nav class="space-y-2">
                    <a href="#profile-info" 
                       class="flex items-center px-4 py-2 text-sm font-medium text-primary-700 bg-primary-50 rounded-lg group hover:bg-primary-100">
                        <svg class="w-5 h-5 mr-3 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Informations du profil
                    </a>
                    <a href="#security" 
                       class="flex items-center px-4 py-2 text-sm font-medium text-gray-600 rounded-lg group hover:bg-gray-50">
                        <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        Sécurité
                    </a>
                </nav>

                <!-- Carte de profil -->
                <div class="bg-white overflow-hidden shadow rounded-lg divide-y divide-gray-200">
                    <div class="px-4 py-5 sm:px-6 text-center">
                        <div class="relative inline-block">
                            <div class="h-24 w-24 rounded-full bg-gradient-to-r from-primary-400 to-primary-600 flex items-center justify-center text-white text-3xl font-bold">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                        </div>
                        <h3 class="mt-4 text-lg font-medium text-gray-900">{{ auth()->user()->name }}</h3>
                        <p class="mt-1 text-sm text-gray-500">{{ auth()->user()->email }}</p>
                    </div>
                    <div class="px-4 py-4 sm:px-6">
                        <dl class="space-y-3 text-sm">
                            <div class="flex justify-between">
                                <dt class="text-gray-500">Membre depuis</dt>
                                <dd class="text-gray-900">{{ auth()->user()->created_at->format('d/m/Y') }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-gray-500">Dernière connexion</dt>
                                <dd class="text-gray-900">{{ now()->format('d/m/Y H:i') }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>

            <!-- Contenu principal -->
            <div class="md:col-span-2 space-y-6">
                <!-- Informations du profil -->
                <div id="profile-info" class="bg-white shadow rounded-lg divide-y divide-gray-200">
                    <div class="px-4 py-5 sm:px-6">
                        <h3 class="text-lg font-medium text-gray-900">Informations du profil</h3>
                        <p class="mt-1 text-sm text-gray-500">Mettez à jour vos informations personnelles.</p>
                    </div>
                    <div class="px-4 py-5 sm:p-6">
                        <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                            @csrf
                            @method('patch')

                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                                <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex justify-end">
                                <button type="submit" class="btn-primary">
                                    Mettre à jour
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Sécurité -->
                <div id="security" class="bg-white shadow rounded-lg divide-y divide-gray-200">
                    <div class="px-4 py-5 sm:px-6">
                        <h3 class="text-lg font-medium text-gray-900">Sécurité</h3>
                        <p class="mt-1 text-sm text-gray-500">Mettez à jour votre mot de passe.</p>
                    </div>
                    <div class="px-4 py-5 sm:p-6">
                        <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                            @csrf
                            @method('put')

                            <div>
                                <label for="current_password" class="block text-sm font-medium text-gray-700">Mot de passe actuel</label>
                                <input type="password" name="current_password" id="current_password"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                                @error('current_password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700">Nouveau mot de passe</label>
                                <input type="password" name="password" id="password"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                                @error('password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmer le mot de passe</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                            </div>

                            <div class="flex justify-end">
                                <button type="submit" class="btn-primary">
                                    Mettre à jour le mot de passe
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Supprimer le compte -->
                <div class="bg-white shadow rounded-lg divide-y divide-gray-200">
                    <div class="px-4 py-5 sm:px-6">
                        <h3 class="text-lg font-medium text-red-600">Zone dangereuse</h3>
                        <p class="mt-1 text-sm text-gray-500">Une fois votre compte supprimé, toutes ses ressources et données seront définitivement effacées.</p>
                    </div>
                    <div class="px-4 py-5 sm:p-6">
                        <form method="post" action="{{ route('profile.destroy') }}" class="space-y-6">
                            @csrf
                            @method('delete')

                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                                <input type="password" name="password" id="password"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm"
                                    placeholder="Entrez votre mot de passe pour confirmer">
                                @error('password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex justify-end">
                                <button type="submit" class="btn-danger"
                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.')">
                                    Supprimer le compte
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
