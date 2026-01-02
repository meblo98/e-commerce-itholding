<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ReassignImportedProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reassign:imported {--dry-run} {--min-score=3}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Réaffecte les produits de la catégorie "Importés" vers la meilleure catégorie détectée à partir du nom de fichier et déplace les images.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $importCategory = Categorie::where('titre', 'Importés')->orWhere('titre', 'Importes')->first();
        if (! $importCategory) {
            $this->info('Aucune catégorie "Importés" trouvée.');
            return 0;
        }

        $products = Produit::where('categorie_id', $importCategory->id)->get();
        if ($products->isEmpty()) {
            $this->info('Aucun produit à réaffecter dans la catégorie Importés.');
            return 0;
        }

        $categories = Categorie::all();

        foreach ($products as $p) {
            $imagePath = $p->image; // ex: 'produits/importes/file.jpg'
            $filename = pathinfo($imagePath, PATHINFO_BASENAME);
            $nameSlug = Str::slug(pathinfo($filename, PATHINFO_FILENAME));

            $best = null; $bestScore = 0;
            foreach ($categories as $cat) {
                if ($cat->id === $importCategory->id) continue;
                $catSlug = Str::slug($cat->titre);
                $score = 0;
                if (strpos($nameSlug, $catSlug) !== false) $score += 5;
                $words = preg_split('/[^A-Za-z0-9]+/', strtolower($cat->titre));
                foreach ($words as $w) {
                    if (! $w) continue;
                    if (strpos($nameSlug, Str::slug($w)) !== false) $score += 2;
                }
                if ($score > $bestScore) {
                    $bestScore = $score;
                    $best = $cat;
                }
            }

            $minScore = (int) $this->option('min-score');
            if ($best && $bestScore >= $minScore) {
                $this->info("Produit {$p->id} ({$filename}) -> catégorie '{$best->titre}' (score={$bestScore})");
                if (! $this->option('dry-run')) {
                    $oldStoragePath = 'public/' . ltrim($imagePath, '/');
                    $newDir = 'public/produits/' . Str::slug($best->titre);
                    Storage::makeDirectory($newDir);
                    $newStoragePath = $newDir . '/' . $filename;

                    if (Storage::exists($oldStoragePath)) {
                        Storage::move($oldStoragePath, $newStoragePath);
                    } else {
                        // Try to copy from public/assets/img/new_image if present
                        $publicSource = public_path('assets/img/new_image/' . $filename);
                        if (file_exists($publicSource)) {
                            copy($publicSource, storage_path('app/' . $newStoragePath));
                        } else {
                            $this->warn("Fichier source introuvable pour {$filename}, impossible de déplacer.");
                        }
                    }

                    $p->categorie_id = $best->id;
                    $p->image = 'produits/' . Str::slug($best->titre) . '/' . $filename;
                    $p->save();
                }
            } else {
                $this->line("Aucun match pour produit {$p->id} ({$filename}).");
            }
        }

        $this->info('Traitement terminé.');
        return 0;
    }
}
