<?php

namespace Database\Seeders;

use App\Models\Produit;
use App\Models\Categorie;
use App\Models\Fournisseur;
use Illuminate\Database\Seeder;

class ProduitSeeder extends Seeder
{
    public function run()
    {
        $categories = Categorie::all();
        $fournisseurs = Fournisseur::all();

        $produits = [
            [
                'nom' => 'iPhone 15',
                'description' => 'Dernier modèle iPhone',
                'prix' => 999.99,
                'quantite_stock' => 50,
                'categorie_id' => $categories->where('nom', 'Téléphonie')->first()->id,
                'fournisseur_id' => $fournisseurs->first()->id
            ],
            [
                'nom' => 'MacBook Pro',
                'description' => 'Ordinateur portable Apple',
                'prix' => 1499.99,
                'quantite_stock' => 30,
                'categorie_id' => $categories->where('nom', 'Informatique')->first()->id,
                'fournisseur_id' => $fournisseurs->first()->id
            ],
            [
                'nom' => 'AirPods Pro',
                'description' => 'Écouteurs sans fil',
                'prix' => 249.99,
                'quantite_stock' => 100,
                'categorie_id' => $categories->where('nom', 'Audio')->first()->id,
                'fournisseur_id' => $fournisseurs->last()->id
            ],
            [
                'nom' => 'Samsung TV QLED',
                'description' => 'TV 4K 65 pouces',
                'prix' => 1299.99,
                'quantite_stock' => 20,
                'categorie_id' => $categories->where('nom', 'Électronique')->first()->id,
                'fournisseur_id' => $fournisseurs->last()->id
            ],
            [
                'nom' => 'PlayStation 5',
                'description' => 'Console de jeux',
                'prix' => 499.99,
                'quantite_stock' => 15,
                'categorie_id' => $categories->where('nom', 'Électronique')->first()->id,
                'fournisseur_id' => $fournisseurs->first()->id
            ]
        ];

        foreach ($produits as $produit) {
            Produit::create($produit);
        }
    }
} 