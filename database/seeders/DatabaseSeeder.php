<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            CategorieSeeder::class,
            FournisseurSeeder::class,
            ProduitSeeder::class,
            ClientSeeder::class,
            CommandeSeeder::class,
        ]);
    }
}
