<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    public function run()
    {
        $clients = [
            [
                'nom' => 'Dupont',
                'prenom' => 'Jean',
                'email' => 'jean.dupont@example.com',
                'telephone' => '0600000001',
                'adresse' => '123 Rue de Paris, 75001 Paris'
            ],
            [
                'nom' => 'Martin',
                'prenom' => 'Marie',
                'email' => 'marie.martin@example.com',
                'telephone' => '0600000002',
                'adresse' => '456 Avenue des Champs-Élysées, 75008 Paris'
            ],
            [
                'nom' => 'Durand',
                'prenom' => 'Pierre',
                'email' => 'pierre.durand@example.com',
                'telephone' => '0600000003',
                'adresse' => '789 Boulevard Saint-Germain, 75006 Paris'
            ]
        ];

        foreach ($clients as $client) {
            Client::create($client);
        }
    }
} 