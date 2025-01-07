<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Routes pour les ressources
    Route::resource('produits', ProduitController::class);
    Route::resource('categories', CategorieController::class)->parameters([
        'categories' => 'categorie'
    ]);
    Route::resource('fournisseurs', FournisseurController::class);
    Route::resource('clients', ClientController::class);
    Route::resource('commandes', CommandeController::class);

    // Routes du profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
