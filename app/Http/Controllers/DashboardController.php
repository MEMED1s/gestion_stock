<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Client;
use App\Models\Produit;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'ventesMensuelles' => Commande::getVentesMensuelles(),
            'produitsPopulaires' => Commande::getProduitsPopulaires(),
            'totalClients' => Client::count(),
            'totalProduits' => Produit::count(),
            'totalCommandes' => Commande::count(),
            'chiffreAffaires' => Commande::sum('total'),
        ]);
    }
} 