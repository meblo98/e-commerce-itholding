<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | 1️⃣ ADMIN
        |--------------------------------------------------------------------------
        */
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'lastname' => 'Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'phone' => '771425249',
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | 2️⃣ MARQUES
        |--------------------------------------------------------------------------
        */
        $this->call(MarqueSeeder::class);

        /*
        |--------------------------------------------------------------------------
        | 3️⃣ CATÉGORIES DE BASE
        |--------------------------------------------------------------------------
        */
        $this->call(CategorieSeeder::class);

        /*
        |--------------------------------------------------------------------------
        | 4️⃣ CATÉGORIES COMPLÈTES (UPDATE / INSERT)
        |--------------------------------------------------------------------------
        */
        $this->call(CategoriesFullSeeder::class);

        /*
        |--------------------------------------------------------------------------
        | 5️⃣ NETTOYAGE DES DOUBLONS
        |--------------------------------------------------------------------------
        */
        $this->call(DeduplicateCategoriesSeeder::class);

        /*
        |--------------------------------------------------------------------------
        | 6️⃣ PRODUITS (⚠️ LOURDS – À LANCER MANUELLEMENT)
        |--------------------------------------------------------------------------
        |
        | Décommente et lance UN PAR UN si nécessaire
        |
        */

        $this->call(ProduitSeeder::class);
        // $this->call(JsonProductsSeeder::class);
        // $this->call(ScrapCategoriesSeeder::class);
    }
}
