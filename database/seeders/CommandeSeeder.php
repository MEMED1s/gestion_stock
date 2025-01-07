<?php

namespace Database\Seeders;

use App\Models\Commande;
use App\Models\Client;
use App\Models\Produit;
use Illuminate\Database\Seeder;

class CommandeSeeder extends Seeder
{









    public function run()
    {

        $clients = Client::all();
        $produits = Produit::all();

        foreach ($clients as $client) {
            $commande = Commande::create([
                'client_id' => $client->id,
                'date_commande' => now(),
                'statut' => 'validée',
                    'total' => 0
            ]);
            $total = 0;
            foreach ($produits->random(rand(1, 3)) as $produit) {
                $quantite = rand(1, 5);
                $prix_unitaire = $produit->prix;
                $total += $quantite * $prix_unitaire;

                $commande->produits()->attach($produit->id, [
                    'quantite' => $quantite,
                    'prix_unitaire' => $prix_unitaire
                ]);
            }

                $commande->update(['total' => $total]);
        }
    }













}
