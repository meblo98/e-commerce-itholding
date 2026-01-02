<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesFullSeeder extends Seeder
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
            ['titre' => 'Consommables', 'description' => 'Cartouches d\'encre, toners et papier'],
            ['titre' => 'Composants PC', 'description' => 'Processeurs, RAM, Cartes mères'],
            ['titre' => 'Outils de présentation', 'description' => 'Vidéoprojecteurs et tableaux blancs interactifs'],
            ['titre' => 'Sécurité Informatique', 'description' => 'Antivirus, Pare-feu, Caméras IP'],
        ];

        foreach ($categories as $category) {
            // Assure qu'une seule ligne par titre existe et met à jour la description
            DB::table('categories')->updateOrInsert(
                ['titre' => $category['titre']],
                [
                    'description' => $category['description'],
                    'updated_at' => now(),
                    'created_at' => DB::raw('COALESCE(created_at, NOW())'),
                ]
            );
        }

        $this->command->info('✅ 40 catégories importées avec succès!');
    }
}
