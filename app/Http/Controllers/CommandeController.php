<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Client;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommandeController extends Controller
{
    public function index()
    {
        $commandes = Commande::with(['client', 'produits'])->latest()->paginate(10);
        return view('commandes.index', compact('commandes'));
    }

    public function create()
    {
        $clients = Client::all();
        $produits = Produit::where('quantite_stock', '>', 0)->get();
        return view('commandes.create', compact('clients', 'produits'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'date_commande' => 'required|date',
            'produits' => 'required|array',
            'produits.*.id' => 'required|exists:produits,id',
            'produits.*.quantite' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($validated) {
            $commande = Commande::create([
                'client_id' => $validated['client_id'],
                'date_commande' => $validated['date_commande'],
                'statut' => 'en_attente',
                'total' => 0
            ]);

            $total = 0;
            foreach ($validated['produits'] as $produitData) {
                $produit = Produit::find($produitData['id']);
                $prix_unitaire = $produit->prix;
                $quantite = $produitData['quantite'];

                $commande->produits()->attach($produit->id, [
                    'quantite' => $quantite,
                    'prix_unitaire' => $prix_unitaire
                ]);

                $total += $prix_unitaire * $quantite;
                
                // Mise à jour du stock
                $produit->decrement('quantite_stock', $quantite);
            }

            $commande->update(['total' => $total]);
        });

        return redirect()->route('commandes.index')
            ->with('success', 'Commande créée avec succès.');
    }

    public function show(Commande $commande)
    {
        $commande->load(['client', 'produits']);
        return view('commandes.show', compact('commande'));
    }

    public function destroy(Commande $commande)
    {
        $commande->delete();

        return redirect()->route('commandes.index')
            ->with('success', 'Commande supprimée avec succès.');
    }
} 