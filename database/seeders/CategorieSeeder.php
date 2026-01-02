<?php

namespace Database\Seeders;

use App\Models\Categorie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['titre' => 'Ordinateurs Portables', 'description' => 'Laptops, Notebooks et Ultrabooks'],
            ['titre' => 'Ordinateurs de Bureau', 'description' => 'Unités centrales, All-in-One et Stations de travail'],
            ['titre' => 'Imprimantes & Scanners', 'description' => 'Imprimantes laser, jet d\'encre et scanners'],
            ['titre' => 'Photocopieurs', 'description' => 'Photocopieurs multifonctions professionnels'],
            ['titre' => 'Réseaux & WiFi', 'description' => 'Routeurs, Switches, et bornes WiFi'],
            ['titre' => 'Stockage', 'description' => 'SSD, Disques durs externes et NAS'],
            ['titre' => 'Écrans & Moniteurs', 'description' => 'Écrans PC, Moniteurs 4K et incurvés'],
            ['titre' => 'Claviers & Souris', 'description' => 'Périphériques de saisie filaires et sans fil'],
            ['titre' => 'Logiciels & Licences', 'description' => 'Systèmes d\'exploitation et suites bureautiques'],
            ['titre' => 'Accessoires Informatiques', 'description' => 'Câbles, adaptateurs et sacoches'],
        ];

        foreach ($categories as $categorie) {
            Categorie::updateOrCreate(['titre' => $categorie['titre']], $categorie);
        }
    }
}
