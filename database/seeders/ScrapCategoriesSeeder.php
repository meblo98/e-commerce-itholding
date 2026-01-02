<?php

namespace Database\Seeders;

use App\Models\Categorie;
use App\Models\Image;
use App\Models\Produit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ScrapCategoriesSeeder extends Seeder
{
    private $categoryMapping = [
        'barre_de_son' => 'Barre de Son',
        'chambre_a_coucher' => 'Chambre a Coucher',
        'chauffe_eau' => 'Chauffe Eau',
        'cuisinieres' => 'Cuisinier',
        'home_cinema' => 'Home Cinema',
        'hottes_de_cuisine' => 'Hotte de Cuisine',
        'matelas' => 'Matelas',
        'mini_chaine' => 'Mini Chaine',
        'plaques_de_cuisson' => 'Plaque',
        'refrigerateurs' => 'Réfrigérateur',
        'salon' => 'Salon',
        'seche_linge' => 'Sèche Linge',
        'table_a_manger' => 'Table a Manger',
        'table_tv' => 'Table Téléviseur',
        'televiseurs' => 'Téléviseur',
        'seche_cheveux' => 'Sèche Cheveux', // Au cas où
        'lave_vaisselle' => 'Lave Vaisselle', // Au cas où
        'climatiseur' => 'Climatiseur', // Au cas où
    ];

    public function run(): void
    {
        $jsonDir = public_path('assets/ScrappCategory');
        
        if (!File::isDirectory($jsonDir)) {
            $this->command->error("Le dossier {$jsonDir} n'existe pas.");
            return;
        }

        // Récupérer tous les dossiers images_*
        $folders = File::directories($jsonDir);
        
        if (empty($folders)) {
            $this->command->warn("Aucun dossier trouvé dans {$jsonDir}");
            return;
        }

        $this->command->info("Traitement de " . count($folders) . " dossier(s)...\n");

        foreach ($folders as $folder) {
            $this->processFolder($folder);
        }

        $this->command->info("\n✅ Import terminé !");
    }

    private function processFolder(string $folderPath): void
    {
        $folderName = basename($folderPath);
        
        // Extraire le nom de la catégorie du dossier (enlever "images_" au début)
        $categoryKey = str_replace('images_', '', $folderName);
        
        // Vérifier si on a un mapping pour cette catégorie
        if (!isset($this->categoryMapping[$categoryKey])) {
            $this->command->warn("⚠️  Pas de mapping pour le dossier: {$folderName}");
            return;
        }

        $categoryName = $this->categoryMapping[$categoryKey];
        $categorie = Categorie::where('titre', $categoryName)->first();
        
        if (!$categorie) {
            $this->command->warn("⚠️  Catégorie '{$categoryName}' introuvable en base.");
            return;
        }

        // Chercher le fichier JSON dans ce dossier
        $jsonFiles = File::glob($folderPath . '/*_complets.json');
        
        if (empty($jsonFiles)) {
            $this->command->warn("⚠️  Aucun fichier JSON trouvé dans {$folderName}");
            return;
        }

        $jsonFile = $jsonFiles[0];
        $this->command->info("\n📦 Traitement du dossier: {$folderName} → {$categoryName}");

        // Lire le JSON
        $jsonContent = File::get($jsonFile);
        $products = json_decode($jsonContent, true);

        if (!is_array($products)) {
            $this->command->error("✗ Erreur de parsing JSON pour {$folderName}");
            return;
        }

        $successCount = 0;
        $errorCount = 0;
        $total = count($products);

        $this->command->info("→ {$total} produit(s) à importer");

        foreach ($products as $index => $productData) {
            try {
                $this->importProduct($productData, $categorie->id, $folderPath);
                $successCount++;
                $this->command->info("  [{$successCount}/{$total}] ✓ {$productData['titre']}");
            } catch (\Exception $e) {
                $errorCount++;
                $lineNum = $index + 1;
                $this->command->error("  [{$lineNum}/{$total}] ✗ Erreur: " . $e->getMessage());
                Log::error('Erreur import produit SCRAP', [
                    'produit' => $productData['titre'] ?? 'inconnu',
                    'erreur' => $e->getMessage(),
                ]);
            }
        }

        $this->command->info("📊 Résumé {$folderName}: {$successCount} succès, {$errorCount} erreurs");
    }

    private function importProduct(array $data, int $categorieId, string $folderPath): void
    {
        // Vérifier si le produit existe déjà
        $existingProduct = Produit::where('nom', $data['titre'])->first();
        if ($existingProduct) {
            throw new \Exception("Produit déjà existant (ignoré)");
        }

        // Récupérer l'image principale
        $mainImagePath = $data['image_principale'] ?? ($data['images'][0] ?? null);
        
        if (!$mainImagePath) {
            throw new \Exception("Aucune image disponible");
        }

        // Télécharger l'image
        $imagePath = $this->downloadImage($mainImagePath, $data['titre'], $folderPath);

        // Créer le produit
        $produit = Produit::create([
            'nom' => $data['titre'],
            'description' => !empty($data['description']) ? $data['description'] : 'Description non disponible.',
            'image' => $imagePath,
            'categorie_id' => $categorieId,
            'marque_id' => null, // Pas de marque
            'active' => true,
            'stock' => rand(5, 30),
        ]);

        // Créer une entrée dans la table images
        Image::create([
            'produit_id' => $produit->id,
            'chemin' => $imagePath,
            'ordre' => 0,
        ]);

        // Importer les images supplémentaires
        if (!empty($data['images'])) {
            foreach ($data['images'] as $index => $imgPath) {
                if ($imgPath !== $mainImagePath) {
                    try {
                        $additionalImagePath = $this->downloadImage($imgPath, $data['titre'], $folderPath);
                        Image::create([
                            'produit_id' => $produit->id,
                            'chemin' => $additionalImagePath,
                            'ordre' => $index,
                        ]);
                    } catch (\Exception $e) {
                        Log::warning('Téléchargement image supplémentaire échoué', [
                            'image' => $imgPath,
                            'erreur' => $e->getMessage()
                        ]);
                    }
                }
            }
        }
    }

    private function downloadImage(string $imagePath, string $productName, string $folderPath): string
    {
        try {
            // Construire le chemin complet de l'image
            $fullImagePath = $folderPath . '/' . basename($imagePath);
            
            // Vérifier si le fichier existe localement
            if (!File::exists($fullImagePath)) {
                throw new \Exception("Fichier local non trouvé: {$fullImagePath}");
            }

            // Lire le fichier local
            $imageContent = File::get($fullImagePath);
            
            // Extraire l'extension
            $extension = pathinfo($imagePath, PATHINFO_EXTENSION);
            if (empty($extension) || !in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                $extension = 'jpg';
            }

            // Générer un nom de fichier unique
            $fileName = Str::slug(Str::limit($productName, 40, '')) . '_' . time() . '_' . rand(1000, 9999) . '.' . $extension;
            $filePath = 'produits/' . $fileName;

            // Sauvegarder l'image
            Storage::disk('public')->put($filePath, $imageContent);

            return $filePath;
        } catch (\Exception $e) {
            Log::warning('Téléchargement image échoué', [
                'image' => $imagePath,
                'produit' => $productName,
                'erreur' => $e->getMessage()
            ]);
            
            return 'placeholder.png';
        }
    }
}
