<?php

namespace Database\Seeders;

use App\Models\Produit;
use App\Models\Categorie;
use App\Models\Marque;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProduitSeeder extends Seeder
{
    private int $maxProducts = 10;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Directory containing new images grouped by category
        $baseDir = public_path('assets/img/new_image');

        // Ensure there's at least one marque
        $defaultMarque = Marque::first();
        if (! $defaultMarque) {
            $defaultMarque = Marque::create([
                'nom' => 'Generic',
                'description' => 'Marque par défaut',
                'logo' => null,
            ]);
        }

        if (! is_dir($baseDir)) {
            // nothing to import
            return;
        }

        $dirs = scandir($baseDir);

        // Process files placed directly in the base directory (not inside subfolders)
        $rootFiles = array_filter($dirs, function ($f) use ($baseDir) {
            return is_file($baseDir . DIRECTORY_SEPARATOR . $f) && ! in_array($f, ['.', '..']);
        });

        if (count($rootFiles) > 0) {
            $rootCategory = Categorie::firstOrCreate(
                ['titre' => 'Importés'],
                ['description' => 'Produits importés (racine)']
            );

            foreach ($rootFiles as $file) {
                if (Produit::count() >= $this->maxProducts) return;
                $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                if (! in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif'])) continue;

                $source = $baseDir . DIRECTORY_SEPARATOR . $file;
                $targetDir = storage_path('app/public/produits/' . Str::slug($rootCategory->titre));
                if (! is_dir($targetDir)) {
                    mkdir($targetDir, 0755, true);
                }
                $targetPath = $targetDir . DIRECTORY_SEPARATOR . $file;
                copy($source, $targetPath);

                Produit::create([
                    'nom' => pathinfo($file, PATHINFO_FILENAME),
                    'description' => 'Produit importé automatiquement',
                    'image' => 'produits/' . Str::slug($rootCategory->titre) . '/' . $file,
                    'categorie_id' => $rootCategory->id,
                    'marque_id' => $defaultMarque->id,
                    'active' => true,
                    'stock' => rand(5, 30),
                    'prix' => rand(15, 1500) * 1000,
                ]);
            }
        }

        foreach ($dirs as $dir) {
            if ($dir === '.' || $dir === '..') continue;

            $dirPath = $baseDir . DIRECTORY_SEPARATOR . $dir;
            if (! is_dir($dirPath)) continue;

            // Try to find or create a category matching the folder name
            $categorie = Categorie::where('titre', $dir)->first();
            if (! $categorie) {
                // try slug match
                $categorie = Categorie::all()->first(function ($c) use ($dir) {
                    return Str::slug($c->titre) === Str::slug($dir);
                });
            }
            if (! $categorie) {
                $categorie = Categorie::create([
                    'titre' => $dir,
                    'description' => "Produits importés pour la catégorie $dir",
                ]);
            }

            // iterate image files in the folder
            $files = scandir($dirPath);
            foreach ($files as $file) {
                if (Produit::count() >= $this->maxProducts) return;
                if (in_array($file, ['.', '..'])) continue;
                $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                if (! in_array($ext, ['jpg','jpeg','png','webp','gif'])) continue;

                $source = $dirPath . DIRECTORY_SEPARATOR . $file;
                // copy into storage/app/public/produits/<categorie>/
                $targetDir = storage_path('app/public/produits/' . Str::slug($categorie->titre));
                if (! is_dir($targetDir)) {
                    mkdir($targetDir, 0755, true);
                }
                $targetPath = $targetDir . DIRECTORY_SEPARATOR . $file;
                copy($source, $targetPath);

                // create product entry
                Produit::create([
                    'nom' => pathinfo($file, PATHINFO_FILENAME),
                    'description' => 'Produit importé automatiquement',
                    'image' => 'produits/' . Str::slug($categorie->titre) . '/' . $file,
                    'categorie_id' => $categorie->id,
                    'marque_id' => $defaultMarque->id,
                    'active' => true,
                    'stock' => rand(5, 30),
                    'prix' => rand(15, 1500) * 1000,
                ]);
            }
        }
        // Seed some sample IT products
        $this->seedSampleProducts();
    }

    private function seedSampleProducts()
    {
        $hp = Marque::where('nom', 'HP')->first();
        $dell = Marque::where('nom', 'Dell')->first();
        $lenovo = Marque::where('nom', 'Lenovo')->first();
        $apple = Marque::where('nom', 'Apple')->first();
        $epson = Marque::where('nom', 'Epson')->first();

        $laptopCat = Categorie::where('titre', 'Ordinateurs Portables')->first();
        $desktopCat = Categorie::where('titre', 'Ordinateurs de Bureau')->first();
        $printerCat = Categorie::where('titre', 'Imprimantes & Scanners')->first();

        $sampleProducts = [
            [
                'nom' => 'HP EliteBook 840 G8',
                'description' => 'Intel Core i7, 16GB RAM, 512GB SSD, Ultra-thin and lightweight.',
                'image' => 'produits/hp-elitebook.png',
                'categorie_id' => $laptopCat->id ?? null,
                'marque_id' => $hp->id ?? null,
                'active' => true,
                'stock' => 15,
                'prix' => 850000,
            ],
            [
                'nom' => 'Dell XPS 13',
                'description' => 'InfinityEdge display, Intel Core i5, 8GB RAM, 256GB SSD.',
                'image' => 'produits/dell-xps.png',
                'categorie_id' => $laptopCat->id ?? null,
                'marque_id' => $dell->id ?? null,
                'active' => true,
                'stock' => 10,
                'prix' => 750000,
            ],
            [
                'nom' => 'MacBook Pro 14" M1 Pro',
                'description' => 'Apple M1 Pro chip, 16GB RAM, 512GB SSD, Liquid Retina XDR display.',
                'image' => 'produits/macbook-pro.png',
                'categorie_id' => $laptopCat->id ?? null,
                'marque_id' => $apple->id ?? null,
                'active' => true,
                'stock' => 5,
                'prix' => 1450000,
            ],
            [
                'nom' => 'Lenovo ThinkCentre M70q',
                'description' => 'Tiny Desktop, Intel Core i5, 8GB RAM, 256GB SSD.',
                'image' => 'produits/thinkcentre.png',
                'categorie_id' => $desktopCat->id ?? null,
                'marque_id' => $lenovo->id ?? null,
                'active' => true,
                'stock' => 12,
                'prix' => 450000,
            ],
            [
                'nom' => 'Epson EcoTank L3210',
                'description' => 'All-in-One Ink Tank Printer, high-yield ink bottles.',
                'image' => 'produits/epson-l3210.png',
                'categorie_id' => $printerCat->id ?? null,
                'marque_id' => $epson->id ?? null,
                'active' => true,
                'stock' => 20,
                'prix' => 225000,
            ],
        ];

        foreach ($sampleProducts as $product) {
            if (Produit::count() >= $this->maxProducts) return;
            if ($product['categorie_id'] && $product['marque_id']) {
                Produit::create($product);
            }
        }
    }
}
