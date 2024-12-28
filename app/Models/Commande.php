<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

class Commande extends Model
{
    protected $fillable = [
        'client_id',
        'date_commande',
        'statut',
        'total'
    ];

    protected $casts = [
        'date_commande' => 'datetime',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function produits(): BelongsToMany
    {
        return $this->belongsToMany(Produit::class, 'contenir')
            ->withPivot('quantite', 'prix_unitaire');
    }

    public static function getVentesMensuelles()
    {
        return static::select(
            DB::raw('MONTH(created_at) as mois'),
            DB::raw('YEAR(created_at) as annee'),
            DB::raw('SUM(total) as total_ventes'),
            DB::raw('COUNT(*) as nombre_commandes')
        )
        ->whereYear('created_at', date('Y'))
        ->groupBy('annee', 'mois')
        ->orderBy('annee')
        ->orderBy('mois')
        ->get();
    }

    public static function getProduitsPopulaires()
    {
        return DB::table('contenir')
            ->join('produits', 'contenir.produit_id', '=', 'produits.id')
            ->select(
                'produits.nom',
                DB::raw('SUM(contenir.quantite) as quantite_totale'),
                DB::raw('SUM(contenir.quantite * contenir.prix_unitaire) as chiffre_affaires')
            )
            ->groupBy('produits.id', 'produits.nom')
            ->orderByDesc('quantite_totale')
            ->limit(5)
            ->get();
    }
} 