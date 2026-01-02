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

class JsonProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonDir = public_path('assets/database');

        if (!File::isDirectory($jsonDir)) {
            $this->command->error("Le dossier {$jsonDir} n'existe pas.");
            return;
        }

        $jsonFiles = File::glob($jsonDir . '/*.json');

        if (empty($jsonFiles)) {
            $this->command->warn("Aucun fichier JSON trouvé dans {$jsonDir}");
            return;
        }

        $this->command->info("Traitement de " . count($jsonFiles) . " fichier(s) JSON...");

        foreach ($jsonFiles as $filePath) {
            $this->processJsonFile($filePath);
        }

        $this->command->info("✅ Import terminé !");
    }

    /**
     * Process a single JSON file
     */
    private function processJsonFile(string $filePath): void
    {
        $fileName = pathinfo($filePath, PATHINFO_FILENAME);
        $this->command->info("\n📦 Traitement du fichier: {$fileName}.json");

        // Trouver la catégorie correspondante
        $categorie = Categorie::where('titre', 'LIKE', '%' . $fileName . '%')->first();

        if (!$categorie) {
            $this->command->warn("⚠️  Catégorie '{$fileName}' introuvable en base. Fichier ignoré.");
            return;
        }

        $this->command->info("✓ Catégorie trouvée: {$categorie->titre} (ID: {$categorie->id})");

        // Lire le JSON
        $jsonContent = File::get($filePath);
        $products = json_decode($jsonContent, true);

        if (!is_array($products)) {
            $this->command->error("✗ Erreur de parsing JSON pour {$fileName}.json");
            return;
        }

        $successCount = 0;
        $errorCount = 0;
        $total = count($products);

        $this->command->info("→ {$total} produit(s) à importer");

        foreach ($products as $index => $productData) {
            try {
                $this->importProduct($productData, $categorie->id);
                $successCount++;
                $titre = $productData['titre'] ?? 'Sans titre';
                $this->command->info("  [{$successCount}/{$total}] ✓ {$titre}");
            } catch (\Exception $e) {
                $errorCount++;
                $num = $index + 1;
                $msg = $e->getMessage();
                $this->command->error("  [{$num}/{$total}] ✗ Erreur: {$msg}");
                Log::error('Erreur import produit JSON', [
                    'produit' => $productData['titre'] ?? 'inconnu',
                    'erreur' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
            }
        }

        $this->command->info("\n📊 Résumé {$fileName}: {$successCount} succès, {$errorCount} erreurs");
    }

    /**
     * Import a single product
     */
    private function importProduct(array $data, int $categorieId): void
{
    // Vérifier si le produit existe déjà (éviter doublons)
    $existingProduct = Produit::where('nom', $data['titre'])->first();
    if ($existingProduct) {
        throw new \Exception("Produit déjà existant (ignoré)");
    }

    // Télécharger l'image depuis l'URL
    $imagePath = $this->downloadImage($data['image'] ?? '', $data['titre'] ?? 'Produit');

    // Créer le produit
    $produit = Produit::create([
        'nom' => $data['titre'] ?? 'Produit sans titre',
        'description' => !empty($data['description']) ? $data['description'] : 'Description indisponible',
        'image' => $imagePath,
        'categorie_id' => $categorieId,
        'marque_id' => null, // Pas de marque
        'active' => true,
        'stock' => rand(5, 50), // Stock aléatoire entre 5 et 50
    ]);

    // Créer une entrée dans la table images
    Image::create([
        'produit_id' => $produit->id,
        'chemin' => $imagePath,
        'ordre' => 0,
    ]);
}
/**
 * Download image from URL and store locally
 */
private function downloadImage(string $url, string $productName): string
{
    try {
        // Télécharger l'image
        $response = \Illuminate\Support\Facades\Http::timeout(30)->get($url);

        if (!$response->successful()) {
            throw new \Exception("Téléchargement échoué: HTTP {$response->status()}");
        }

        // Extraire l'extension
        $extension = pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION);
        if (empty($extension) || !in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
            $extension = 'jpg'; // Par défaut
        }

        // Générer un nom de fichier unique
        $fileName = \Illuminate\Support\Str::slug(\Illuminate\Support\Str::limit($productName, 40, ''))
                    . '_' . time() . '_' . rand(1000, 9999) . '.' . $extension;
        $filePath = 'produits/' . $fileName;

        // Sauvegarder l'image dans storage/app/public
        \Illuminate\Support\Facades\Storage::disk('public')->put($filePath, $response->body());

        return $filePath;
    } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::warning('Téléchargement image échoué', [
            'url' => $url,
            'produit' => $productName,
            'erreur' => $e->getMessage()
        ]);

        // Image par défaut en cas d'erreur
        return 'placeholder.png';
    }
}


}
