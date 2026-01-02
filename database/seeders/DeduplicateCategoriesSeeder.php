<?php

namespace Database\Seeders;

use App\Models\Categorie;
use App\Models\Produit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DeduplicateCategoriesSeeder extends Seeder
{
    public function run(): void
    {
        $groups = Categorie::all()->groupBy('titre');

        $dupTitles = $groups->filter(fn($items) => $items->count() > 1);

        if ($dupTitles->isEmpty()) {
            $this->command->info('✅ Aucune catégorie dupliquée trouvée.');
            return;
        }

        $this->command->info('🔧 Fusion des catégories dupliquées…');

        DB::transaction(function () use ($dupTitles) {
            foreach ($dupTitles as $titre => $items) {
                $sorted = $items->sortBy('id')->values();
                $canonical = $sorted->first();
                $duplicates = $sorted->slice(1);

                foreach ($duplicates as $dup) {
                    // Réassigner les produits vers la catégorie canonique
                    Produit::where('categorie_id', $dup->id)
                        ->update(['categorie_id' => $canonical->id]);

                    // Supprimer la catégorie dupliquée
                    Categorie::where('id', $dup->id)->delete();
                }

                Log::info('Catégorie fusionnée', [
                    'titre' => $titre,
                    'canonique_id' => $canonical->id,
                    'supprimees' => $duplicates->pluck('id')->all(),
                ]);
            }
        });

        $this->command->info('✅ Fusion terminée. Les doublons ont été supprimés.');
    }
}
