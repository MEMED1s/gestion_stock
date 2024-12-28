<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Fournisseur extends Model
{
    protected $fillable = [
        'nom',
        'email',
        'telephone',
        'adresse'
    ];

    public function produits(): HasMany
    {
        return $this->hasMany(Produit::class);
    }
} 