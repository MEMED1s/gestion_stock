<?php

namespace Database\Seeders;

use App\Models\Categorie;
use Illuminate\Database\Seeder;

class CategorieSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['nom' => 'Électronique', 'description' => 'Produits électroniques et accessoires'],
            ['nom' => 'Informatique', 'description' => 'Ordinateurs et périphériques'],
            ['nom' => 'Téléphonie', 'description' => 'Smartphones et accessoires'],
            ['nom' => 'Audio', 'description' => 'Casques et enceintes'],
        ];

        foreach ($categories as $categorie) {
            Categorie::create($categorie);
        }
    }
} 