<?php

namespace Database\Seeders;

use App\Models\Fournisseur;
use Illuminate\Database\Seeder;

class FournisseurSeeder extends Seeder
{
    public function run(): void
    {
        $fournisseurs = [
            [
                'nom' => 'TechSupply',
                'email' => 'contact@techsupply.com',
                'telephone' => '0600000001',
                'adresse' => '123 Rue de la Technologie, 75001 Paris'
            ],
            [
                'nom' => 'ElectroPlus',
                'email' => 'info@electroplus.com',
                'telephone' => '0600000002',
                'adresse' => '456 Avenue de l\'Électronique, 69001 Lyon'
            ],
        ];

        foreach ($fournisseurs as $fournisseur) {
            Fournisseur::create($fournisseur);
        }
    }
} 